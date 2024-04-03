<?php
require_once __DIR__ . '/includes/config.php';
require_once RAIZ_APP . '/session_start.php';
require_once __DIR__ . '/includes/SAs/PeliculaSA.php';
require_once __DIR__ . '/includes/SAs/reviewSA.php';

$paginaActual = isset($_GET['pagina']) ? $_GET['pagina'] : 0;
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
<div id="pagination">
<button id="prevPage">&#9664;</button>
<div id="pageNumbers">'.($paginaActual + 1).'</div>
<button id="nextPage">&#9654;</button>
</div>
';

$contenidoPrincipal .= '
</body>
</html>';

require RAIZ_APP . '/vistas/plantillas/plantilla.php';

?>
<script>
document.addEventListener("DOMContentLoaded", function() {
  var paginaActual = <?php echo $paginaActual; ?>;

  document.getElementById("prevPage").addEventListener("click", function() {
    if (paginaActual > 0) {
      paginaActual--;
      window.location.href =  "lastReviews.php?pagina=" + paginaActual;
    }
  });

  document.getElementById("nextPage").addEventListener("click", function() {
    paginaActual++;
    window.location.href = "lastReviews.php?pagina=" + paginaActual;
  });
});
</script>
