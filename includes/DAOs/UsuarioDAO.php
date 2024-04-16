<?php

class UsuarioDAO
{

    public static function login($nombreUsuario, $password)
    {
        $usuario = self::buscaUsuario($nombreUsuario);
        if ($usuario && $usuario->compruebaPassword($password)) {
            return $usuario;
        }
        return false;
    }
    
    public static function crea($nombreUsuario, $password, $email, $role)
    {
        $user = new UsuarioDTO($nombreUsuario, self::hashPassword($password), $email, $role);
        return self::guarda($user);
    }

    public static function buscaUsuario($nombreUsuario)
    {
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf("SELECT * FROM users WHERE username='%s'", $conn->real_escape_string($nombreUsuario));
        $rs = $conn->query($query);
        $result = false;
        if ($rs) {
            $fila = $rs->fetch_assoc();
            if ($fila) {
                $result = new UsuarioDTO($fila['username'], $fila['password'], $fila['email'], $fila['role'], $fila['id']);
            }
            $rs->free();
        } else {
            error_log("Error BD ({$conn->errno}): {$conn->error}");
        }
        return $result;
    }

    public static function buscaPorId($idUsuario)
    {
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf("SELECT * FROM users WHERE id=%d", $idUsuario);
        $rs = $conn->query($query);
        $result = false;
        if ($rs) {
            $fila = $rs->fetch_assoc();
            if ($fila) {
                $result = new UsuarioDTO($fila['username'], $fila['password'], $fila['email'], $fila['role'], $fila['id']);
            }
            $rs->free();
        } else {
            error_log("Error BD ({$conn->errno}): {$conn->error}");
        }
        return $result;
    }
    
    private static function hashPassword($password)
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }
   
    private static function inserta(UsuarioDTO $usuario)
    {
        $conn = Aplicacion::getInstance()->getConexionBd();

        $checkQuery = sprintf("SELECT * FROM users WHERE username = '%s' OR email = '%s'"
            , $conn->real_escape_string($usuario->getNombreUsuario())
            , $conn->real_escape_string($usuario->getEmail()));
        $result = $conn->query($checkQuery);

        if ($result->num_rows > 0) {
            // User already exists
            echo "User with the provided username or email already exists.";
            return false;
        } else {
            $query=sprintf("INSERT INTO users (username, email, password, role) VALUES ('%s', '%s', '%s', %d)"
                , $conn->real_escape_string($usuario->getNombreUsuario())
                , $conn->real_escape_string($usuario->getEmail())
                , $usuario->getPassword()
                , $usuario->getRole()
            );
            if ( $conn->query($query) ) {
                $usuario->addId($conn->insert_id);
                return $usuario;
            } else {
                error_log("Error BD ({$conn->errno}): {$conn->error}");
                return false;
            }
        }

        
    }
    
    private static function actualiza(UsuarioDTO $usuario)
    {
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query=sprintf("UPDATE users SET username = '%s', email='%s', password='%s' WHERE id=%d"
            , $conn->real_escape_string($usuario->nombreUsuario)
            , $conn->real_escape_string($usuario->nombre)
            , $conn->hashPassword($usuario->password)
            , $usuario->getId()
        );
        if ( $conn->query($query) ) {
            return true;
        } else {
            error_log("Error BD ({$conn->errno}): {$conn->error}");
            return false;
        }
    }
   
    
    private static function borra(UsuarioDTO $usuario)
    {
        return self::borraPorId($usuario->getId());
    }
    
    private static function borraPorId($idUsuario)
    {
        if (!$idUsuario) {
            return false;
        }
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf("DELETE FROM users WHERE id = %d"
            , $idUsuario
        );
        if ( ! $conn->query($query) ) {
            error_log("Error BD ({$conn->errno}): {$conn->error}");
            return false;
        }
        return true;
    }

    private static function guarda(UsuarioDTO $user)
    {
        if ($user->getId() !== null) {
            return self::actualiza($user);
        }
        return self::inserta($user);
    }

}

