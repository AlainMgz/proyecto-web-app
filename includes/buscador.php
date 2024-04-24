<?php
// buscar.php

// Incluir tus clases y configuraciones necesarias
require_once __DIR__ . '/config.php';
require_once RAIZ_APP . '/session_start.php';
require_once RAIZ_APP . '/DTOs/PeliculaDTO.php'; // Asegúrate de que esta ruta sea correcta
require_once RAIZ_APP . '/SAs/PeliculaSA.php'; // Asegúrate de que esta ruta sea correcta

// Verificar si se ha proporcionado un término de búsqueda
if (isset($_GET['nombre'])) {
    $term = $_GET['nombre'];
    // Crear una instancia de PeliculaSA (probablemente usando algún tipo de inyección de dependencias o un contenedor)
    $peliculaSA = new PeliculaSA();

    // Realizar la búsqueda de películas utilizando PeliculaSA
    $resultados = $peliculaSA->buscarPeliculasQueEmpecienPor($term);

    // Mostrar los resultados como una cuadrícula
    echo '<div class="row mt-5">';
    foreach ($resultados as $pelicula) {
        echo '<div class="col-md-3 mb-4">';
        echo '<a href="infoPeliculas.php?id=' . $pelicula->getId() . '">';
        echo '<img src="img/' . $pelicula->getCaratula() . '" alt="' . $pelicula->getCaratula() . '" class="img-fluid caratula">';
        echo '</a>';
        echo '<p>' . $pelicula->getNombre() . '</p>';
        echo '</div>';
    }
    echo '</div>';
}
