<?php

require_once __DIR__ . '/includes/config.php';
require_once RAIZ_APP . '/session_start.php';
require_once RAIZ_APP . '/PeliculaSA.php';

// Crea una instancia de la clase PeliculaSA
$peliculaSA = new PeliculaSA();
// Verificar si se ha proporcionado un ID de película en la URL
if (isset($_GET['id'])) {
    // Obtener el ID de la película de la URL
    $idPelicula = $_GET['id'];

    // Aquí puedes utilizar $idPelicula para realizar cualquier acción que necesites, como buscar la información de la película en la base de datos, etc.

    // Por ejemplo, puedes utilizar PeliculaSA para obtener la información de la película
    $pelicula = $peliculaSA->obtenerPeliculaPorId($idPelicula);

    if(isset($_SESSION["esAdmin"]) && $_SESSION["esAdmin"] === true) {
        
        $contenidoPrincipal = '
        <div class="centro">
        <a href="includes/borrarPelicula.php?id=' . $pelicula->getId() . '"><button class="boton-borrar">Borrar Película</button></a>
        </div>
        ';
    }

    $contenidoPrincipal .= '
    <div class="info-container">
        <img src="img/' . $pelicula->getCaratula() . '" alt="' . $pelicula->getNombre() . '" class="info-img">
        <div class="info-text">
            <h1 class="info-titulo">' . $pelicula->getNombre() . '</h1>
            <p class="info-director">Director: ' . $pelicula->getDirector() . '</p>
            <p class="info-genero">Género: ' . $pelicula->getGenero() . '</p>
            <p class="info-desc">Descripción: ' . $pelicula->getDescripcion() . '</p>
            <iframe width="560" height="315" src="" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            
        </div>
            
    </div>
    <div class="rating">
                <input type="radio" id="star5" name="rating" value="5">
                <label for="star5">&#9733;</label>
                <input type="radio" id="star4" name="rating" value="4">
                <label for="star4">&#9733;</label>
                <input type="radio" id="star3" name="rating" value="3">
                <label for="star3">&#9733;</label>
                <input type="radio" id="star2" name="rating" value="2">
                <label for="star2">&#9733;</label>
                <input type="radio" id="star1" name="rating" value="1">
                <label for="star1">&#9733;</label>
    </div>';
} else {
    // Si no se proporciona un ID de película en la URL, muestra un mensaje de error o redirecciona a otra página, según lo que necesites.
    echo '<p>Error: No se proporcionó un ID de película.</p>';
}

require RAIZ_APP . '/vistas/plantillas/plantilla.php';

