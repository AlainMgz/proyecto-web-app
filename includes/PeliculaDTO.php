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

    public function getPelicula() {
        return array(
            'ID' => $this->ID,
            'nombre' => $this->nombre,
            'descripcion' => $this->descripcion,
            'director' => $this->director,
            'genero' => $this->genero,
            'caratula' => $this->caratula
        );
    }
}
