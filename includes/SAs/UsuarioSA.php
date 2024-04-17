<?php

require_once __DIR__ . '/../DAOs/UsuarioDAO.php';
require_once __DIR__ . '/../DTOs/UsuarioDTO.php';

class UsuarioSA {

    public const ADMIN_ROLE = 1;

    public const USER_ROLE = 0;

    public const MOD_ROLE = 2;

    public function __construct() {
        
    }

    public function login($nombreUsuario, $password) {
        $usuario = UsuarioDAO::buscaUsuario($nombreUsuario);
        if ($usuario && $usuario->compruebaPassword($password)) {
            return $usuario;
        }
        return false;
    }

    public function crea($nombreUsuario, $password, $email, $role) {
        $user = UsuarioDAO::crea($nombreUsuario, $password, $email, $role);
        if (!$user) {
            echo "Error creating user";
        }     
        return $user;

    }

    public function buscaUsuario($nombreUsuario) {
        return UsuarioDAO::buscaUsuario($nombreUsuario);
    }

    public function buscaPorId($idUsuario) {
        return UsuarioDAO::buscaPorId($idUsuario);
    }

    public function borra(UsuarioDTO $usuario) {
        return UsuarioDAO::borra($usuario);
    }

    public function borraPorId($idUsuario) {
        return UsuarioDAO::borraPorId($idUsuario);
    }
}

?>