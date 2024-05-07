

//mostrar y ocultar comentarios
function toggleComments(postId) {
    var form = document.getElementById("form-comment-" + postId);
    var comments = document.getElementById("comments-" + postId);
    if (form.style.display === "none") {
        form.style.display = "block";
        comments.style.display = "block"; // Mostrar comentarios al mostrar el formulario
    } else {
        form.style.display = "none";
        comments.style.display = "none"; // Ocultar comentarios al ocultar el formulario
    }
}


// Botón para subir o bajar la página en index
$(document).ready(function () {
    $(".arrow-down").click(function (event) {
        // Evita el comportamiento predeterminado del enlace
        event.preventDefault();

        // Desplaza la página hacia abajo
        $('html, body').animate({
            scrollTop: $("#scroll-target").offset().top
        }, 500); // Duración de la animación en milisegundos
    });

    $(".arrow-up").click(function (event) {
        event.preventDefault();

        $('html, body').animate({
            scrollTop: 0
        }, 500);
    });
});

// precargar imagenes en el carrusel
$(document).ready(function() {
// Pre-cargar imágenes
var images = [];
for (var i = 1; i <= 5; i++) {
    images[i] = new Image();
    images[i].src = 'img/carrusel' + i + '.png';
}
});

//maneja el input del buscador y muestra el overlaySearch
$(document).ready(function () {
    $("#searchInput").on("input", function () {
        if ($(this).val().length >= 2) {
            $("#searchOverlay").fadeIn();
            $.ajax({
                url: '/proyecto-web-app/includes/buscador.php',
                method: 'GET',
                data: $('#searchForm').serialize(),
                success: function (response) {
                    $('#searchResults').html(response);
                }
            });
        } else{
            $("#searchOverlay").fadeOut();
        }
    });

    $("#closeSearch").click(function () {
        $("#searchOverlay").fadeOut();
    });
});

// busca peliculas e imagenes y usuarios con el termino del buscador y los muestra en el overlaySearch
$(document).ready(function() {
    $("#searchInput").on("input", function() {
        if ($(this).val().length >= 3) {
            $("#searchOverlay").fadeIn();
            // Realiza la solicitud AJAX para obtener los resultados de búsqueda
            $.ajax({
                url: '/proyecto-web-app/includes/buscador.php',
                method: 'GET',
                data: $('#searchForm').serialize(),
                success: function(response) {
                    $('#searchResults').html(response); // Muestra los resultados de búsqueda en el overlay
                }
            });
        }
    });

    $("#closeSearch").click(function() {
        $("#searchOverlay").fadeOut();
    });
});

