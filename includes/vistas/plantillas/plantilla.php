<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $tituloPagina ?></title>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.10.2/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="<?= RUTA_CSS ?>/estilo.css" />
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>
    <?php
    require RAIZ_APP . '/vistas/comun/cabecera.php';
    require RAIZ_APP . '/vistas/comun/buscador.php';
    ?>
    <!-- Cabecera secundaria -->
	<?php if (isset($selectGenero)) : ?>
        <header class="cabecera_secundaria">
            <?= $selectGenero ?>
        </header>
    <?php endif; ?>
        <?= $contenidoPrincipal ?>
    </div>
</body>
</html>
