<?php
require_once __DIR__ . '/includes/config.php';
require_once RAIZ_APP . '/session_start.php';
require_once __DIR__ . '/includes/SAs/PeliculaSA.php';
require_once __DIR__ . '/includes/SAs/reviewSA.php';
require_once RAIZ_APP.'/DTOs/UsuarioDTO.php';

$reviewSA = new ReviewSA();
$username = unserialize($_SESSION['user_obj'])->getNombreUsuario();
$reviews = $reviewSA->obtenerReviewPorUsuario($username);

// Mostrar las primeras 5 revisiones
$num_reviews_mostrar = 5;
$reviews_mostradas = array_slice($reviews, 0, $num_reviews_mostrar);

// Construir el contenido principal
$contenidoPrincipal = '<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reviews de  ' . $username. '</title>
    <style>
        /* Estilos CSS */
        .review {
            margin-bottom: 20px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .review h2 {
            margin-top: 0;
        }
        .review p {
            margin-bottom: 5px;
        }
    </style>
</head>
<body>
    <h1>Reviews de ' . $username . '</h1>';

foreach ($reviews_mostradas as $review) {
    $contenidoPrincipal .= '
        <div class="review">
            <h2>' . $review->titulo . '</h2>
            <p><strong>Usuario:</strong> ' . $review->usuario . '</p>
            <p><strong>Critica:</strong> ' . $review->critica . '</p>
            <p><strong>Puntuación:</strong> ' . $review->puntuacion . '</p>
            <p><strong>Película:</strong> ' . $review->pelicula . '</p>
        </div>';
}

$contenidoPrincipal .= '
</body>
</html>';

require RAIZ_APP . '/vistas/plantillas/plantilla.php';