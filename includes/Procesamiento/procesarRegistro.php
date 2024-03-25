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
    $email = htmlspecialchars($_POST['email']);
    $password_plain = $_POST['password'];
    
    $user = Usuario::crea($username, $password_plain, $email, 0);

    if ($user) {
        header("Location: ../login.php");
    } else {
        header("Location: ../registro.php");
    }

}
?>