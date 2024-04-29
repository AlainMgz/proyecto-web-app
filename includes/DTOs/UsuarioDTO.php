<?php

class UsuarioDTO {
    private $id;

    private $nombreUsuario;

    private $password;

    private $email;

    private $role;

    private $followers = [];

    private $following = [];

    public function __construct($nombreUsuario, $password, $email, $role = 0, $id = null, $followers = [], $following = [])
    {
        $this->setUser($nombreUsuario, $password, $email, $role, $id, $followers, $following);
    }

    private function setUser($nombreUsuario, $password, $email, $role = 0, $id = null, $followers = [], $following = []) {
        $this->id = $id;
        $this->nombreUsuario = $nombreUsuario;
        $this->password = $password;
        $this->email = $email;
        $this->role = $role;
        $this->followers = $followers;
        $this->following = $following;
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

    public function getFollowers()
    {
        return $this->followers;
    }

    public function getFollowing()
    {
        return $this->following;
    }

    public function compruebaPassword($password)
    {  
        $password_check = password_verify($password, $this->password);
        return $password_check;
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
