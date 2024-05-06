<?php

require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../Formularios/FormularioAgregarReview.php';
require_once __DIR__ . '/../includes/SAs/PeliculaSA.php';
require_once __DIR__ . '/../includes/DTOs/PeliculaDTO.php';


$param = null;

if (isset($_GET['id'])) {
    $param = $_GET['id'];
} elseif (isset($_GET['nombre'])) {
    $peliculaSA = new PeliculaSA();
    $pelicula = $peliculaSA->obtenerPeliculaPorNombre($_GET['nombre']);
    
    // Verificar si la película se encontró antes de obtener su ID
    if ($pelicula) {
        $param = $pelicula->getID();
    } else {
        // Manejar el caso donde la película no se encuentra
        // Puedes redirigir al usuario a una página de error o mostrar un mensaje apropiado
        echo "La película no se encontró en la base de datos.";
        echo $_GET['id'];
        exit; // O detener la ejecución del script si es necesario
    }
}

$form = new FormularioAgregarReview($param);

$htmlFormRegistro = $form->gestiona();
$tituloPagina = 'Agregar reviews';

$contenidoPrincipal = <<<EOS
<h1>Agregar reviews</h1>
$htmlFormRegistro
EOS;

require __DIR__ . '/../includes/vistas/plantillas/plantilla.php';
