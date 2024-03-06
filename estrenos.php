<?php

require_once __DIR__.'/includes/config.php';
require_once RAIZ_APP.'/session_start.php';

$tituloPagina = 'Portada';

if (isset($_GET['argBusqueda']) != null) {

    $contenidoPrincipal = <<<EOS
    <h1>Resultados de la búsqueda</h1>
    EOS;
} else {

    $contenidoPrincipal = <<<EOS
    <h1>estrenos</h1>
    EOS;

}

require RAIZ_APP.'/vistas/plantillas/plantilla.php';





