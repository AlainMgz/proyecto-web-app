<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../DAOs/peliculaDAO.php';
require_once __DIR__ . '/../DTOs/PeliculaDTO.php';
require_once __DIR__ . '/../DAOs/reviewDAO.php';
class PeliculaSA
{
    public function __construct()
    {

    }

    public function crearPost($ID, $nombre, $descripcion, $director, $genero, $caratula, $trailer)
    {
        $peliculaDAO = new PeliculaDAO();
        $pelicula = new PeliculaDTO($ID, $nombre, $descripcion, $director, $genero, $caratula, $trailer,0,0);
        $peliculaDAO->crearPelicula($pelicula);
        return $pelicula;
    }

    
}

