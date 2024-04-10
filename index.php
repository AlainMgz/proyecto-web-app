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

<style>
    /* Estilos personalizados para el carrusel */
    body {
        background-color: black;
        margin: 0;
        /* Elimina el margen predeterminado del body */
        padding: 0;
        /* Elimina el relleno predeterminado del body */
    }

    .carousel-item img {
        object-fit: cover;
        /* Ajusta la imagen al contenedor sin distorsionarla */
        max-height: 80vh;
        /* Altura máxima del 75% del viewport height */
        width: 100%;
        /* Asegura que la imagen ocupe todo el ancho del contenedor */
        margin: auto;
        /* Centra las imágenes horizontalmente */
        transition: opacity 0.5s ease;
        /* Transición suave de opacidad */
    }

    #carouselExampleIndicators {

        height: 80vh;
        /* Establece una altura del 75% del viewport height para el carrusel */
    }

    .carousel-caption {
        background-color: rgba(0, 0, 0, 0.5);
        /* Fondo semi-transparente para la descripción */
        padding: 10px;
        /* Espaciado interno */
        bottom: 0;
        /* Alinear la descripción en la parte inferior */
        left: 0;
        /* Alinear la descripción a la izquierda */
        width: 100%;
        /* Ancho completo */
    }

    .carousel-caption h5,
    .carousel-caption p {
        color: white;
        /* Color del texto */
        margin: 0;
        /* Elimina el margen predeterminado */
    }

    .carousel-caption p {
        font-size: 14px;
        /* Tamaño del texto de la descripción */
    }

    .carousel-indicators {
        position: absolute;
        /* Hace que los indicadores sean posicionados absolutamente */
        bottom: 10px;
        /* Ajusta la distancia desde la parte inferior */
        left: 0;
        /* Alinea los indicadores a la izquierda */
        right: 0;
        /* Alinea los indicadores a la derecha */
        margin-left: auto;
        /* Centra los indicadores horizontalmente */
        margin-right: auto;
        /* Centra los indicadores horizontalmente */
        z-index: 1;
        /* Asegura que los indicadores estén por encima de las imágenes */
    }

    .arrow-down {
        display: inline-block;
        text-decoration: none;
        color: #555;
        padding: 10px;
        border: 2px solid #555;
        border-radius: 50%;
        transition: background-color 0.3s, color 0.3s;
    }

    .arrow-down:hover {
        background-color: #555;
        color: white;
    }

    .material-icons {
        font-size: 24px;
        vertical-align: middle;
    }
</style>


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
    });
</script>

<div id="scroll-target" style="min-height: 100vh; padding-top: 200px;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <h1 class="mb-4">¡Únete ya a esta gran comunidad y comparte tus gustos!</h1>
                <p class="lead">En FEEL, puedes compartir tus opiniones sobre tus películas favoritas, conocer personas
                    afines a ti y mucho más.</p>
            </div>
        </div>
        <div class="row justify-content-center mt-4">
            <div class="col-lg-4 text-center">
                <button class="btn btn-secondary btn-lg btn-block" onclick="location.href='login.php';">Iniciar sesión</button>
            </div>
            <div class="col-lg-4 text-center mt-2 mt-lg-0">
                <button class="btn btn-light btn-lg btn-block" onclick="location.href='registro.php';">Registrarse</button>
            </div>
        </div>
    </div>
</div>




<?php
// Finaliza la captura del contenido principal
$contenidoPrincipal = ob_get_clean();

// Incluir la plantilla al final para que se muestre correctamente
require RAIZ_APP . '/vistas/plantillas/plantilla.php';
?>