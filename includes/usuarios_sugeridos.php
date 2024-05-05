<?php
require_once __DIR__ . '/config.php';
require_once RAIZ_APP . '/session_start.php';
require_once RAIZ_APP . '/DTOs/UsuarioDTO.php'; // Asegúrate de que esta ruta sea correcta
require_once RAIZ_APP . '/SAs/UsuarioSA.php'; // Asegúrate de que esta ruta sea correcta

// Obtiene el término de búsqueda del parámetro GET "query"
$query = isset($_GET['usuario']) ? $_GET['usuario'] : '';
$id_post = isset($_GET['id_post']) ? $_GET['id_post'] : '';
// Crea una instancia de UsuarioSA para buscar usuarios que coincidan con el término de búsqueda
$usuarioSA = new UsuarioSA();
$resultado = $usuarioSA->buscarSugerido($query);

echo '<h5> Sugerencias: <h5>';
echo '<ul>';
foreach ($resultado as $usuario) {
    echo '<li role="option" class="sugerencia">
    <img src="img/' . $usuario->getProfileImage() . '" alt="Avatar" class="rounded-circle mr-2" style="width: 30px; height: 30px;"> 
    <a href="#" class="sugerencia-usuario" data-nombre="' . urlencode($usuario->getNombreUsuario()) . '">' . $usuario->getNombreUsuario() . '</a>      
    </li>';
}
echo '</ul>';
?>

<script>
    $(document).ready(function () {
    // Manejar clic en enlaces de sugerencias de usuario
    $(".sugerencia-usuario").on("click", function (event) {
        event.preventDefault(); // Evitar el comportamiento predeterminado del enlace

        // Obtener el nombre de usuario del atributo de datos
        var nombreUsuario = $(this).data("nombre").toLowerCase(); // Convertir a minúsculas
        var query = "<?php echo $query; ?>".toLowerCase(); // Obtenga y convierta a minúsculas
        // Obtener el textarea y su contenido
        var textarea = $("#contenido")[0];
        var contenido = textarea.value.toLowerCase(); // Convertir a minúsculas

        // Obtener la posición del cursor
        var inicio = textarea.selectionStart;
        var fin = textarea.selectionEnd;
        var nuevoNombreUsuario = nombreUsuario.replace(query, "");
        // Reemplazar el términ de búsqueda actual con el nombre de usuario seleccionado
        var nuevoContenido = contenido.substring(0, inicio) + nuevoNombreUsuario + contenido.substring(fin);

        // Actualizar el valor del textarea con el nuevo contenido
        textarea.value = nuevoContenido;

        // Mover el cursor al final del nombre de usuario insertado
        var nuevaPosicionCursor = inicio + nombreUsuario.length + 1; // Sumar 1 para el símbolo "@"
        textarea.setSelectionRange(nuevaPosicionCursor, nuevaPosicionCursor);

        // Ocultar el popover después de seleccionar una sugerencia
        $("#sugerencias-post").empty(); // Limpiar sugerencias
    });

});
</script>