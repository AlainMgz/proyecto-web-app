<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>
    <?= $tituloPagina ?>
  </title>
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.10.2/umd/popper.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <link rel="stylesheet" type="text/css" href="<?= RUTA_CSS ?>/estilo.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
    integrity="sha384-..." crossorigin="anonymous">


</head>

<body>
  <?php
  // Incluir la cabecera y el buscador
  require RAIZ_APP . '/vistas/comun/cabecera.php';
  require RAIZ_APP . '/vistas/comun/buscador.php';

  // Definir $pagina con un valor predeterminado si no está definido
  $pagina = isset ($_GET['pagina']) ? intval($_GET['pagina']) : 0;

  $current_url = $_SERVER['REQUEST_URI'];
  ?>

  <!-- Cabecera secundaria -->
  <?php if (isset ($selectGenero)): ?>
    <header class="cabecera_secundaria">
      <?= $selectGenero ?>
    </header>
  <?php endif; ?>

  <!-- Contenido principal -->
  <?= $contenidoPrincipal ?>

  <div id="pagination" class="d-flex justify-content-center align-items-center">
    <button id="prevPage" class="btn btn-outline-secondary mr-2">
      <span aria-hidden="true" class="fas fa-arrow-alt-circle-left"></span>
    </button>
    <div id="pageNumbers" class="mx-3">
      <?= $pagina ?>
    </div>
    <button id="nextPage" class="btn btn-outline-secondary ml-2">
      <span aria-hidden="true" class="fas fa-arrow-alt-circle-right"></span>
    </button>
  </div>

  <!-- Script para manejar la paginación -->
  <script>
    document.addEventListener("DOMContentLoaded", function () {
      var paginaActual = <?= $pagina ?>;
      var currentUrl = "<?= strtok($current_url, '?') ?>"; // Obtener la URL base sin parámetros

      document.getElementById("prevPage").addEventListener("click", function (event) {
        event.preventDefault(); // Evitar el comportamiento predeterminado del enlace
        if (paginaActual > 0) {
          paginaActual--;
          window.location.href = currentUrl + "?pagina=" + paginaActual; // Utiliza "&" en lugar de "?"
        }
      });

      document.getElementById("nextPage").addEventListener("click", function (event) {
        event.preventDefault(); // Evitar el comportamiento predeterminado del enlace
        paginaActual++;
        window.location.href = currentUrl + "?pagina=" + paginaActual; // Utiliza "&" en lugar de "?"
      });
    });
  </script>
</body>

</html>