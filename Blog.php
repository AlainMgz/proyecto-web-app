<?php
// Incluye los archivos necesarios
require_once __DIR__ . '/includes/config.php';
require_once BASE_APP . '/includes/session_start.php';
require_once __DIR__ . '/includes/SAS/postSA.php';
require_once __DIR__ . '/includes/SAS/usuarioSA.php';
require_once __DIR__ . '/includes/DTOs/postDTO.php';
require_once __DIR__ . '/includes/DTOs/comentarioDTO.php';
require_once __DIR__ . '/includes/DTOs/UsuarioDTO.php';
require_once __DIR__ . '/includes/vistas/filtrado_blogs.php';
require_once __DIR__ . '/Formularios/FormularioAgregarPosts.php';
require_once __DIR__ . '/includes/vistas/mostrarPosts.php';

// Función para escapar los datos para evitar inyección de HTML
function escape($data)
{
    return htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
}

// Función para mostrar mensajes de error
function mostrarError($mensaje)
{
    echo '<div class="alert alert-danger" role="alert">' . escape($mensaje) . '</div>';
}

$mostrarPost = new mostrarPosts();
$filtrado = new filtrado_blogs();
$filtrado_blogs = $filtrado->filtrar();

$usuario = isset($_SESSION["user_obj"]) ? unserialize($_SESSION["user_obj"])->getNombreUsuario() : '';
// Contenido del formulario para crear un nuevo post
$formularioPosts = new FormularioAgregarPosts();
$formularioNuevoPost = $formularioPosts->mostrarFormulario();
// Crear una instancia del SA de Post
$postSA = new postSA();

//Gestion de los envios de formularios
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id_post'])) {
    $id_post = $_POST['id_post'] ?? '';
    $contenido_comentario = $_POST['contenido'] ?? '';

    if (!empty($id_post) && !empty($contenido_comentario)) {
        $comentarioDTO = new comentarioDTO(0, $id_post, $usuario, $contenido_comentario, $id_post);
        $postSA->agregarComentario($comentarioDTO);

        // Redireccionar a esta misma página para actualizar la lista de comentarios
        echo '<script>window.location.replace("' . $_SERVER['PHP_SELF'] . '");</script>';
        exit();
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id_post_delete'])) {
    $id_post_delete = $_POST['id_post_delete'];
    $postSA->borraPost($id_post_delete);
    echo '<script>window.location.replace("' . $_SERVER['PHP_SELF'] . '");</script>';
    exit();
}

// Si se envió el formulario para eliminar un comentario
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id_comment_delete'])) {
    $id_comment_delete = $_POST['id_comment_delete'];
    $postSA->borrarComentario($id_comment_delete);

    // Redireccionar a esta misma página para actualizar la lista de comentarios
    echo '<script>window.location.replace("' . $_SERVER['PHP_SELF'] . '");</script>';
    exit();
}

// Obtener todos los posts
if ($_SESSION['seguidos']) {
    $posts = $postSA->postsSeguidos(unserialize($_SESSION["user_obj"])->getID());
} else {
    $posts = $postSA->buscarPosts();
}

$contenidoPosts = $mostrarPost->construirPosts($posts, $usuario);

// Si se envió el formulario para dar like a un post
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id_post_like'])) {
    $id_post_like = $_POST['id_post_like'];

    if (!$postSA->usuarioDioLike($id_post_like, unserialize($_SESSION["user_obj"])->getID())) {
        $postSA->agregarLike($id_post_like, unserialize($_SESSION["user_obj"])->getID());
    }

    // Redireccionar a esta misma página para actualizar la lista de posts
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit();
}

// JavaScript para mostrar/ocultar comentarios y enviar comentarios
$script = '
    <script>
        function toggleComments(postId) {
            var form = document.getElementById("form-comment-" + postId);
            var comments = document.getElementById("comments-" + postId);
            if (form.style.display === "none") {
                form.style.display = "block";
                comments.style.display = "block"; // Mostrar comentarios al mostrar el formulario
            } else {
                form.style.display = "none";
                comments.style.display = "none"; // Ocultar comentarios al ocultar el formulario
            }
        }

    </script>
';

// Incluir el script JavaScript
echo $script;

// Contenido completo de la página
$contenidoPrincipal =  $formularioNuevoPost . $contenidoPosts;

// Incluir la plantilla principal para mostrar el contenido
require BASE_APP . '/includes/vistas/plantillas/plantilla.php';

