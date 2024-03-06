<?php

require_once __DIR__.'/includes/config.php';

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

require __DIR__.'/includes/vistas/plantillas/plantilla.php';





