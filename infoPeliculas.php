<?php

require_once __DIR__ . '/includes/config.php';
require_once BASE_APP . '/includes/session_start.php';
require_once __DIR__ . '/includes/SAs/PeliculaSA.php';
require_once __DIR__ . '/includes/DTOs/UsuarioDTO.php';

// Crea una instancia de la clase PeliculaSA
$peliculaSA = new PeliculaSA();

// Verificar si se ha proporcionado un ID de película en la URL
if (isset($_GET['id'])) {
    // Obtener el ID de la película de la URL
    $idPelicula = $_GET['id'];

    // Aquí puedes utilizar $idPelicula para realizar cualquier acción que necesites, como buscar la información de la película en la base de datos, etc.

    // Por ejemplo, puedes utilizar PeliculaSA para obtener la información de la película
    $pelicula = $peliculaSA->obtenerPeliculaPorId($idPelicula);
    $peliculaSA->realizarMedia($pelicula);
    $contenidoPrincipal = '';

    if (isset($_SESSION["user_obj"]) && unserialize($_SESSION["user_obj"])->getRole() == 1) {
        $contenidoPrincipal .= '
        <div class="centro">
            <a href="includes/borrarPelicula.php?id=' . $pelicula->getId() . '"><button class="boton-borrar">Borrar Película</button></a>
            <a href="funcionalidades/modificarPelicula.php?id=' . $pelicula->getId() . '"><button class="boton-borrar">Modificar</button></a>
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
            <p class="info-desc">Valoración: ' . $pelicula->getValoracion() . '</p>
            <iframe width="560" height="315" src="' . $pelicula->getTrailer() . '" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
        </div>
        <div class="rating-container">
            <p>Valoración:</p>
            <div class="rating-stars">';
            // Obtener la valoración de la película
            $valoracion = $pelicula->getValoracion();
            // Redondear la valoración al número entero más cercano
            $valoracionRedondeada = round($valoracion);
            // Mostrar la valoración en forma de estrellas
            for ($i = 1; $i <= 5; $i++) {
                // Si la posición actual es menor o igual que la valoración redondeada, muestra una estrella completa
                if ($i <= $valoracionRedondeada) {
                    $contenidoPrincipal .= '<span>&#9733;</span>';
                } else {
                    // De lo contrario, muestra una estrella vacía
                    $contenidoPrincipal .= '<span>&#9734;</span>';
                }
            }
            $contenidoPrincipal .= '</div>
        </div>';

    if (isset($_SESSION["login"]) && $_SESSION["login"] === true) {
        $contenidoPrincipal .= "<a href='funcionalidades/agregarReseña.php?id=" . $pelicula->getId() . "'><button type='button'>Realizar review</button></a>";
    }

    // Agregar botón "Ver Reviews"
    $contenidoPrincipal .= '<a href="reviewPelicula.php?nombre=' . urlencode($pelicula->getNombre()) . '"><button type="button">Ver Reviews</button></a>';

} else {
    // Si no se proporciona un ID de película en la URL, muestra un mensaje de error o redirecciona a otra página, según lo que necesites.
    echo '<p>Error: No se proporcionó un ID de película.</p>';
}

require BASE_APP . '/includes/vistas/plantillas/plantilla.php';

