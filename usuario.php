<?php
require_once __DIR__ . '/includes/config.php';
require_once BASE_APP . '/includes/session_start.php';
require_once __DIR__ . '/includes/DTOs/UsuarioDTO.php';
require_once __DIR__ . '/includes/SAs/UsuarioSA.php';
require_once __DIR__ . '/includes/DTOs/postDTO.php';
require_once __DIR__ . '/includes/SAs/postSA.php';
require_once __DIR__ . '/includes/reviewsPlantilla.php'; // Incluir la plantilla de reviews

$usuarioSA = new UsuarioSA();
$postSA = new postSA();
$nombreUsuario = $_GET['nombre'];

// Obtener información del usuario
$usuario = $usuarioSA->buscaUsuario($nombreUsuario);
$nombre = $usuario->getNombreUsuario();
$seguidores= array();
$seguidos= array();

// Contenido de la información del usuario
$infoUsuario = '
    <div class="container mt-3">
        <h2>Información del Usuario</h2>
        <p><strong>Nombre:</strong> ' . $nombre . '</p>
        <p><strong>Seguidores:</strong> ' . count($seguidores) . '</p>
        <p><strong>Seguidos:</strong> ' . count($seguidos) . '</p>
    </div>
';

// Contenido de los posts existentes
$contenidoPosts = '
    <div class="container mt-3">
        <h2>Posts de ' . $nombre . '</h2>
';

$posts = $postSA->buscarPostsPorUsuario($nombreUsuario);
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
$contenidoPrincipal = $infoUsuario . $contenidoPosts;

require BASE_APP . '/includes/vistas/plantillas/plantilla.php';
