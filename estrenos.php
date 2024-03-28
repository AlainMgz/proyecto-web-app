<?php
require_once __DIR__ . '/includes/config.php';
require_once RAIZ_APP . '/session_start.php';
require_once __DIR__ . '/includes/SAs/PeliculaSA.php';

// Crea una instancia de la clase PeliculaSA
$peliculaSA = new PeliculaSA();
$tituloPagina = "Estrenos";
$genero = "";
$listaPeliculas = array();
$generos = $peliculaSA->getGeneros();
// Inicializar el selector
$selectGenero = <<<EOS
    <form method="post" action="">
    <p>Genero:
        <select id="gen" name="gen"> 
            <option value="Todos">Todos</option>
EOS;

// Agregar opciones de género dinámicamente
foreach ($generos as $genero) {
    $selectGenero .= "<option value=\"$genero\">$genero</option>";
}

// Cerrar el selector y agregar el botón de filtrar
$selectGenero .= <<<EOS
        </select>
        <button type="submit" id="Filtrar" name="accion" value="filtrar">Filtrar</button>
    </p>
    </form>
    <script>
        // Aquí puedes agregar cualquier código JavaScript relacionado con el selector si es necesario
    </script>
EOS;

$genero = "Todos";

if (isset ($_SESSION["esAdmin"]) && $_SESSION["esAdmin"] === true) {
    $agregar = "<a href='funcionalidades/agregarPelicula.php'><button type='button'>Agregar</button></a>";
    $selectGenero .= $agregar;
}

// Llama a los métodos de la clase según sea necesario
if (isset ($_GET['argBusqueda']) && $_GET['argBusqueda'] != '') {
    // Si se proporciona un argumento de búsqueda, ejecutar una búsqueda y mostrar los resultados
    $argBusqueda = $_GET['argBusqueda'];
    $resultadosBusqueda = $peliculaSA->obtenerPeliculaPorNombre($argBusqueda);
    // Generar el contenido principal con los resultados de la búsqueda
    $contenidoPrincipal = '<h1>Resultados de la búsqueda para: ' . $argBusqueda . '</h1>';
    if (!empty ($resultadosBusqueda)) {
        $contenidoPrincipal .= '<div class="peliculas">';
        foreach ($resultadosBusqueda as $pelicula) {
            // Mostrar la carátula de la película
            $contenidoPrincipal .= '<img src="' . $pelicula->getCaratula() . '" alt="' . $pelicula->getTitulo() . '">';
        }
        $contenidoPrincipal .= '</div>';
    } else {
        $contenidoPrincipal .= '<p>No se encontraron resultados para la búsqueda.</p>';
    }
} else {
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset ($_POST['accion']) && $_POST['accion'] == 'filtrar') {
        $genero = $_POST['gen']; // Actualizar el género si se envió el formulario de filtrado
    }
    // Si no se proporciona un argumento de búsqueda, obtener la lista completa de películas
    $listaPeliculas = $peliculaSA->filtrarPeliculasPorGenero($genero);
    // Generar el contenido principal con las carátulas de las películas
    $contenidoPrincipal = '<h1>Lista de películas</h1>';
    if (!empty ($listaPeliculas)) {
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
}

// Incluir la plantilla principal para mostrar el contenido
require RAIZ_APP . '/vistas/plantillas/plantilla.php';