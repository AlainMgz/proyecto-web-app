<?php 
require_once __DIR__.'/../../config.php';
require_once RAIZ_APP.'/session_start.php';
require_once RAIZ_APP.'/DTOs/UsuarioDTO.php';

function showGreeting() {
    if(!isset($_SESSION["login"]) || $_SESSION["login"] === false) {
        echo '<span>
            Unknown user. <a href="login.php" class="menu_link">Login</a>              </span>';
    } else {
        $username = unserialize($_SESSION['user_obj'])->getNombreUsuario();
        echo '<span>
                  Hello ' . $username . '. <a href="includes/logout.php" class="menu_link">Logout</a>	
              </span>';
    }
    return;
}
?>
<header class="cabecera">
    <img src="<?= RUTA_IMGS ?>/logo.png" alt="Logo">
    <a href="<?= RUTA_APP ?>/index.php" class="menu_link">Estrenos</a>
    <a href="<?= RUTA_APP ?>/lastReviews.php" class="menu_link">Reviews</a>
    <a href="#" class="menu_link">Blog</a>
    <a href="#" class="menu_link">Rankings</a>
    <a href="#" class="menu_link" id="searchBtn">Buscar</a>
    <?php 
        if(isset($_SESSION["user_obj"]) && unserialize($_SESSION["user_obj"])->getRole() == 1) {
            echo '<a href="includes/addEstreno.php" class="menu_link">Añadir estreno</a>';
        
        }
    ?>
    <div class="login-text"><?php showGreeting(); ?></div>
</header>