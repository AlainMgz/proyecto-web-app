<?php

require_once __DIR__ . '/includes/config.php';
require_once RAIZ_APP . '/session_start.php';
require_once RAIZ_APP . '/PeliculaSA.php';

// Crea una instancia de la clase PeliculaSA
$peliculaSA = new PeliculaSA();

// Llama a los métodos de la clase según sea necesario
if (isset($_GET['argBusqueda']) && $_GET['argBusqueda'] != '') {
    // Si se proporciona un argumento de búsqueda, ejecutar una búsqueda y mostrar los resultados
    $argBusqueda = $_GET['argBusqueda'];
    $resultadosBusqueda = $peliculaSA->obtenerPeliculaPorNombre($argBusqueda);
    // Generar el contenido principal con los resultados de la búsqueda
    $contenidoPrincipal = '<h1>Resultados de la búsqueda para: ' . $argBusqueda . '</h1>';
    if (!empty($resultadosBusqueda)) {
        $contenidoPrincipal .= '<div class="peliculas">';
        foreach ($resultadosBusqueda as $pelicula) {
            // Mostrar la carátula de la película
            $contenidoPrincipal .= '<img src="' . $pelicula->getCaratula() . '" alt="' . $pelicula->getTitulo() . '">';
        }
        $contenidoPrincipal .= '</div>';
    } else {
        $contenidoPrincipal .= '<p>No se encontraron resultados para la búsqueda.</p>';
    }
} else {
    // Si no se proporciona un argumento de búsqueda, obtener la lista completa de películas
    $listaPeliculas = $peliculaSA->obtenerListaPeliculas();
    // Generar el contenido principal con las carátulas de las películas
    $contenidoPrincipal = '<h1>Lista de películas</h1>';
    if (!empty($listaPeliculas)) {
        $contenidoPrincipal .= '<div class="peliculas">';
        foreach ($listaPeliculas as $pelicula) {
            // Mostrar la carátula de la película
            $contenidoPrincipal .= '<img src="img/' . $pelicula->getCaratula() . '" alt="' . $pelicula->getCaratula() . '" class="caratula">';
        }
        $contenidoPrincipal .= '</div>';
    } else {
        $contenidoPrincipal .= '<p>No hay películas disponibles en este momento.</p>';
    }
}

// Incluir la plantilla principal para mostrar el contenido
require RAIZ_APP . '/vistas/plantillas/plantilla.php';