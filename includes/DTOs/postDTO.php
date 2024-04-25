<?php
class postDTO
{
    public $ID;
    public $usuario; //Nombre del usuario
    public $titulo;
    public $texto;
    public $likes;
    public $esComentario; //booleano que indica si es comentario o no
    public $IDPadre; //ID del padre, si no lo tiene sera -1

    public function __construct($ID, $usuario, $titulo, $texto, $likes, $esComentario, $IDPadre)
    {
        $this->setPost($ID, $usuario, $titulo, $texto, $likes, $esComentario, $IDPadre);
    }

    private function setPost($ID, $usuario, $titulo, $texto, $likes, $esComentario, $IDPadre)
    {
        $this->ID = $ID;
        $this->usuario = $usuario;
        $this->titulo = $titulo;
        $this->texto = $texto;
        $this->likes = $likes;
        $this->esComentario = $esComentario;
        $this->IDPadre = $IDPadre;

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

    public function getEsComentario()
    {
        return $this->esComentario;
    }

    public function getIDPadre()
    {
        return $this->IDPadre;
    }
    public function getPost()
    {
        $valores = array(
            'ID' => $this->ID,
            'usuario' => $this->usuario,
            'titulo' => $this->titulo,
            'texto' => $this->texto,
            'likes' => $this->likes,
            'esComentario' => $this->esComentario,
            'IDPadre' => $this->IDPadre
        );
        return $valores;
    }
}


