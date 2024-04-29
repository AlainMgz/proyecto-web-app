<?php
// buscar.php

// Incluir tus clases y configuraciones necesarias
require_once __DIR__ . '/config.php';
require_once RAIZ_APP . '/session_start.php';
require_once RAIZ_APP . '/DTOs/PeliculaDTO.php'; // Asegúrate de que esta ruta sea correcta
require_once RAIZ_APP . '/SAs/PeliculaSA.php'; // Asegúrate de que esta ruta sea correcta
require_once RAIZ_APP . '/DTOs/UsuarioDTO.php'; // Asegúrate de que esta ruta sea correcta
require_once RAIZ_APP . '/SAs/UsuarioSA.php'; // Asegúrate de que esta ruta sea correcta

// Verificar si se ha proporcionado un término de búsqueda
if (isset($_GET['nombre'])) {
    $term = $_GET['nombre'];
    // Crear una instancia de PeliculaSA (probablemente usando algún tipo de inyección de dependencias o un contenedor)
    $peliculaSA = new PeliculaSA();
    $usuarioSA = new UsuarioSA();

    // Realizar la búsqueda de películas utilizando PeliculaSA
    $resultadosPelis = $peliculaSA->buscarPeliculasQueEmpecienPor($term);
    $resultadosUsuarios = $usuarioSA->buscarUsuariosQueEmpiecenPor($term);

    $resultados = array_merge($resultadosPelis, $resultadosUsuarios);

    // Mostrar los resultados como una cuadrícula
    echo '<div class="row mt-5">';
    foreach ($resultados as $resultado) {
        echo '<div class="col-md-3 mb-4">';
        if (!($resultado instanceof PeliculaDTO)) {
            echo '<a href="usuario.php?nombre=' . $resultado . '">';
            echo '<img src="img/user_default.png" alt="User Default Picture" class="img-fluid caratula">';
            echo '<p>' . $resultado . '</p>';
        } else {
            echo '<a href="infoPeliculas.php?id=' . $resultado->getId() . '">';
            echo '<img src="img/' . $resultado->getCaratula() . '" alt="' . $resultado->getCaratula() . '" class="img-fluid caratula">';
            echo '<p>' . $resultado->getNombre() . '</p>';
        }
        echo '</a>';
        echo '</div>';
    }
    echo '</div>';
}
