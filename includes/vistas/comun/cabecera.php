<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar con desplegable</title>
    
</head>

<body>

    <?php
    require_once __DIR__ . '/../../config.php';
    require_once RAIZ_APP . '/session_start.php';
    require_once RAIZ_APP . '/DTOs/UsuarioDTO.php';

    function showGreeting()
    {
        if (!isset ($_SESSION["login"]) || $_SESSION["login"] === false) {
            echo '<li class="nav-item"><a href="login.php" class="nav-link">Unknown user. Login</a></li>';
        } else {
            $username = unserialize($_SESSION['user_obj'])->getNombreUsuario();
            echo '
                <ul class="navbar-nav mr-auto ml-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Hello ' . $username . '
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="criticasUsuario.php">Tus críticas</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a href="includes/logout.php" class="nav-link">Logout</a>
                    </li>
                </ul>';
        }
        return;
    }
    ?>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="<?= RUTA_APP ?>/index.php">
            <img src="<?= RUTA_IMGS ?>/logo.png" alt="Logo" class="img-fluid" style="max-height: 40px;">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <!-- Lista de opciones del menú -->
                <li class="nav-item">
                    <a href="<?= RUTA_APP ?>/estrenos.php" class="nav-link">Estrenos</a>
                </li>
                <li class="nav-item">
                    <a href="<?= RUTA_APP ?>/lastReviews.php" class="nav-link">Reviews</a>
                </li>
                <li class="nav-item">
                    <a href="<?= RUTA_APP ?>/blog.php" class="nav-link">Blog</a>
                </li>
                <li class="nav-item">
                    <a href="<?= RUTA_APP ?>/ranking.php" class="nav-link">Ranking</a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link" id="searchBtn">Buscar</a>
                </li>
                <?php if (isset ($_SESSION["user_obj"]) && unserialize($_SESSION["user_obj"])->getRole() == 1): ?>
                    <li class="nav-item">
                        <a href="<?= RUTA_APP ?>/funcionalidades/agregarPelicula.php" class="nav-link">Añadir estreno</a>
                    </li>
                <?php endif; ?>
            </ul>

            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <?php showGreeting(); ?>
                </li>
            </ul>
        </div>
    </nav>

</body>

</html>