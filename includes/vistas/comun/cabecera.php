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
            box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2);
            z-index: 1;
        }

        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .dropdown-content a:hover {
            background-color: #f1f1f1;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        .dropdown:hover .dropbtn {
            background-color: #3e8e41;
        }
    </style>
</head>

<body>

    <?php
    require_once __DIR__ . '/../../config.php';
    require_once RAIZ_APP . '/session_start.php';
    require_once RAIZ_APP . '/DTOs/UsuarioDTO.php';

    function showGreeting()
    {
        if (!isset ($_SESSION["login"]) || $_SESSION["login"] === false) {
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

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="index.php">
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
                <a href="<?= RUTA_APP ?>/index.php" class="nav-link">Estrenos</a>
            </li>
            <li class="nav-item">
                <a href="<?= RUTA_APP ?>/lastReviews.php" class="nav-link">Reviews</a>
            </li>
            <li class="nav-item">
                <a href="<?= RUTA_APP ?>/Blog.php" class="nav-link">Blog</a>
            </li>
            <li class="nav-item">
                <a href="<?= RUTA_APP ?>/Ranking.php" class="nav-link">Ranking</a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link" id="searchBtn">Buscar</a>
            </li>
            <?php if (isset($_SESSION["user_obj"]) && unserialize($_SESSION["user_obj"])->getRole() == 1): ?>
                <li class="nav-item">
                    <a href="<?= RUTA_APP ?>/funcionalidades/agregarPelicula.php" class="nav-link">Añadir estreno</a>
                </li>
            <?php endif; ?>
        </ul>
    </div>
</nav>
    
</body>

</html>