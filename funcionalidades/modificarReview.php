<?php

require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../Formularios/FormularioModificarReview.php';

$form = new FormularioModificarReview($_GET['id']);


$htmlFormRegistro = $form->gestiona();
$tituloPagina = 'Modificar reviews';

$contenidoPrincipal = <<<EOS
<h1>Modificar reviews</h1>
$htmlFormRegistro
EOS;

require __DIR__ . '/../includes/vistas/plantillas/plantilla.php';
