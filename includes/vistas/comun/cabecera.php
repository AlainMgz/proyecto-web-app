<?php 
function showGreeting() {
    if(!isset($_SESSION["login"]) || $_SESSION["login"] === false) {
        echo '<span>
            Unknown user. <a href="login.php" class="menu_link">Login</a>              </span>';
    } else {
        echo '<span>
                  Hello ' . $_SESSION["username"] . '. <a href="includes/logout.php" class="menu_link">Logout</a>	
              </span>';
    }
    return;
}
?>
<header class="cabecera">
    <img src="img/logo.png" alt="Logo" class="logo">
    <a href="#" class="menu_link">Estrenos</a>
    <a href="#" class="menu_link">Reviews</a>
    <a href="#" class="menu_link">Blog</a>
    <a href="#" class="menu_link">Rankings</a>
    <?php 
        if(isset($_SESSION["esAdmin"]) && $_SESSION["esAdmin"] === true) {
            echo '<a href="includes/addEstreno.php" class="menu_link">Añadir estreno</a>';
        
        }
    ?>
    <div class="login-text"><?php showGreeting(); ?></div>
</header>
