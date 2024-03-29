<?php
require_once __DIR__ . '/../SAs/ReviewSA.php';
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../session_start.php';

// Verifica si se han enviado datos mediante el método POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtiene los datos del formulario
    $titulo = $_POST['titulo'];
    $usuario = $_POST['usuario'];
    $critica = $_POST['critica'];
    $puntuacion = $_POST['puntuacion'];
    $pelicula = $_POST['pelicula'];

    // Crea una instancia de PeliculaSA
    $reviewSA = new reviewSA();

    // Llama al método crearPelicul a con los datos obtenidos del formulario
    $reviewSA->crearReview($ID, $usuario, $titulo, $critica, $puntuacion, $pelicula);

    // Redirecciona a alguna página después de procesar los datos, si es necesario
     header('Location: ../../index.php');
    // exit;
} else {
    // Si no se han enviado datos mediante POST, redirecciona a alguna página de error
     header('Location: ../../index.php');
    // exit;
}