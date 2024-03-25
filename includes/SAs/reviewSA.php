<?php
require_once __DIR__ . '/../DAOs/reviewDAO.php';
require_once __DIR__ . '/../DTOs/reviewDTO.php';

class ReviewSA
{
    public function __construct()
    {

    }

    public function crearReview($ID, $usuario, $titulo, $critica, $puntuacion, $pelicula)
    {
        $reviewDAO = new reviewDAO();
        $review = new reviewDTO($ID, $usuario, $titulo, $critica, $puntuacion, $pelicula);
        $reviewDAO->crearReview($review);
        return $review;
    }

    public function borrarReview($ID)
    {
        $reviewDAO = new reviewDAO();
        $reviewDAO->borrarReview($ID);
        return true;
    }

    public function modificarReview(ReviewDTO $review)
    {
        $reviewDAO = new reviewDAO();
        $reviewDAO->modificarReview($review);
        
    }

    public function obtenerReviewPorID($id)
    {
        $reviewDAO = new reviewDAO();
        $review = $reviewDAO->obtenerReviewPorID($id);
        return $review;

    }

    public function obtenerReviewPorUsuario($usuario)
    {
        $reviewDAO = new reviewDAO();
        $review = $reviewDAO->obtenerReviewPorUsuario($usuario);
        return $review;
    }

    public function obtenerReviewPorPelicula($pelicula)
    {
        $reviewDAO = new reviewDAO();
        $review = $reviewDAO->obtenerReviewPorPelicula($pelicula);
        return $review;
    }

}
