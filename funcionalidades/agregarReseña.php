<?php

require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../Formularios/FormularioAgregarReview.php';

$form = new FormularioAgregarReview($_GET['id']);
$htmlFormRegistro = $form->gestiona();
$tituloPagina = 'Agregar reviews';

$contenidoPrincipal = <<<EOS
<h1>Agregar reviews</h1>
$htmlFormRegistro
EOS;

require __DIR__ . '/../includes/vistas/plantillas/plantilla.php';
