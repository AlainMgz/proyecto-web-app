<?php
require_once __DIR__ . '/../includes/config.php';
require_once BASE_APP . '/includes/SAs/UsuarioSA.php';

if (!isset($_SESSION['login']) || $_SESSION['login'] == false || !isset($_SESSION['user_obj'])) {
    header('Location: ' . BASE_APP . 'login.php');
    exit();
}

if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['password']) && !empty($_POST['password'])){
    $nombreUsuario = htmlspecialchars($_POST['username']);
    $usuarioSA = new UsuarioSA();
    $usuario = $usuarioSA->buscaUsuario($nombreUsuario);
    if ($usuario->compruebaPassword($_POST['password'])) {
        if(isset($_POST['new_username']) && !empty($_POST['new_username'])){
            $usuario->setNombreUsuario(htmlspecialchars($_POST['new_username']));
        }
        if(isset($_POST['new_email']) && !empty($_POST['new_email'])){
            $usuario->setEmail(htmlspecialchars(htmlspecialchars($_POST['new_email'])));
        }
        if(isset($_POST['new_password']) && !empty($_POST['new_password'])){
            $usuario->cambiaPassword($_POST['new_password']);
        }
        if(isset($_POST['new_profile_image']) && !empty($_POST['new_profile_image'])){
            $usuario->setProfileImage(htmlspecialchars($_POST['new_profile_image']));
        }
        $usuarioSA->guarda($usuario);
        $_SESSION['user_obj'] = serialize($usuario);
        header('Location: ' . BASE_APP . 'usuario.php?nombre=' . $usuario->getNombreUsuario());
        return true;
    } else {
        return "La contraseña no es correcta";
    }
} else {
    return "No se han rellenado todos los campos";
}

?>