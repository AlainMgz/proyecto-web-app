<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
    <title><?= $tituloPagina ?></title>
    <link rel="stylesheet" type="text/css" href="<?= RUTA_CSS ?>/estilo.css" />
</head>
<body>
<div id="contenedor">
<?php
include(RAIZ_APP.'/vistas/comun/cabecera.php');
include(RAIZ_APP.'/vistas/comun/buscador.php');
?>
	<main>
		<article>
			<?= $contenidoPrincipal ?>
		</article>
	</main>
<?php

?>
</div>
</body>
</html>
