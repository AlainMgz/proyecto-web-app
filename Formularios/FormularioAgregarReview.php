<?php
require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/session_start.php';
require_once __DIR__ . '/../includes/SAs/PeliculaSA.php';
$tituloPagina = 'AgregarReview';


$contenidoPrincipal = <<<EOS
    <div class="review-content">
        <div class="review-container">
            <h2>Agregar Review</h2>
            <form action="../includes/Procesamiento/procesarAgregarReview.php" method="post">
                <label for="Título">Nombre:</label>
                <input type="text" id="titulo" name="titulo" required>
                <label for="Critica">Critica:</label>
                <input type="text" id="critica" name="critica" required>
                <label for=Puntuacion">Puntuación:</label>
                <input type="puntuacion" id="puntuacion" name="puntuacion" required>
                <button type="submit">Agregar</button>
            </form>
        </div>
    </div>
    EOS;


require RAIZ_APP . '/vistas/plantillas/plantilla.php';


