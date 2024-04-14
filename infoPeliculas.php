<?php
require_once __DIR__ . '/includes/config.php';
require_once RAIZ_APP . '/session_start.php';
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
        <div class="container text-center mb-4">
            <a href="includes/borrarPelicula.php?id=' . $pelicula->getId() . '"><button class="btn btn-danger">Borrar Película</button></a>
            <a href="funcionalidades/modificarPelicula.php?id=' . $pelicula->getId() . '"><button class="btn btn-primary ml-2">Modificar</button></a>
        </div>
        ';
    }

    $contenidoPrincipal .= '
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <img src="img/' . $pelicula->getCaratula() . '" alt="' . $pelicula->getNombre() . '" class="img-fluid">
            </div>
            <div class="col-md-8">
                <h1>' . $pelicula->getNombre() . '</h1>
                <p><strong>Director:</strong> ' . $pelicula->getDirector() . '</p>
                <p><strong>Género:</strong> ' . $pelicula->getGenero() . '</p>
                <p><strong>Descripción:</strong> ' . $pelicula->getDescripcion() . '</p>
                <p><strong>Valoración:</strong> ' . $pelicula->getValoracion() . '</p>
                <iframe width="100%" height="315" src="' . $pelicula->getTrailer() . '" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
            </div>
        </div>
    </div>
    <div class="container text-center mt-4">
        <div class="rating-container">
            <p><strong>Valoración:</strong></p>
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
        </div>
        
        <div class="row justify-content-center mt-4">
            <div class="col-md-4">
                <a href="funcionalidades/agregarReseña.php?id=' . $pelicula->getId() . '" class="btn btn-success btn-block">Realizar review</a>
            </div>
            <div class="col-md-4">
                <a href="reviewPelicula.php?nombre=' . urlencode($pelicula->getNombre()) . '" class="btn btn-primary btn-block">Ver Reviews</a>
            </div>
        </div>
    </div>';
} else {
    // Si no se proporciona un ID de película en la URL, muestra un mensaje de error o redirecciona a otra página, según lo que necesites.
    echo '<p>Error: No se proporcionó un ID de película.</p>';
}

require RAIZ_APP . '/vistas/plantillas/plantilla.php';
?>
