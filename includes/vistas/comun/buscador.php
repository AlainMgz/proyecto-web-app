<?php
require_once __DIR__ . '/../../SAs/PeliculaSA.php';
require_once __DIR__ . '/../../SAs/reviewSA.php';
require_once RAIZ_APP . '/session_start.php';

?>
<div class="search-overlay" id="searchOverlay">
    <div class="search-container">
        <form action="/proyecto-web-app/reviewPelicula.php" method="get">
            <input type="text" name="nombre" placeholder="Buscar títulos de películas, directores, entradas de blog, ..." class="search-input">
            <button type="submit">Buscar</button>
        </form>
        <button id="closeSearch">Close</button>
    </div>
</div>
<script>
    $(document).ready(function() {
        $("#searchBtn").click(function() {
            $("#searchOverlay").fadeIn();
        });

        $("#closeSearch").click(function() {
            $("#searchOverlay").fadeOut();
        });
    });
</script>
