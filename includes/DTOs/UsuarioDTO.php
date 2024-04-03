<?php

class UsuarioDTO {
    private $id;

    private $nombreUsuario;

    private $password;

    private $email;

    private $role;

    public function __construct($nombreUsuario, $password, $email, $role = 0, $id = null)
    {
        $this->setUser($nombreUsuario, $password, $email, $role, $id);
    }

    private function setUser($nombreUsuario, $password, $email, $role = 0, $id = null) {
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

    public function getPassword()
    {
        return $this->password;
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
    
    
    public function borrate()
    {
        if ($this->id !== null) {
            return self::borra($this);
        }
        return false;
    }

    public function addId ($id) {
        if ($this->id === null) {
            $this->id = $id;
        }
    }
}

?>