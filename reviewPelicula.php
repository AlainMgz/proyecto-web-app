<?php
require_once __DIR__ . '/includes/config.php';
require_once BASE_APP . '/includes/session_start.php';
require_once __DIR__ . '/includes/SAs/PeliculaSA.php';
require_once __DIR__ . '/includes/SAs/reviewSA.php';
require_once __DIR__ . '/includes/reviewsPlantilla.php'; // Incluir la plantilla de reviews

$paginaActual = isset($_GET['pagina']) ? $_GET['pagina'] : 0;
$reviewSA = new ReviewSA();
$nombre = $_GET['nombre'];
$reviews = $reviewSA->obtener5ReviewsPorPelicula($paginaActual * 5,$nombre);

// Mostrar las primeras 5 revisiones
$num_reviews_mostrar = 5;

// Crear el contenido de la página usando la plantilla de reviews
$contenidoPrincipal = '<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Primeras 5 Revisiones</title>
</head>
<body>
    <h1>Últimas reviews</h1>';

$contenidoPrincipal .= renderizarReviews($reviews); // Renderizar las reviews usando la plantilla

$contenidoPrincipal .= '
</body>
</html>';

require BASE_APP . '/includes/vistas/plantillas/plantillaPaginacion.php';

