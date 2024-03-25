<?php
require_once __DIR__.'/includes/config.php';
require_once RAIZ_APP.'/session_start.php';
require_once RAIZ_APP.'/Usuario.php';

$tituloPagina = 'Login';

if (isset($_SESSION["login"]) && $_SESSION["login"] == true) {
    $user = unserialize($_SESSION['user_obj']);
    $username = $user->getNombreUsuario();
    $contenidoPrincipal = <<<EOS
    <div class="login-content">
        <div class="title_container">
            <p>You are already logged in!</p>
            <p>Welcome {$username}!</p>
        </div>
    </div>
    EOS;
} else {
    $contenidoPrincipal = <<<EOS
    <div class="login-content">
        <div class="login-container">
            <h2>Login</h2>
            <form action="includes/Procesamiento/procesarLogin.php" method="post">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>

                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>

                <button type="submit">Login</button>
            </form>

            <div class="create-account-link">
                <p>If you don't have an account, <a href="registro.php">create one</a>.</p>
            </div>
        </div>
    </div>
    EOS;
}

require RAIZ_APP.'/vistas/plantillas/plantilla.php'; 


