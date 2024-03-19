<?php
class reviewDTO
{
    public $ID;
    public $usuario;
    public $titulo;
    public $critica;
    public $puntuacion;

    public $pelicula;

    public function __construct($ID, $usuario, $titulo, $critica, $puntuacion, $pelicula)
    {
        $this->setPelicula($ID, $usuario, $titulo, $critica, $puntuacion, $pelicula);
    }

    private function setReview($ID, $usuario, $titulo, $critica, $puntuacion, $pelicula)
    {
        $this->ID = $ID;
        $this->usuario = $usuario;
        $this->titulo = $titulo;
        $this->critica = $critica;
        $this->puntuacion = $puntuacion;
        $this->pelicula = $pelicula;
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

    public function getCritica()
    {
        return $this->critica;
    }

    public function getPuntuacion()
    {
        return $this->puntuacion;
    }
    public function getPelicula()
    {
        return $this->pelicula;

    }

}


