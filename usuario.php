<?php
require_once __DIR__ . '/includes/config.php';
require_once BASE_APP . '/includes/session_start.php';
require_once __DIR__ . '/includes/DTOs/UsuarioDTO.php';
require_once __DIR__ . '/includes/SAs/UsuarioSA.php';
require_once __DIR__ . '/includes/DTOs/postDTO.php';
require_once __DIR__ . '/includes/SAs/postSA.php';
require_once __DIR__ . '/includes/SAs/PeliculaSA.php';
require_once __DIR__ . '/includes/reviewsPlantilla.php'; // Incluir la plantilla de reviews

$tituloPagina = 'Perfil de Usuario';

if (!isset($_GET['nombre'])) {
    header('Location: index.php');
}

if (!isset($_SESSION['login']) || $_SESSION['login'] == false || !isset($_SESSION['user_obj'])) { // Si no está logueado, redirigir a login porque no puede ver perfiles
    header('Location: login.php');
}

$usuarioSA = new UsuarioSA();
$postSA = new postSA();
$nombreUsuario = $_GET['nombre'];
$loggedUser = unserialize($_SESSION['user_obj']);
$userRol = $usuarioSA->buscaUsuario($nombreUsuario)->getRole();
$loggedUserId = $loggedUser->getId();
$loggedUsername = $loggedUser->getNombreUsuario();

//Post para el boton de degradar/ascender
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id_usuario'])) {
    $idUsuario = $_POST['id_usuario'];
    if (isset($_POST['promover_usuario'])) {
        // Llama a la función promoverUsuario de UsuarioSA
        $usuarioSA->promoverUsuario($idUsuario);
    } elseif (isset($_POST['degradar_usuario'])) {
        // Llama a la función degradarUsuario de UsuarioSA
        $usuarioSA->degradarUsuario($idUsuario);
    }
    header("Location: usuario.php?nombre=$nombreUsuario");
    exit();
}
if ($loggedUsername == $nombreUsuario) { // Si el usuario está viendo su propio perfil

    // Obtener información del usuario
    $usuario = $usuarioSA->buscaUsuario($nombreUsuario);
    $nombre = $usuario->getNombreUsuario();
    $seguidores = $usuario->getFollowers();
    $seguidos = $usuario->getFollowing();

    $seguidoresDropdown = '<div class="dropdown-content-followers">';
    foreach ($seguidores as $seguidor) {
        $seguidorNombre = $usuarioSA->buscaNombrePorId($seguidor);
        $seguidoresDropdown .= '<span><a href="usuario.php?nombre=' . $seguidorNombre . '">' . $seguidorNombre . '</a></span>';
    }
    $seguidoresDropdown .= '</div>';

    $seguidosDropdown = '<div class="dropdown-content-followers">';
    foreach ($seguidos as $seguido) {
        $seguidoNombre = $usuarioSA->buscaNombrePorId($seguido);
        $seguidosDropdown .= '<span><a href="usuario.php?nombre=' . $seguidoNombre . '">' . $seguidoNombre . '</a></span>';
    }
    $seguidosDropdown .= '</div>';

    // Contenido de la información del usuario
    $infoUsuario = '

    <div class="profile-container">
        <div class="profile-info">
            <div class="profile-detail">
                <h2>Información del Usuario</h2>
                <span class="value"><img src="img/' . $usuario->getProfileImage() . '" alt="Profile Image" height="150px"></span>
            </div>
            <div class="profile-detail">
                <span class="label">Nombre:</span>
                <span class="value">' . $nombre . ' ' . ($usuario->getRole() == 2 ? '<i class="fas fa-check-circle text-primary"></i>' : ($usuario->getRole() == 1 ? '<i class="fas fa-check-circle text-warning"></i>' : '')) . '</span>
                </div>
            <div class="profile-detail">
                <span class="label">Seguidores:</span>
                <span class="dropdown-followers">
                    <span class="value">' . count($seguidores) . '</span>' . $seguidoresDropdown . '
                </span>
            </div>
            <div class="profile-detail">
                <span class="label">Seguidos:</span>
                <span class="dropdown-followers">
                    <span class="value">' . count($seguidos) . '</span>' . $seguidosDropdown . '
                </span>
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
    $seguidores = $usuario->getFollowers();
    $seguidos = $usuario->getFollowing();

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
                    <div class="profile-detail">
                        <h2>Información del Usuario</h2>
                        <button id="follow-btn" class="follow-btn">Follow</button>
                        <span class="value"><img style="" src="img/' . $usuario->getProfileImage() . '" alt="Profile Image" height="150px"></span>
                    </div>
                    <div class="profile-detail">
                        <span class="label">Nombre:</span>
                        <span class="value">' . $nombre . ' ' . ($usuario->getRole() == 2 ? '<i class="fas fa-check-circle text-primary"></i>' : ($usuario->getRole() == 1 ? '<i class="fas fa-check-circle text-warning"></i>' : '')) . '</span>
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
                        <span class="value">' . $nombre . ' ' . ($usuario->getRole() == 2 ? '<i class="fas fa-check-circle text-primary"></i>' : ($usuario->getRole() == 1 ? '<i class="fas fa-check-circle text-warning"></i>' : '')) . '</span>
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
    /*
Para promover o degradar
    */
    if (unserialize($_SESSION['user_obj'])->getRole() == 1) {
        if ($userRol == 0) {
            $infoUsuario .= '<form method="POST" action="">
    <input type="hidden" name="id_usuario" value="' . $usuario->getId() . '">
    <button type="submit" name="promover_usuario" class="promote-btn">Promover Usuario</button>
  </form>';
        }
        if ($userRol == 2) {
            $infoUsuario .= '<form method="POST" action="">
        <input type="hidden" name="id_usuario" value="' . $usuario->getId() . '">
        <button type="submit" name="degradar_usuario" class="promote-btn">Degradar Usuario</button>
      </form>';
        }
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
                    <h6 class="card-subtitle mb-2 text-muted">' . $post->getTitulo() . '</h6>';
                    $texto_post = $post->getTexto();

                $texto_post_con_enlaces = preg_replace_callback('/@(\w[\w.-]*)/', function($matches) {
                $nombreUsuario = $matches[1];
                $user = new UsuarioSA();
                if ($user->buscaUsuario($nombreUsuario)) {
                    return '<a href="usuario.php?nombre=' . $nombreUsuario . '">@' . $nombreUsuario . '</a>';
                } else {
                    return '@' . $nombreUsuario; // Si el usuario no existe, no se convierte en enlace
                }
            }, $texto_post);            
            
            $texto_post_con_enlaces = preg_replace_callback('/#(\w[\w.-]*)/', function($matches) {
                $nombrePelicula = $matches[1];
                $pelicula = new PeliculaSA();
                if ($pelicula->obtenerPeliculaPorNombre($nombrePelicula)) {
                    return '<a href="infoPeliculas.php?nombre=' . urlencode($nombrePelicula) . '">#' . $nombrePelicula . '</a>';
                } else {
                    return '#' . $nombrePelicula; // Si la película no existe, no se convierte en enlace
                }
            }, $texto_post_con_enlaces);

            $contenidoPosts .= '
                            <p class="card-text" style="text-decoration: none;">' . $texto_post_con_enlaces . '</p>
                </div>
            </div>
        ';
    }

    $contenidoPosts .= '</div>';
    $contenidoPrincipal = $infoUsuario . $contenidoPosts;
}


require BASE_APP . '/includes/vistas/plantillas/plantilla.php';
