<?php
class PeliculaDTO {
    public $ID;
    public $nombre;
    public $descripcion;
    public $director;
    public $genero;
    public $caratula;

    public $trailer;

    public function __construct($ID, $nombre, $descripcion, $director, $genero, $caratula, $trailer) {
        $this->setPelicula($ID, $nombre, $descripcion, $director, $genero, $caratula, $trailer);
    }

    private function setPelicula($ID, $nombre, $descripcion, $director, $genero, $caratula, $trailer) {
        $this->ID = $ID;
        $this->nombre = $nombre;
        $this->descripcion = $descripcion;
        $this->director = $director;
        $this->genero = $genero;
        $this->caratula = $caratula;
        $this->trailer = $trailer;
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
            $valores = array(
                'ID' => $this->ID,
                'nombre' => $this->nombre,
                'descripcion' => $this->descripcion,
                'director' => $this->director,
                'genero' => $this->genero,
                'caratula' => $this->caratula
            );
            return $valores;
        
    }

    public function getTrailer() {
        return $this->trailer;
    }
}


