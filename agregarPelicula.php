<?php

require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/Formularios/FormularioAgregarPeliculas.php';

$form = new FormularioAgregarPeliculas();
$htmlFormRegistro = $form->gestiona();
$tituloPagina = 'Agregar peliculas';

$contenidoPrincipal = <<<EOS
<h1>Agregar peliculas</h1>
$htmlFormRegistro
EOS;

require __DIR__.'/includes/vistas/plantillas/plantilla.php';
