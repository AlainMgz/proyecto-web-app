<?php
require_once __DIR__ . '/includes/SAs/PeliculaSA.php';
require_once __DIR__ . '/includes/SAs/reviewSA.php';
require_once RAIZ_APP . '/session_start.php';
?>
<div class="search-overlay" id="searchOverlay">
    <div class="search-container">
        <form id="searchForm" action="/proyecto-web-app/reviewPelicula.php" method="get">
            <input type="text" name="nombre" id="searchInput" placeholder="Buscar títulos de películas, directores, entradas de blog, ..." class="search-input">
            <button type="submit">Buscar</button>
        </form>
        <button id="closeSearch">Cerrar</button>
        <div id="searchResults"></div> <!-- Aquí se mostrarán los resultados de búsqueda -->
    </div>
</div>

<script>
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
</script>