<?php
require_once __DIR__ . '/includes/config.php';
require_once RAIZ_APP . '/session_start.php';
require_once __DIR__ . '/includes/DTOs/UsuarioDTO.php';
require_once __DIR__ . '/includes/SAs/PeliculaSA.php';

$peliculaSA = new PeliculaSA();
$listaPeliculas = $peliculaSA->obtenerListaPeliculas();

$contenidoPrincipal = '';

// Empieza a capturar el contenido principal
ob_start();
?>

<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
        <?php for ($i = 0; $i < 6; $i++): ?>
            <li data-target="#carouselExampleIndicators" data-slide-to="<?= $i ?>" class="<?= $i === 0 ? 'active' : '' ?>">
            </li>
        <?php endfor; ?>
    </ol>
    <div class="carousel-inner">
        <?php for ($i = 1; $i <= 5; $i++): ?>
            <div class="carousel-item <?= $i === 1 ? 'active' : '' ?>">
                <img src="img/carrusel<?= $i ?>.png" class="d-block w-100" alt="Carrusel <?= $i ?>">
            </div>
        <?php endfor; ?>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>


<div style="text-align: center; margin-top: 10px;">
    <a href="#" class="arrow-down" style="text-decoration: none;">
        <span class="material-icons" style="font-size: 48px;">arrow_downward</span>
    </a>
</div>



<script>
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
</script>

<div id="scroll-target" style="min-height: 100vh; padding-top: 150px;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <h1 class="mb-4 text-light">¡Únete ya a esta gran comunidad y comparte tus gustos!</h1>
                <p class="lead text-light">En FEEL, puedes compartir tus opiniones sobre tus películas favoritas,
                    conocer personas afines a ti y mucho más.</p>
            </div>
        </div>
        <div class="row justify-content-center mt-4">
            <div class="col-lg-4 text-center">
                <button class="btn btn-secondary btn-lg btn-block" onclick="location.href='login.php';">Iniciar
                    sesión</button>
            </div>
            <div class="col-lg-4 text-center mt-2 mt-lg-0">
                <button class="btn btn-light btn-lg btn-block"
                    onclick="location.href='registro.php';">Registrarse</button>
            </div>
        </div>
        <div style="text-align: center; margin-top: 30px;">
            <a href="#" class="arrow-up" style="text-decoration: none;">
                <span class="material-icons" style="font-size: 48px;">arrow_upward</span>
            </a>
        </div>
    </div>
</div>


<?php
// Finaliza la captura del contenido principal
$contenidoPrincipal = ob_get_clean();

// Incluir la plantilla al final para que se muestre correctamente
require RAIZ_APP . '/vistas/plantillas/plantilla.php';
?>