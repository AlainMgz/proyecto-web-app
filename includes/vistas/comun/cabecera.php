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

    $current_url = $_SERVER['REQUEST_URI'];

    $estrenos_url = RUTA_APP . '/estrenos.php';
    $reviews_url = RUTA_APP . '/lastReviews.php';
    $blog_url = RUTA_APP . '/blog.php';
    $ranking_url = RUTA_APP . '/ranking.php';

    $estrenos_active = ($current_url == $estrenos_url) ? 'active' : '';
    $reviews_active = ($current_url == $reviews_url) ? 'active' : '';
    $blog_active = ($current_url == $blog_url) ? 'active' : '';
    $ranking_active = ($current_url == $ranking_url) ? 'active' : '';

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
                <li class="nav-item <?= $estrenos_active ?>">
                    <a href="<?= $estrenos_url ?>" class="nav-link">Estrenos</a>
                </li>
                <li class="nav-item <?= $reviews_active ?>">
                    <a href="<?= $reviews_url ?>" class="nav-link">Reviews</a>
                </li>
                <li class="nav-item <?= $blog_active ?>">
                    <a href="<?= $blog_url ?>" class="nav-link">Blog</a>
                </li>
                <li class="nav-item <?= $ranking_active ?>">
                    <a href="<?= $ranking_url ?>" class="nav-link">Ranking</a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <form class="form-inline my-2 my-lg-0" action="/proyecto-web-app/reviewPelicula.php" method="get">
                        <li>
                            <input class="form-control mr-sm-2" type="search" name="nombre" placeholder="Buscar">
                        </li>
                        <li>
                            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Buscar</button>
                        </li>
                    </form>
                </li>
                <li class="nav-item">
                    <?php showGreeting(); ?>
                </li>
            </ul>
        </div>
    </nav>

</body>

</html>