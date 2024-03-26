<?php
require_once __DIR__ . '/includes/config.php';
require_once RAIZ_APP . '/session_start.php';
require_once __DIR__ . '/includes/SAs/PeliculaSA.php';

// Crea una instancia de la clase PeliculaSA
$peliculaSA = new PeliculaSA();
$tituloPagina="Estrenos";
$genero = "Todos";
$listaPeliculas = array();
$selectGenero = <<<EOS
    <form method="post" action="">
    <p>Genero:
        <select id="gen" name="gen"> 
            <option value="Todos">Todos</option>
            <option value="Acción">Acción</option>
            <option value="Animación">Animación</option>
            <option value="Aventuras">Aventuras</option>
            <option value="Ciencia ficción">Ciencia ficción</option>
            <option value="Comedia">Comedia</option>
            <option value="Documental">Documental</option>
            <option value="Drama">Drama</option>
            <option value="Fantasía">Fantasía</option>
            <option value="Musical">Musical</option>
            <option value="Romance">Romance</option>
            <option value="Terror">Terror</option>
            <option value="Thriller">Thriller</option>
        </select>
        <button type="submit" id="Filtrar" name="accion" value="filtrar">Filtrar</button>
    
    </p>
    </form>
        <script>
        </script>
    </p>
    </form>
EOS;

if (isset ($_SESSION["esAdmin"]) && $_SESSION["esAdmin"] === true) {
    $agregar = "<a href='funcionalidades/agregarPelicula.php'><button type='button'>Agregar</button></a>";
    $selectGenero .= $agregar;
}
$selectGenero .= "<a href='Formularios/FormularioAgregarReview.php'><button type='button'>Realizar review</button></a>";
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
