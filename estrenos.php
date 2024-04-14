<?php
require_once __DIR__ . '/includes/config.php';
require_once BASE_APP . '/includes/session_start.php';
require_once __DIR__ . '/includes/DTOs/UsuarioDTO.php';
require_once __DIR__ . '/includes/SAs/PeliculaSA.php';

// Crear una instancia de la clase PeliculaSA
$peliculaSA = new PeliculaSA();
$tituloPagina = "Estrenos";

// Obtener el género seleccionado
$genero = isset($_POST['gen']) ? $_POST['gen'] : 'Todos';

// Obtener la lista de géneros y construir el selector de género
$generos = $peliculaSA->getGeneros();
$selectGenero = '<form method="post" action=""><p>Genero: <select id="gen" name="gen"><option value="Todos">Todos</option>';
foreach ($generos as $generoItem) {
    $selectGenero .= "<option value=\"$generoItem\">$generoItem</option>";
}
$selectGenero .= '</select><button type="submit" id="Filtrar" name="accion" value="filtrar">Filtrar</button></p></form>';

// Verificar si el usuario tiene permisos para agregar películas
if (isset($_SESSION["user_obj"]) && unserialize($_SESSION["user_obj"])->getRole() == 1) {
    $agregar = "<a href='funcionalidades/agregarPelicula.php'><button type='btn btn-primary'>Agregar</button></a>";
    $selectGenero .= $agregar;
}

// Obtener la página actual
$pagina = isset($_GET['pagina']) ? (int) $_GET['pagina'] : 0;
$skip = $pagina * 5; // Si estás mostrando 5 películas por página

// Obtener la lista de películas según el género seleccionado
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['accion']) && $_POST['accion'] == 'filtrar') {
    $genero = $_POST['gen']; // Actualizar el género si se envió el formulario de filtrado
}
// Si no se proporciona un argumento de búsqueda, obtener la lista completa de películas
$listaPeliculas = $peliculaSA->filtrarPeliculasPorGenero($genero, $skip);

// Generar el contenido principal con las carátulas de las películas
$contenidoPrincipal = '<h1>Lista de películas</h1>';
if (!empty($listaPeliculas)) {
    $contenidoPrincipal .= '<div class="peliculas">';
    foreach ($listaPeliculas as $pelicula) {
        // Mostrar la carátula de la película con un enlace a los detalles
        $contenidoPrincipal .= '<a href="infoPeliculas.php?id=' . $pelicula->getId() . '">';
        $contenidoPrincipal .= '<img src="img/' . $pelicula->getCaratula() . '" alt="' . $pelicula->getCaratula() . '"class="caratula">';
        $contenidoPrincipal .= '</a>';
    }
    $contenidoPrincipal .= '</div>';
} else {
    $contenidoPrincipal .= '<p>No hay películas disponibles en este momento.</p>';
}

// Incluir la plantilla principal para mostrar el contenido
require BASE_APP . '/includes/vistas/plantillas/plantillaPaginacion.php';
?>
