<?php
require_once __DIR__ . '/includes/config.php';
require_once BASE_APP . '/includes/session_start.php';
require_once __DIR__ . '/includes/SAs/PeliculaSA.php';
require_once __DIR__ . '/includes/SAs/reviewSA.php';
require_once __DIR__ . '/includes/vistas/plantillas/reviewsPlantilla.php'; // Incluir la plantilla de reviews
require_once BASE_APP.'/includes/DTOs/UsuarioDTO.php';

$pagina = isset($_GET['pagina']) ? $_GET['pagina'] : 0;
$paginaActual = $pagina;// Usar el operador de fusión de null para proporcionar un valor predeterminado
$reviewSA = new ReviewSA();
$reviews = $reviewSA->obtener5Reviews($paginaActual * 5);

// Mostrar las primeras 5 revisiones
$num_reviews_mostrar = 5;
$reviews_mostradas = array_slice($reviews, 0, $num_reviews_mostrar);

$contenidoPrincipal = '<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Primeras 5 Revisiones</title>
</head>
<body>
    <h1>Últimas reviews</h1>';

$contenidoPrincipal .= renderizarReviews($reviews_mostradas); // Renderizar las reviews usando la plantilla

$contenidoPrincipal .= '
</body>
</html>';

require BASE_APP . '/includes/vistas/plantillas/plantillaPaginacion.php';

