<?php
require_once __DIR__ . '/includes/config.php';
require_once BASE_APP . '/includes/session_start.php';
require_once __DIR__ . '/includes/DTOs/UsuarioDTO.php';
require_once __DIR__ . '/includes/SAs/UsuarioSA.php';
require_once __DIR__ . '/includes/DTOs/postDTO.php';
require_once __DIR__ . '/includes/SAs/postSA.php';
require_once __DIR__ . '/includes/reviewsPlantilla.php'; // Incluir la plantilla de reviews

$tituloPagina = 'Perfil de Usuario';

if (!isset($_GET['nombre'])) {
    header(__DIR__ . 'Location: index.php');
}

if (!isset($_SESSION['login']) || $_SESSION['login'] == false || !isset($_SESSION['user_obj'])) { // Si no está logueado, redirigir a login porque no puede ver perfiles
    header(__DIR__ . 'Location: login.php');
}

$usuarioSA = new UsuarioSA();
$postSA = new postSA();
$nombreUsuario = $_GET['nombre'];
$loggedUser = unserialize($_SESSION['user_obj']);
$loggedUserId = $loggedUser->getId();
$loggedUsername = $loggedUser->getNombreUsuario();

if ($loggedUsername == $nombreUsuario) { // Si el usuario está viendo su propio perfil

    // Obtener información del usuario
    $usuario = $usuarioSA->buscaUsuario($nombreUsuario);
    $nombre = $usuario->getNombreUsuario();
    $seguidores= $usuario->getFollowers();
    $seguidos= $usuario->getFollowing();

    // Contenido de la información del usuario
    $infoUsuario = '
    <div class="profile-container">
        <div class="profile-info">
            <h2>Información del Usuario</h2>
            <div class="profile-detail">
                <span class="label">Nombre:</span>
                <span class="value">' . $nombre . '</span>
            </div>
            <div class="profile-detail">
                <span class="label">Seguidores:</span>
                <span class="value">' . count($seguidores) . '</span>
            </div>
            <div class="profile-detail">
                <span class="label">Seguidos:</span>
                <span class="value">' . count($seguidos) . '</span>
            </div>
        </div>
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

} else { // Si el usuario está viendo el perfil de otro usuario
    // Obtener información del usuario
    $usuario = $usuarioSA->buscaUsuario($nombreUsuario);
    $nombre = $usuario->getNombreUsuario();
    $seguidores= $usuario->getFollowers();
    $seguidos= $usuario->getFollowing();

    if (!in_array($loggedUserId, $seguidores)) {
        // Contenido de la información del usuario
        $infoUsuario = '
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
            <script>
                $(document).ready(function(){
                    $("#follow-btn").click(function(){
                        $.ajax({
                            type: "POST",
                            url: "funcionalidades/procesarSeguir.php",
                            data: { username: "' . $nombre . '", action: "follow"},
                            success: function(response){
                                // Handle the response from the server
                                if (response) { 
                                    alert("Error following user:\n" + response);
                                }
                                location.reload();
                            }
                        });
                    });
                });
            </script>
            <div class="profile-container">
                <div class="profile-info">
                    <div class="container-btn">
                        <h2>Información del Usuario</h2>
                        <button id="follow-btn" class="follow-btn">Follow</button>
                    </div>
                    <div class="profile-detail">
                        <span class="label">Nombre:</span>
                        <span class="value">' . $nombre . '</span>
                    </div>
                    <div class="profile-detail">
                        <span class="label">Seguidores:</span>
                        <span class="value">' . count($seguidores) . '</span>
                    </div>
                    <div class="profile-detail">
                        <span class="label">Seguidos:</span>
                        <span class="value">' . count($seguidos) . '</span>
                    </div>
                </div>
            </div>
        ';
    } else {
        // Contenido de la información del usuario
        $infoUsuario = '
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
            <script>
                $(document).ready(function(){
                    $("#follow-btn").click(function(){
                        $.ajax({
                            type: "POST",
                            url: "funcionalidades/procesarSeguir.php",
                            data: { username: "' . $nombre . '", action: "unfollow"},
                            success: function(response){
                                // Handle the response from the server
                                if (response) { 
                                    alert("Error unfollowing user:\n" + response);
                                }
                                location.reload();
                            }
                        });
                    });
                });
            </script>
            <div class="profile-container">
                <div class="profile-info">
                    <div class="container-btn">
                        <h2>Información del Usuario</h2>
                        <button id="follow-btn" class="following-btn"></button>
                    </div>
                    <div class="profile-detail">
                        <span class="label">Nombre:</span>
                        <span class="value">' . $nombre . '</span>
                    </div>
                    <div class="profile-detail">
                        <span class="label">Seguidores:</span>
                        <span class="value">' . count($seguidores) . '</span>
                    </div>
                    <div class="profile-detail">
                        <span class="label">Seguidos:</span>
                        <span class="value">' . count($seguidos) . '</span>
                    </div>
                </div>
            </div>
        ';
    }

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
}


require BASE_APP . '/includes/vistas/plantillas/plantilla.php';
