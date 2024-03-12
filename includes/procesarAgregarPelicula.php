<?php
require_once __DIR__ . '/PeliculaSA.php';
require_once __DIR__ . '/config.php';
require_once RAIZ_APP . '/session_start.php';

// Verifica si se han enviado datos mediante el método POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtiene los datos del formulario
    $ID = $_POST['ID'];
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $director = $_POST['director'];
    $genero = $_POST['genero'];
    $caratula = $_POST['caratula'];

    // Crea una instancia de PeliculaSA
    $peliculaSA = new PeliculaSA();

    // Llama al método crearPelicula con los datos obtenidos del formulario
    $peliculaSA->crearPelicula($ID, $nombre, $descripcion, $director, $genero, $caratula);

    // Redirecciona a alguna página después de procesar los datos, si es necesario
     header('Location: ../estrenos.php');
    // exit;
} else {
    // Si no se han enviado datos mediante POST, redirecciona a alguna página de error
     header('Location: ../estrenos.php');
    // exit;
}