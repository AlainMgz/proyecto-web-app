<?php
// Incluye los archivos necesarios
require_once __DIR__ . '/includes/config.php';
require_once BASE_APP . '/includes/session_start.php';
require_once __DIR__ . '/includes/SAS/postSA.php';
require_once __DIR__ . '/includes/DTOs/postDTO.php';
require_once __DIR__ . '/includes/DTOs/comentarioDTO.php';
require_once __DIR__ . '/includes/DTOs/UsuarioDTO.php';
require_once __DIR__ . '/includes/vistas/filtrado_blogs.php';
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

$filtrado= new filtrado_blogs();
$filtrado_blogs= $filtrado->filtrar();
$id_filtrado=0; //0 para ultimos, 1 para seguidos;
// Si se envió el formulario para crear un nuevo post
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titulo = $_POST['titulo'] ?? '';
    $contenido = $_POST['contenido'] ?? '';

    if (empty($titulo) || empty($contenido)) {
        mostrarError('Por favor, completa todos los campos.');
    } else {
        $username = isset($_SESSION["user_obj"]) ? unserialize($_SESSION["user_obj"])->getNombreUsuario() : '';

        // Crear un nuevo postDTO con los datos del formulario
        $postDTO = new postDTO(0, $username, $titulo, $contenido, 0, false, -1);

        // Crear una instancia del SA de Post
        $postSA = new postSA();

        // Llamar al método crearPost del SA de Post para guardar el nuevo post en la base de datos
        $postSA->crearPost(0, $username, $titulo, $contenido, 0, false, -1);

        // Redireccionar a esta misma página para actualizar la lista de posts
        header('Location: ' . $_SERVER['PHP_SELF']);
        exit();
    }
}
$usuario = isset($_SESSION["user_obj"]) ? unserialize($_SESSION["user_obj"])->getNombreUsuario() : '';
// Contenido del formulario para crear un nuevo post
$formularioNuevoPost = '
    <div class="container mt-3">
        <h2>Escribe un nuevo post</h2>
        <form action="" method="post">
    <div class="form-group">
        <textarea class="form-control" id="titulo" name="titulo" rows="1" placeholder="Título" required></textarea>
    </div>
    <div class="form-group">
        <textarea class="form-control" id="contenido" name="contenido" rows="3" placeholder="Contenido" required></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Publicar</button>
</form>
    </div>
';

// Crear una instancia del SA de Post
$postSA = new postSA();

// Si se envió el formulario para agregar un comentario
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id_post'])) {
    $id_post = $_POST['id_post'] ?? '';
    $contenido_comentario = $_POST['contenido'] ?? '';

    if (!empty($id_post) && !empty($contenido_comentario)) {
        $comentarioDTO = new comentarioDTO(0, $id_post, $usuario, $contenido_comentario, $id_post);
        $postSA->agregarComentario($comentarioDTO);

        // Redireccionar a esta misma página para actualizar la lista de comentarios
        header('Location: ' . $_SERVER['PHP_SELF']);
        exit();
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id_post_delete'])) {
    $id_post_delete = $_POST['id_post_delete'];
    $postSA->borraPost($id_post_delete);

    // Redireccionar a esta misma página para actualizar la lista de posts
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit();
}

// Si se envió el formulario para eliminar un comentario
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id_comment_delete'])) {
    $id_comment_delete = $_POST['id_comment_delete'];
    $postSA->borrarComentario($id_comment_delete);

    // Redireccionar a esta misma página para actualizar la lista de comentarios
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit();
}

// Obtener todos los posts
if($id_filtrado==1)
$posts = $postSA->postsSeguidos(unserialize($_SESSION["user_obj"])->getID());
else 
$posts = $postSA->buscarPosts();
// Contenido de los posts existentes
// Contenido de los posts existentes
$contenidoPosts = '<div class="container mt-3">';
foreach ($posts as $post) {
    $yaDioLike = $postSA->usuarioDioLike($post->getID(), $usuario);

    $contenidoPosts .= '
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title"><a href="usuario.php?nombre=' . urlencode($post->getUsuario()) . '">' . escape($post->getUsuario()) . '</a></h5>
                <h6 class="card-subtitle mb-2 text-muted">' . escape($post->getTitulo()) . '</h6>
                <p class="card-text">' . escape($post->getTexto()) . '</p>
                <p class="card-text">Likes: ' . escape($post->getLikes()) . '</p>';

    // Mostrar el botón de "Borrar Post" solo si el usuario es el autor del post
    if ($usuario === $post->getUsuario()) {
        $contenidoPosts .= '
            <!-- Formulario para eliminar el post -->
            <form action="" method="post">
                <input type="hidden" name="id_post_delete" value="' . escape($post->getID()) . '">
                <button type="submit" class="btn btn-danger borrar">Borrar Post</button>
            </form>';
    }

    // Mostrar el botón de "Like" solo si el usuario no es el autor del post y no ha dado like antes
    if ($usuario !== $post->getUsuario() && !$yaDioLike) {
        $contenidoPosts .= '
            <!-- Formulario para dar like -->
            <form action="" method="post">
                <input type="hidden" name="id_post_like" value="' . escape($post->getID()) . '">
                <button type="submit" class="btn btn-primary">Like</button>
            </form>';
    } elseif ($yaDioLike) {
        $contenidoPosts .= '<p class="text-muted">Ya has dado like a este post.</p>';
    }

    $contenidoPosts .= '
                <button class="btn btn-link" onclick="toggleComments(' . escape($post->getID()) . ')">Mostrar/ocultar comentarios</button>
                <form id="form-comment-' . escape($post->getID()) . '" style="display: none;" action="" method="post">
                    <div class="form-group">
                        <textarea class="form-control" name="contenido" rows="2" placeholder="Escribe tu comentario..." required></textarea>
                    </div>
                    <input type="hidden" name="id_post" value="' . escape($post->getID()) . '">
                    <button type="submit" class="btn btn-primary">Comentar</button>
                </form>
                <div id="comments-' . escape($post->getID()) . '" style="display: none;">';

    $comments = $postSA->buscarComentarios($post->getID());
    foreach ($comments as $comment) {
        $contenidoPosts .= '
            <div class="card mt-3 comentario">
                <div class="card-body">
                    <h6 class="card-subtitle mb-2 text-muted">' . escape($comment->getUsuario()) . '</h6>
                    <p class="card-text">' . escape($comment->getContenido()) . '</p>
                    <p class="card-text text-muted">' . escape($comment->getFecha()) . '</p>
                    <form action="" method="post">
                        <input type="hidden" name="id_comment_delete" value="' . escape($comment->getId()) . '">
                        <button type="submit" class="btn btn-danger borrar">Eliminar Comentario</button>
                    </form>
                </div>
            </div>
        ';
    }

    $contenidoPosts .= '</div>';
}

$contenidoPosts .= '</div>';

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


