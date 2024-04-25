<?php
class blogDTO
{
    public $ID;
    public $usuario; //Nombre del usuario
    public $titulo;
    public $texto;
    public $likes;

    public function __construct($ID, $usuario, $titulo, $texto, $likes)
    {
        $this->setPost($ID, $usuario, $titulo, $texto, $likes);
    }

    private function setPost($ID, $usuario, $titulo, $texto, $likes)
    {
        $this->ID = $ID;
        $this->usuario = $usuario;
        $this->titulo = $titulo;
        $this->texto = $texto;
        $this->likes = $likes;
  
    }

    public function getID()
    {
        return $this->ID;
    }

    public function getUsuario()
    {
        return $this->usuario;
    }

    public function getTitulo()
    {
        return $this->titulo;
    }

    public function getTexto()
    {
        return $this->texto;
    }

    public function getLikes()
    {
        return $this->likes;
    }

    public function getPost()
    {
        $valores = array(
            'ID' => $this->ID,
            'usuario' => $this->usuario,
            'titulo' => $this->titulo,
            'texto' => $this->texto,
            'likes' => $this->likes
          
        );
        return $valores;
    }
}


