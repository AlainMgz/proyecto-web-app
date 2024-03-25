<?php

require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/Formularios/FormularioModificarPeliculas.php';

$form = new FormularioModificarPeliculas($_GET['id']);
$htmlFormRegistro = $form->gestiona();
$tituloPagina = 'Modificar peliculas';

$contenidoPrincipal = <<<EOS
<h1>Modificar peliculas</h1>
$htmlFormRegistro
EOS;

require __DIR__.'/includes/vistas/plantillas/plantilla.php';
