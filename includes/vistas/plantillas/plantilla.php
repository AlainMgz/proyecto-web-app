<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $tituloPagina ?></title>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link rel="stylesheet" type="text/css" href="<?= RUTA_CSS ?>/estilo.css" />
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
