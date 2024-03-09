<?php
require_once __DIR__. '/PeliculaDAO.php';
require_once __DIR__. '/PeliculaDTO.php';
class PeliculaSA{
public function __construct(){

}

public function crearPelicula($ID, $nombre, $descripcion, $director, $genero, $caratula){
    $peliculaDAO= new PeliculaDAO();
    $pelicula= new PeliculaDTO($ID, $nombre, $descripcion, $director, $genero,$caratula);
    $peliculaDAO->crearPelicula($pelicula);
    return $pelicula;
}

public function borrarPelicula($ID){
$peliculaDAO= new PeliculaDAO();
$peliculaDAO->borrarPelicula($ID);
return true;
}

public function modificarPelicula(PeliculaDTO $pelicula){
$peliculaDAO= new PeliculaDAO();
$peliculaDAO->borrarPelicula($pelicula->ID);
$peliculaDAO->crearPelicula($pelicula);
}
}