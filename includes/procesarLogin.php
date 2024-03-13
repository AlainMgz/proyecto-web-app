<?php
require_once 'config.php';
require_once 'session_start.php';
require_once 'Usuario.php';

if (isset($_SESSION["login"]) && $_SESSION["login"] == true) {
    header("Location: ../estrenos.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = htmlspecialchars($_POST['username']);
    $password_plain = $_POST['password'];

    $user = Usuario::login($username, $password_plain);

    if ($user) {
        $_SESSION['login'] = true;
        $_SESSION['user_obj'] = serialize($user);
        header("Location: ../estrenos.php");
    } else {
        
        //header("Location: ../registro.php");
    }

}
?>