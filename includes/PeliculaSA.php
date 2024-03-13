<?php
require_once __DIR__ . '/PeliculaDAO.php';
require_once __DIR__ . '/PeliculaDTO.php';
class PeliculaSA
{
    public function __construct()
    {

    }

    public function crearPelicula($ID, $nombre, $descripcion, $director, $genero, $caratula, $trailer)
    {
        $peliculaDAO = new PeliculaDAO();
        $pelicula = new PeliculaDTO($ID, $nombre, $descripcion, $director, $genero, $caratula, $trailer);
        $peliculaDAO->crearPelicula($pelicula);
        return $pelicula;
    }

    public function borrarPelicula($ID)
    {
        $peliculaDAO = new PeliculaDAO();
        $peliculaDAO->borrarPelicula($ID);
        return true;
    }

    public function modificarPelicula(PeliculaDTO $pelicula)
    {
        $peliculaDAO = new PeliculaDAO();
        $peliculaDAO->modificarPelicula($pelicula);
        
    }

    public function obtenerPeliculaPorID($id)
    {
        $peliculaDAO = new PeliculaDAO();
        $pelicula = $peliculaDAO->obtenerPeliculaPorID($id);
        return $pelicula;

    }

    public function obtenerPeliculaPorNombre($nombre)
    {
        $peliculaDAO = new PeliculaDAO();
        $pelicula = $peliculaDAO->obtenerPeliculaPorNombre($nombre);
        return $pelicula;
    }

    public function filtrarPeliculasPorGenero($genero)
    {
        $peliculaDAO = new PeliculaDAO();
        $peliculas = $peliculaDAO->filtrarPeliculasPorGenero($genero);
        return $peliculas;
    }

    public function obtenerListaPeliculas()
    {
        $peliculaDAO = new PeliculaDAO();
        $pelicula = $peliculaDAO->obtenerListaPeliculas();
        return $pelicula;
    }
}

