<?php
class PeliculaDTO {
    public $ID;
    public $nombre;
    public $descripcion;
    public $director;
    public $genero;
    public $caratula;

    public function __construct($ID, $nombre, $descripcion, $director, $genero, $caratula) {
        $this->setPelicula($ID, $nombre, $descripcion, $director, $genero, $caratula);
    }

    private function setPelicula($ID, $nombre, $descripcion, $director, $genero, $caratula) {
        $this->ID = $ID;
        $this->nombre = $nombre;
        $this->descripcion = $descripcion;
        $this->director = $director;
        $this->genero = $genero;
        $this->caratula = $caratula;
    }

    public function getID() {
        return $this->ID;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getDescripcion() {
        return $this->descripcion;
    }

    public function getDirector() {
        return $this->director;
    }

    public function getGenero() {
        return $this->genero;
    }

    public function getCaratula() {
        return $this->caratula;
    }

    public function getPelicula() {
        return $this;
    }
}
?>
