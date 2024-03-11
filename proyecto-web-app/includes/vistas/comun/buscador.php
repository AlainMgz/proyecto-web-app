<?php
?>
<div class="search-overlay" id="searchOverlay">
    <div class="search-container">
        <input type="text" placeholder="Buscar títulos de películas, directores, entradas de blog, ..." class="search-input">
        <button id="closeSearch">Close</button>
         genero: 
    <select id="genero" name="genero"> 
    <option value="Ninguno">Ninguno</option>
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
    <option value="ROMANDE">ROMANCE</option>
    </select>
    <button id="Filtrar">Filtrar</button>
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