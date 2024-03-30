<?php
require_once __DIR__ . '/includes/config.php';
require_once RAIZ_APP . '/session_start.php';
require_once __DIR__ . '/includes/SAs/PeliculaSA.php';
require_once __DIR__ . '/includes/SAs/reviewSA.php';

$reviewSA = new ReviewSA();
$reviews = $reviewSA->obtenerReviewPorPelicula($_GET['nombre']);

// Mostrar las primeras 5 revisiones
$num_reviews_mostrar = 5;
$reviews_mostradas = array_slice($reviews, 0, $num_reviews_mostrar);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reviews de la película <?php echo $_GET['nombre']; ?></title>
    
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
    <h1>Primeras 5 Revisiones</h1>
    <?php foreach ($reviews_mostradas as $review): ?>
        <div class="review">
            <h2><?php echo $review->titulo; ?></h2>
            <p><strong>Usuario:</strong> <?php echo $review->usuario; ?></p>
            <p><strong>Critica:</strong> <?php echo $review->critica; ?></p>
            <p><strong>Puntuación:</strong> <?php echo $review->puntuacion; ?></p>
            <p><strong>Película:</strong> <?php echo $review->pelicula; ?></p>
        </div>
    <?php endforeach; ?>
</body>
</html>
