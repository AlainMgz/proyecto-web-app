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
        $query = "SELECT * FROM users WHERE username=?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $nombreUsuario);
        $stmt->execute();
        $rs = $stmt->get_result();
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
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $rs = $stmt->get_result();
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

        $checkQuery = "SELECT * FROM users WHERE username = ? OR email = ?";
        $stmt = $conn->prepare($checkQuery);
        $stmt->bind_param("ss", $usuario->getNombreUsuario(), $usuario->getEmail());
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // User already exists
            echo "User with the provided username or email already exists.";
            return false;
        } else {
            $insertQuery = "INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($insertQuery);
            $stmt->bind_param("sssi", $usuario->getNombreUsuario(), $usuario->getEmail(), $usuario->getPassword(), $usuario->getRole());
            if ($stmt->execute()) {
                $usuario->addId($stmt->insert_id);
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
        $query = "UPDATE users SET username = ?, email = ?, password = ? WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("sssi", $usuario->getNombreUsuario(), $usuario->getEmail(), self::hashPassword($usuario->getPassword()), $usuario->getId());
        if ($stmt->execute()) {
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
        $query = "DELETE FROM users WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $idUsuario);
        if (!$stmt->execute()) {
            error_log("Error BD ({$stmt->errno}): {$stmt->error}");
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

