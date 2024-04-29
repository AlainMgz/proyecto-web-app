<?php
// Incluye los archivos necesarios
require_once __DIR__ . '/includes/config.php';
require_once BASE_APP . '/includes/session_start.php';
require_once __DIR__ . '/includes/SAS/postSA.php';
require_once __DIR__ . '/includes/DTOs/postDTO.php';
require_once __DIR__ . '/includes/DTOs/comentarioDTO.php';
require_once __DIR__ . '/includes/DTOs/UsuarioDTO.php';

// Si se envió el formulario para crear un nuevo post
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $titulo = $_POST['titulo'] ?? '';
    $contenido = $_POST['contenido'] ?? '';
    $username = '';
    if (isset($_SESSION["user_obj"])) {
        $username = unserialize($_SESSION["user_obj"])->getNombreUsuario();
    }
    // Validar los datos
    if (empty($titulo) || empty($contenido)) {
        // Si falta alguno de los campos, puedes mostrar un mensaje de error o redireccionar a otra página
        echo '<div class="alert alert-danger" role="alert">Por favor, completa todos los campos.</div>';
    } else {
        // Crear un objeto postDTO con los datos del formulario
        $postDTO = new postDTO(0, $username, $titulo, $contenido, 0, false, -1);

        // Crear una instancia del SA de Post
        $postSA = new postSA();

        // Llamar al método creaPost del SA de Post para guardar el nuevo post en la base de datos
        $postSA->crearPost(0, $username, $titulo, $contenido, 0, false, -1);

        // Redireccionar a esta misma página para actualizar la lista de posts
        header('Location: ' . $_SERVER['PHP_SELF']);
        exit();
    }
}

// Obtener el nombre de usuario de la sesión
if (isset($_SESSION["user_obj"])) {
    $usuario = unserialize($_SESSION["user_obj"])->getNombreUsuario();
}

// Contenido del formulario para crear un nuevo post
$formularioNuevoPost = '
    <div class="container">
        <h2>Escribe un nuevo post</h2>
        <form action="" method="post">
            <div class="form-group">
                <textarea class="form-control" id="titulo" name="titulo" rows="1" placeholder="titulo" onclick="if(this.value==\'Exprese su opinión\') this.value=\'\'" required></textarea>
            </div>
            <div class="form-group">
                <textarea class="form-control" id="contenido" name="contenido" rows="3" placeholder="contenido" onclick="if(this.value==\'Exprese su opinión\') this.value=\'\'" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Publicar</button>
        </form>
    </div>
';

// Crear una instancia del SA de Post
$postSA = new postSA();

// Si se envió el formulario para agregar un comentario
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id_post'])) {
    // Obtener los datos del formulario
    $id_post = $_POST['id_post'] ?? '';
    $contenido_comentario = $_POST['contenido'] ?? '';

    // Validar los datos
    if (!empty($id_post) && !empty($contenido_comentario)) {
        // Crear un objeto comentarioDTO con los datos del formulario
        $comentarioDTO = new comentarioDTO(0, $id_post,$usuario, $contenido_comentario, $id_post);

        // Llamar al método agregarComentario del SA de Post para guardar el nuevo comentario en la base de datos
        $postSA->agregarComentario($comentarioDTO);

        // Redireccionar a esta misma página para actualizar la lista de comentarios
        header('Location: ' . $_SERVER['PHP_SELF']);
        exit();
    }
}

// Si se envió el formulario para eliminar un comentario
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id_comment_delete'])) {
    // Obtener el ID del comentario a eliminar
    $id_comment_delete = $_POST['id_comment_delete'];

    // Llamar al método para eliminar el comentario del SA de Post
    $postSA->borrarComentario($id_comment_delete);

    // Redireccionar a esta misma página para actualizar la lista de comentarios
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit();
}

// Obtener todos los posts
$posts = $postSA->buscarPosts();

// Contenido de los posts existentes
$contenidoPosts = '<div class="container mt-3">';
foreach ($posts as $post) {
    // Formatear cada post
    $contenidoPosts .= '
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title"><a href="usuario.php?nombre=' . urlencode($post->getUsuario()) . '">' . $post->getUsuario() . '</a></h5>
                <h6 class="card-subtitle mb-2 text-muted">' . $post->getTitulo() . '</h6>
                <p class="card-text">' . $post->getTexto() . '</p>
                <!-- Botón para mostrar/ocultar comentarios -->
                <button class="btn btn-link" onclick="toggleComments(' . $post->getID() . ')">Mostrar/ocultar comentarios</button>
                <!-- Formulario para agregar comentarios -->
                <form id="form-comment-' . $post->getID() . '" style="display: none;" action="" method="post">
                    <div class="form-group">
                        <textarea class="form-control" name="contenido" rows="2" placeholder="Escribe tu comentario..." required></textarea>
                    </div>
                    <input type="hidden" name="id_post" value="' . $post->getID() . '">
                    <button type="submit" class="btn btn-primary">Comentar</button>
                </form>
                <!-- Contenedor de comentarios -->
                <div id="comments-' . $post->getID() . '" style="display: none;">';

                
    // Mostrar comentarios existentes para este post
    $comments = $postSA->buscarComentarios($post->getID());
    foreach ($comments as $comment) {
        $contenidoPosts .= '
            <div class="card mt-3">
                <div class="card-body">
                    <h6 class="card-subtitle mb-2 text-muted">' . $comment->getUsuario() . '</h6>
                    <p class="card-text">' . $comment->getContenido() . '</p>
                    <p class="card-text text-muted">' . $comment->getFecha() . '</p>
                    <!-- Formulario para eliminar comentario -->
                    <form action="" method="post">
                        <input type="hidden" name="id_comment_delete" value="' . $comment->getId() . '">
                        <button type="submit" class="btn btn-danger">Eliminar Comentario</button>
                    </form>
                </div>
            </div>
        ';
    }

}

$contenidoPosts .= '</div>';

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
$contenidoPrincipal = $formularioNuevoPost . $contenidoPosts;

// Incluir la plantilla principal para mostrar el contenido
require BASE_APP . '/includes/vistas/plantillas/plantilla.php';
?>
