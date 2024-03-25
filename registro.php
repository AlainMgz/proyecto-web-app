<?php
require_once __DIR__.'/includes/config.php';
require_once RAIZ_APP.'/session_start.php';

$tituloPagina = 'Login';

if (isset($_SESSION["login"]) && $_SESSION["login"] == true) {
    $contenidoPrincipal = <<<EOS
    <div class="login-content">
        <div class="title_container">
            <p>You are already logged in!</p>
            <p>Welcome {$_SESSION['username']}!</p>
        </div>
    </div>
    EOS;
} else {
    $contenidoPrincipal = <<<EOS
    <div class="login-content">
        <div class="login-container">
            <h2>Create account</h2>
            <form action="includes/procesarRegistro.php" method="post">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>

                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>

                <button type="submit">Submit</button>
            </form>

            <div class="create-account-link">
                <p>If you already have an account, <a href="login.php">login</a>.</p>
            </div>
        </div>
    </div>
    EOS;
}

require RAIZ_APP.'/vistas/plantillas/plantilla.php'; 

?>
    
