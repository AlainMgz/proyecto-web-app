<?php
// Incluye los archivos necesarios
require_once __DIR__ . '/includes/config.php';
require_once BASE_APP . '/includes/session_start.php';
require_once __DIR__ . '/includes/SAS/postSA.php';
require_once __DIR__ . '/includes/DTOs/postDTO.php';
require_once __DIR__ . '/includes/DTOs/UsuarioDTO.php';

// Si se envió el formulario para crear un nuevo post
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

if (isset($_SESSION["user_obj"]))
    $usuario = unserialize($_SESSION["user_obj"])->getNombreUsuario();

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

// Obtener todos los posts
$posts = $postSA->buscarPosts();

// Contenido de los posts existentes
$contenidoPosts = '
    <div class="container mt-3">
      
';

foreach ($posts as $post) {
    // Formatear cada post según el tipo "X"
    $contenidoPosts .= '
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title"><a href="usuario.php?nombre=' . urlencode($post->getUsuario()) . '">' . $post->getUsuario() . '</a></h5>
                <h6 class="card-subtitle mb-2 text-muted">' . $post->getTitulo() . '</h6>
                <p class="card-text">' . $post->getTexto() . '</p>
            </div>
        </div>
    ';
}


$contenidoPosts .= '</div>';
$contenidoPrincipal = '';
// Contenido completo de la página
if (isset($_SESSION["user_obj"])) {
    $contenidoPrincipal = $formularioNuevoPost;
}
$contenidoPrincipal .= $contenidoPosts;


// Incluir la plantilla principal para mostrar el contenido
require BASE_APP . '/includes/vistas/plantillas/plantilla.php';

