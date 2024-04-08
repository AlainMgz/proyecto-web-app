<?php
require_once __DIR__ . '/includes/config.php';
require_once RAIZ_APP . '/session_start.php';
require_once __DIR__ . '/includes/SAs/PeliculaSA.php';
require_once __DIR__ . '/includes/SAs/reviewSA.php';
require_once __DIR__ . '/includes/vistas/plantillas/reviewsPlantilla.php'; // Incluir la plantilla de reviews

$paginaActual = isset($_GET['pagina']) ? $_GET['pagina'] : 0;
$reviewSA = new ReviewSA();
$nombre = $_GET['nombre'];
$reviews = $reviewSA->obtener5ReviewsPorPelicula(0,$nombre);

// Mostrar las primeras 5 revisiones
$num_reviews_mostrar = 5;
$reviews_mostradas = array_slice($reviews, 0, $num_reviews_mostrar);

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

$contenidoPrincipal .= renderizarReviews($reviews_mostradas); // Renderizar las reviews usando la plantilla

$contenidoPrincipal .= '
<div id="pagination">
    <button id="prevPage">&#9664;</button>
    <div id="pageNumbers">' . ($paginaActual + 1) . '</div>
    <button id="nextPage">&#9654;</button>
</div>';

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
