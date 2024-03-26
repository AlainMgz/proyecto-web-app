<?php

class Usuario
{

    public const ADMIN_ROLE = 1;

    public const USER_ROLE = 0;

    public const MOD_ROLE = 2;

    public static function login($nombreUsuario, $password)
    {
        $usuario = self::buscaUsuario($nombreUsuario);
        if ($usuario && $usuario->compruebaPassword($password)) {
            return $usuario;
        }
        echo "user not found or incorrect password";
        return false;
    }
    
    public static function crea($nombreUsuario, $password, $email, $role)
    {
        $user = new Usuario($nombreUsuario, self::hashPassword($password), $email, $role);
        return $user->guarda();
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
                $result = new Usuario($fila['username'], $fila['password'], $fila['email'], $fila['role'], $fila['id']);
            } else {
                echo "user not found\n";
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
                $result = new Usuario($fila['username'], $fila['password'], $fila['email'], $fila['role'], $fila['id']);
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
   
    private static function inserta($usuario)
    {
        $conn = Aplicacion::getInstance()->getConexionBd();

        $checkQuery = sprintf("SELECT * FROM users WHERE username = '%s' OR email = '%s'"
            , $conn->real_escape_string($usuario->nombreUsuario)
            , $conn->real_escape_string($usuario->email));
        $result = $conn->query($checkQuery);

        if ($result->num_rows > 0) {
            // User already exists
            echo "User with the provided username or email already exists.";
            return false;
        } else {
            $query=sprintf("INSERT INTO users (username, email, password, role) VALUES ('%s', '%s', '%s', %d)"
                , $conn->real_escape_string($usuario->nombreUsuario)
                , $conn->real_escape_string($usuario->email)
                , $usuario->password
                , $usuario->role
            );
            if ( $conn->query($query) ) {
                $usuario->id = $conn->insert_id;
                return $usuario;
            } else {
                error_log("Error BD ({$conn->errno}): {$conn->error}");
                return false;
            }
        }

        
    }
    
    private static function actualiza($usuario)
    {
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query=sprintf("UPDATE users SET username = '%s', email='%s', password='%s' WHERE id=%d"
            , $conn->real_escape_string($usuario->nombreUsuario)
            , $conn->real_escape_string($usuario->nombre)
            , $conn->hashPassword($usuario->password)
            , $usuario->id
        );
        if ( $conn->query($query) ) {
            return true;
        } else {
            error_log("Error BD ({$conn->errno}): {$conn->error}");
            return false;
        }
    }
   
    
    private static function borra($usuario)
    {
        return self::borraPorId($usuario->id);
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

    private $id;

    private $nombreUsuario;

    private $password;

    private $email;

    private $role;

    private function __construct($nombreUsuario, $password, $email, $role = 0, $id = null)
    {
        $this->id = $id;
        $this->nombreUsuario = $nombreUsuario;
        $this->password = $password;
        $this->email = $email;
        $this->role = $role;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getNombreUsuario()
    {
        return $this->nombreUsuario;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getRole()
    {
        return $this->role;
    }

    public function compruebaPassword($password)
    {
        return password_verify($password, $this->password);
    }

    public function cambiaPassword($nuevoPassword)
    {
        $this->password = self::hashPassword($nuevoPassword);
    }
    
    public function guarda()
    {
        if ($this->id !== null) {
            return self::actualiza($this);
        }
        return self::inserta($this);
    }
    
    public function borrate()
    {
        if ($this->id !== null) {
            return self::borra($this);
        }
        return false;
    }
}
