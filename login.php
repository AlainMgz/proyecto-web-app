<?php

require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/Formularios/FormularioLogin.php';

$form = new FormularioLogin();
$htmlFormRegistro = $form->gestiona();
$tituloPagina = 'Registro';

$contenidoPrincipal = <<<EOS
<h1>Login</h1>
$htmlFormRegistro
EOS;

require __DIR__ . '/includes/vistas/plantillas/plantilla.php';