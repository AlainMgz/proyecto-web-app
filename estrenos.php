<?php
require_once __DIR__ . '/includes/config.php';
require_once BASE_APP . '/includes/session_start.php';
require_once __DIR__ . '/includes/DTOs/UsuarioDTO.php';
require_once __DIR__ . '/includes/SAs/PeliculaSA.php';

// Crea una instancia de la clase PeliculaSA
$peliculaSA = new PeliculaSA();
$tituloPagina = "Estrenos";
$genero = "";
$listaPeliculas = array();
$generos = $peliculaSA->getGeneros();
$pagina = isset($_GET['pagina']) ? $_GET['pagina'] : 0;
$skip = $pagina * 5; // Si estás mostrando 5 películas por página

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
    </script>
EOS;

$genero = "Todos";

if (isset($_SESSION["user_obj"]) && unserialize($_SESSION["user_obj"])->getRole() == 1) {
    $agregar = "<a href='funcionalidades/agregarPelicula.php'><button type='btn btn-primary'>Agregar</button></a>";
    $selectGenero .= $agregar;
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['accion']) && $_POST['accion'] == 'filtrar') {
    $genero = $_POST['gen']; // Actualizar el género si se envió el formulario de filtrado
    // Redireccionar a la misma página con el método GET para evitar el reenvío del formulario
    header("Location: " . $_SERVER['REQUEST_URI']);
    exit();
}

// Llama a los métodos de la clase según sea necesario
if (isset($_GET['argBusqueda']) && $_GET['argBusqueda'] != '') {
    // Si se proporciona un argumento de búsqueda, ejecutar una búsqueda y mostrar los resultados
    $argBusqueda = $_GET['argBusqueda'];
    $resultadosBusqueda = $peliculaSA->obtenerPeliculaPorNombre($argBusqueda);
    // Generar el contenido principal con los resultados de la búsqueda
    $contenidoPrincipal = '<h1>Resultados de la búsqueda para: ' . $argBusqueda . '</h1>';
    if (!empty($resultadosBusqueda)) {
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
}

// Incluir la plantilla principal para mostrar el contenido
require BASE_APP . '/includes/vistas/plantillas/plantillaPaginacion.php';

