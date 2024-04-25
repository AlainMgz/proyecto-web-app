<?php
// Incluye los archivos necesarios
require_once __DIR__ . '/includes/config.php';
require_once BASE_APP . '/includes/session_start.php';
require_once __DIR__ . '/includes/SAS/postSA.php';
require_once __DIR__ . '/includes/DTOS/postDTO.php';
require_once __DIR__ . '/includes/DTOs/UsuarioDTO.php';

// Si se envió el formulario para crear un nuevo post
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  
}

// Obtener el nombre de usuario de la sesión
$usuario = unserialize($_SESSION["user_obj"])->getNombreUsuario();

// Contenido del formulario para crear un nuevo post
$formularioNuevoPost = '
    <div class="container">
        <h2>Escribe un nuevo post</h2>
        <form action="" method="post">
            <div class="form-group">
            <textarea class="form-control" id="titulo" name="titulo" rows="1" placeholder="titulo" onclick="if(this.value==\'Exprese su opinión\') this.value=\'\'" required>Titulo del post</textarea>
            </div>
            <div class="form-group">
                <textarea class="form-control" id="contenido" name="contenido" rows="3" placeholder="Exprese su opinión" onclick="if(this.value==\'Exprese su opinión\') this.value=\'\'" required>Exprese su opinión</textarea>
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
        <h2>Posts existentes</h2>
';

foreach ($posts as $post) {
    // Formatear cada post según el tipo "X"
    $contenidoPosts .= '
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title">' . $post->getUsuario() . '</h5>
                <h6 class="card-subtitle mb-2 text-muted">' . $post->getTitulo() . '</h6>
                <p class="card-text">' . $post->getTexto() . '</p>
            </div>
        </div>
    ';
}

$contenidoPosts .= '</div>';

// Contenido completo de la página
$contenidoPrincipal = $formularioNuevoPost . $contenidoPosts;

// Incluir la plantilla principal para mostrar el contenido
require BASE_APP . '/includes/vistas/plantillas/plantilla.php';
?>
