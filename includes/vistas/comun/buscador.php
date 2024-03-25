<?php
?>
<div class="search-overlay" id="searchOverlay">
    <div class="search-container">
        <input type="text" placeholder="Buscar títulos de películas, directores, entradas de blog, ..." class="search-input">
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