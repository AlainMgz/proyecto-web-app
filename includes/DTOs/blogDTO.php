<?php
class PeliculaDTO
{
    public $ID;
    public $IDusuario;
    public $titulo;
    public $contenido;
    public $likes;
    public $comentarios;

    public function __construct($ID, $IDusuario, $titulo, $contenido, $likes, $comentario)
    {
        $this->setBlog($ID, $IDusuario, $titulo, $contenido, $likes, $comentario);
    }

    private function setBlog($ID, $IDusuario, $titulo, $contenido, $likes, $comentario)
    {
        $this->ID = $ID;
        $this->IDusuario = $IDusuario;
        $this->titulo = $titulo;
        $this->contenido = $contenido;
        $this->likes = $likes;
        $this->comentario = $comentario;
    }

    public function getID()
    {
        return $this->ID;
    }

    public function getIDUsuario() //Id del usuario
    {
        return $this->IDusuario;
    }

    public function getTitulo()
    {
        return $this->titulo;
    }

    public function getContenido()
    {
        return $this->contenido;
    }

    public function getComentario()
    {
        return $this->comentarios;
    }


    public function getBlog()
    {
        $valores = array(
            'ID' => $this->ID,
            'IDUsuario' => $this->IDusuario,
            'titulo' => $this->titulo,
            'contenido' => $this->contenido,
            'comentario' => $this->comentarios

        );
        return $valores;

    }


}