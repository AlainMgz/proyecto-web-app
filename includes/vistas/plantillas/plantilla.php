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
		require RAIZ_APP.'/vistas/comun/cabecera.php';
		require RAIZ_APP.'/vistas/comun/buscador.php';
	?>
		<div id="contenedor" style="height: 91%; width: 100%;">
			<?= $contenidoPrincipal ?>
		</div>
	</body>
</html>
