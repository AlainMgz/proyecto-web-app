<?php

require_once __DIR__ . '/includes/config.php';
require_once RAIZ_APP . '/session_start.php';
require_once RAIZ_APP . '/PeliculaSA.php';

// Crea una instancia de la clase PeliculaSA
$peliculaSA = new PeliculaSA();

// Llama a los métodos de la clase según sea necesario

if (isset($_GET['argBusqueda']) != null) {

    $contenidoPrincipal = <<<EOS
    <h1>Resultados de la búsqueda</h1>
    
    EOS;

} else {
    $contenidoPrincipal = <<<EOS
    <h1>estrenos</h1>
    <form method="post" action="FormularioAgregarPeliculas.php">
        <button type="submit">Agregar pelicula</button>
    </form>
    EOS;

   if(isset($_GET['admin']) ) {
    $contenidoPrincipal = <<<EOS
    <form method="post" action="FormularioAgregarPeliculas.php">
        <button type="submit">Agregar pelicula</button>
    </form>
    EOS;
   }
}

require RAIZ_APP . '/vistas/plantillas/plantilla.php';





