<?php
require_once __DIR__ . '/config.php';
require_once RAIZ_APP . '/session_start.php';
require_once RAIZ_APP . '/DTOs/PeliculaDTO.php'; // Asegúrate de que esta ruta sea correcta
require_once RAIZ_APP . '/SAs/PeliculaSA.php'; // Asegúrate de que esta ruta sea correcta

// Obtiene el término de búsqueda del parámetro GET "query"
$query = isset($_GET['pelicula']) ? $_GET['pelicula'] : '';

if(isset($_GET['id_post'])){
    $id_post = $_GET['id_post'] ? $_GET['id_post'] : '';
    echo '<div id="id_post" data-id="' . $id_post . '"></div>'; // Imprimir el valor de $id_post como un atributo de datos
}
// Crea una instancia de UsuarioSA para buscar usuarios que coincidan con el término de búsqueda
$peliculaSA = new PeliculaSA();
$resultado = $peliculaSA->obtenerPeliculasSugeridas($query);

echo '<h5> Sugerencias: <h5>';
echo '<ul>';
foreach ($resultado as $pelicula) {
    echo '<li role="option" class="sugerencia-usuario">
    <img src="img/' . $pelicula->getCaratula() . '" alt="Avatar" class="rounded-circle mr-2" style="width: 30px; height: 30px;">';
        echo '<a href="#" class="sugerencia-pelicula" data-nombre="' . urlencode($pelicula->getNombre()) . '">' . $pelicula->getNombre() . '</a>
    </li>';
}
echo '</ul>';
?>

<script>
    $(document).ready(function () {
        // Manejar clic en enlaces de sugerencias de usuario
        $(".sugerencia-pelicula").on("click", function (event) {
            event.preventDefault(); // Evitar el comportamiento predeterminado del enlace
            var query = "<?php echo $query; ?>";
            // Obtener el nombre de la película del atributo de datos
            var nombrePelicula = $(this).data("nombre").toLowerCase();
            // Obtener el textarea y su contenido
            var textarea = $("#contenido")[0];
            var contenido = textarea.value.toLowerCase(); // Convertir el contenido a minúsculas

            // Obtener la posición del cursor
            var inicio = textarea.selectionStart;
            var fin = textarea.selectionEnd;
            var nuevoNombrePelicula = decodeURIComponent(nombrePelicula.replace(/\+/g, ' ').replace(/ /g, '_')); // Decodificar el nombre de la película y reemplazar '+' con espacios, y luego reemplazar los espacios con guiones bajos
            var nombreDefinitivo = nuevoNombrePelicula.replace(query, '');
            // Reemplazar el término de búsqueda actual con el nombre de la película seleccionada, ignorando mayúsculas y minúsculas
            var nuevoContenido = contenido.substring(0, inicio) + nombreDefinitivo + contenido.substring(fin);

            // Actualizar el valor del textarea con el nuevo contenido
            textarea.value = nuevoContenido;

            // Mover el cursor al final del nombre de la película insertado
            var nuevaPosicionCursor = inicio + nuevoNombrePelicula.length; // No es necesario sumar 1 para el símbolo "@"
            textarea.setSelectionRange(nuevaPosicionCursor, nuevaPosicionCursor);

            // Ocultar el popover después de seleccionar una sugerencia
            $("#sugerencias-post").empty(); // Limpiar sugerencias
        });

    });

    
</script>