// Manejar clic en enlaces de sugerencias de usuario Y reemplazar el nombre de usuario que hay en el input con el nombre de usuario seleccionado
$(document).ready(function () {
    $(".sugerencia-usuario").on("click", function (event) {
        event.preventDefault(); // Evitar el comportamiento predeterminado del enlace

        // Obtener el nombre de usuario del atributo de datos
        var nombreUsuario = $(this).data("nombre").toLowerCase(); // Convertir a minúsculas
        var query = $(this).data("query").toLowerCase(); // Obtenga y convierta a minúsculas
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

// Manejar cambios en el textarea de comentarios y muestra sugerencias de usuarios encontrados por lo que hay en el input
document.addEventListener("DOMContentLoaded", function () {
    var contenidoInputs = document.querySelectorAll('textarea[id^="contenido-"]');

    contenidoInputs.forEach(function (contenidoInput) {
        contenidoInput.addEventListener("input", function () {
            var postId = contenidoInput.dataset.postid;
            var sugerenciasId = "sugerencias-" + postId;
            var sugerenciasUsuarios = document.getElementById(sugerenciasId);

            var contenido = contenidoInput.value;
            var lastSpaceIndex = contenido.lastIndexOf(" ");
            var textAfterLastSpace = contenido.substring(lastSpaceIndex + 1);
            var matchUser = textAfterLastSpace.match(/@(\w+)/); // Expresión regular para buscar usuarios
            var matchMovie = textAfterLastSpace.match(/#(\w+)/); // Expresión regular para buscar películas

            if (matchUser && matchUser.length === 2) {
                var nombreUsuario = matchUser[1];
                // Realizar la llamada AJAX con el nombre de usuario
                $.ajax({
                    url: "/proyecto-web-app/includes/usuarios_sugeridos_comm.php",
                    method: "GET",
                    data: { usuario: nombreUsuario, id_post: postId },
                    success: function (response) {
                        $("#" + sugerenciasId).html(response);
                    }
                });
            } else if (matchMovie && matchMovie.length === 2) {
                var nombrePelicula = matchMovie[1];
                // Realizar la llamada AJAX con el nombre de la película
                $.ajax({
                    url: "/proyecto-web-app/includes/peliculas_sugeridas_comm.php",
                    method: "GET",
                    data: { pelicula: nombrePelicula, id_post: postId }, // Agrega una coma después de nombrePelicula
                    success: function (response) {
                        $("#" + sugerenciasId).html(response);
                    }
                });
            } else {
                // Limpiar sugerencias si no se encontró ninguna mención después del último espacio
                sugerenciasUsuarios.innerHTML = "";
            }
        });
    });
});

// Manejar clic en enlaces de sugerencias de usuario en comentarios Y reemplazar el nombre de usuario que hay en el input del comentario con el nombre de usuario seleccionado
$(document).ready(function () {
    // Manejar clic en enlaces de sugerencias de usuario
    
    $(".sugerencia-usuario-comentario").on("click", function (event) {
        event.preventDefault(); // Evitar el comportamiento predeterminado del enlace
        // Obtener el nombre de usuario del atributo de datos
        var id_post = $(this).data("id");

        var nombreUsuario = $(this).data("nombre").toLowerCase(); // Convertir a minúsculas
        var query = $(this).data("query").toLowerCase(); // Obtenga y convierta a minúsculas
        // Obtener el textarea y su contenido
        var textarea = $("#contenido-" + id_post)[0];
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
        $("#sugerencias-" + id_post).empty(); // Limpiar sugerencias
    });
});

// Manejar clic en enlaces de sugerencias de pelicula Y reemplazar el nombre de pelicula que hay en el input con el nombre de pelicula seleccionado
$(document).ready(function () {
    // Manejar clic en enlaces de sugerencias de usuario
    $(".sugerencia-pelicula").on("click", function (event) {
        event.preventDefault(); // Evitar el comportamiento predeterminado del enlace
        var query = $(this).data("query").toLowerCase();
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

// Manejar clic en enlaces de sugerencias de peliculas en comentarios Y reemplazar el nombre de pelicula que hay en el input del comentario con el nombre de pelicula seleccionado
$(document).ready(function () {
    $(".sugerencia-pelicula-comentario").on("click", function (event) {
        event.preventDefault(); // Evitar el comportamiento predeterminado del enlace
        var id_post = $(this).data("id");

        var nombrePelicula = $(this).data("nombre").toLowerCase(); // Convertir a minúsculas
        var query = $(this).data("query").toLowerCase(); // Obtenga y convierta a minúsculas
        // Obtener el textarea y su contenido
        var textarea = $("#contenido-" + id_post)[0];
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
        $("#sugerencias-" + id_post).empty(); // Limpiar sugerencias
    });

});

// Manejar el evento de entrada en el textarea del post y muestra sugerencias de usuario y peliculas
document.addEventListener("DOMContentLoaded", function() {
    var contenidoInput = document.getElementById("contenido");
    var sugerenciasUsuarios = document.getElementById("sugerencias-post");

    contenidoInput.addEventListener("input", function() {
        var contenido = contenidoInput.value;
        var lastSpaceIndex = contenido.lastIndexOf(" ");
        var textAfterLastSpace = contenido.substring(lastSpaceIndex + 1);
        var matchUser = textAfterLastSpace.match(/@(\w+)/); // Expresión regular para buscar usuarios
        var matchMovie = textAfterLastSpace.match(
        /#([\w\s]+)/); // Expresión regular para buscar películas

        if (matchUser && matchUser.length === 2) {
            var nombreUsuario = matchUser[1];
            // Realizar la llamada AJAX con el nombre de usuario
            $.ajax({
                url: "/proyecto-web-app/includes/usuarios_sugeridos.php",
                method: "GET",
                data: {
                    usuario: nombreUsuario
                },
                success: function(response) {
                    $("#sugerencias-post").html(response);
                }
            });
        } else if (matchMovie && matchMovie.length === 2) {
            var nombrePelicula = matchMovie[1];
            // Realizar la llamada AJAX con el nombre de la película
            $.ajax({
                url: "/proyecto-web-app/includes/peliculas_sugeridas.php",
                method: "GET",
                data: {
                    pelicula: nombrePelicula
                },
                success: function(response) {
                    $("#sugerencias-post").html(response);
                }
            });
        } else {
            // Limpiar sugerencias si no se encontró ninguna mención después del último espacio
            sugerenciasUsuarios.innerHTML = "";
        }
    });
});

document.getElementById('openBtn').addEventListener('click', function() {
    document.getElementById('popupForm').style.display = 'block';
    document.body.style.overflow = 'hidden'; // Prevent scrolling of background
});
  
document.getElementById('closeBtn').addEventListener('click', function() {
    document.getElementById('popupForm').style.display = 'none';
    document.body.style.overflow = 'auto'; // Restore scrolling of background
});
  
// Close the pop-up when clicking outside of it
window.addEventListener('click', function(event) {
if (event.target == document.getElementById('popupForm')) {
    document.getElementById('popupForm').style.display = 'none';
    document.body.style.overflow = 'auto'; // Restore scrolling of background
}
});