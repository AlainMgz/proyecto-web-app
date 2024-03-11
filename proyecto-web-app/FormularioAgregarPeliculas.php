<?php
require_once __DIR__ . '/includes/config.php';
require_once RAIZ_APP . '/session_start.php';
require_once __DIR__ . '/includes/PeliculaSA.php';
$tituloPagina = 'AgregarPelicula';


$contenidoPrincipal = <<<EOS
    <div class="film-content">
        <div class="film-container">
            <h2>Agregar Pelicula</h2>
            <form action="includes/procesarAgregarPelicula.php" method="post">
            <label for="ID">ID:</label>
                <input type="text" id="ID" name="ID" required>
                <label for="Nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" required>
                <label for="Descripcion">Descripcion:</label>
                <input type="text" id="descripcion" name="descripcion" required>
                <label for="Director">Director:</label>
                <input type="director" id="director" name="director" required>
                <label for="Genero">Genero:</label>
                <input type="genero" id="genero" name="genero" required>
                <label for="Caratula">Caratula:</label>
                <input type="caratula" id="caratula" name="caratula" required>
                <button type="submit">Agregar</button>
            </form>
        </div>
    </div>
    EOS;


require RAIZ_APP . '/vistas/plantillas/plantilla.php';


