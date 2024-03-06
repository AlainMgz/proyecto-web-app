<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
    <title><?= $tituloPagina ?></title>
    <link rel="stylesheet" type="text/css" href="css/estilo.css" />
</head>
<body>
<div id="contenedor">
<?php
include(RAIZ_APP.'/vistas/comun/cabecera.php');
?>
<div id = "buscador-container"> <?php include(RAIZ_APP.'/vistas/comun/buscador.php');?></div> 

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
