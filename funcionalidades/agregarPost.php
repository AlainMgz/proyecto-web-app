<?php

require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../Formularios/FormularioAgregarPost.php';

$form = new FormularioAgregarPost();
$htmlFormRegistro = $form->gestiona();
$tituloPagina = 'Agregar post';

$contenidoPrincipal = <<<EOS
<h1>Agregar post</h1>
$htmlFormRegistro
EOS;

require __DIR__ . '/../includes/vistas/plantillas/plantilla.php';
