<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Navbar con desplegable</title>
<style>
    /* Estilos CSS para el desplegable */
    .dropdown {
        position: relative;
        display: inline-block;
    }

    .dropdown-content {
        display: none;
        position: absolute;
        background-color: #f9f9f9;
        min-width: 160px;
        box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
        z-index: 1;
    }

    .dropdown-content a {
        color: black;
        padding: 12px 16px;
        text-decoration: none;
        display: block;
    }

    .dropdown-content a:hover {background-color: #f1f1f1;}

    .dropdown:hover .dropdown-content {display: block;}

    .dropdown:hover .dropbtn {background-color: #3e8e41;}
</style>
</head>
<body>

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
        echo '<span class="dropdown">
                  <a class="dropbtn" href="#">Hello ' . $username . '</a>
                  <div class="dropdown-content">
                    <a href="criticasUsuario.php">Tus críticas</a>
                  </div>
              </span>
              <a href="includes/logout.php" class="menu_link">Logout</a>';
    }
    return;
}
?>

<header class="cabecera">
    <img src="<?= RUTA_IMGS ?>/logo.png" alt="Logo">
    <a href="<?= RUTA_APP ?>/index.php" class="menu_link">Estrenos</a>
    <a href="<?= RUTA_APP ?>/lastReviews.php" class="menu_link">Reviews</a>
    <a href="<?= RUTA_APP ?>/Blog.php" class="menu_link">Blog</a>
    <a href="<?= RUTA_APP ?>/Ranking.php" class="menu_link">Ranking</a>
    <a href="#" class="menu_link" id="searchBtn">Buscar</a>
    <?php 
        if(isset($_SESSION["user_obj"]) && unserialize($_SESSION["user_obj"])->getRole() == 1) {
            echo '<a href="includes/addEstreno.php" class="menu_link">Añadir estreno</a>';
        
        }
    ?>
    <div class="login-text"><?php showGreeting(); ?></div>
</header>

</body>
</html>
