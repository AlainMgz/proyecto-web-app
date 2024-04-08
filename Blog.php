<?php
require_once __DIR__ . '/includes/config.php';
require_once RAIZ_APP . '/session_start.php';
require_once __DIR__ . '/includes/DTOs/UsuarioDTO.php';
require_once __DIR__ . '/includes/SAs/PeliculaSA.php';

$contenidoPrincipal='<h1>Ranking de películas</h1>
<p>Estamos trabajando para ofrecer esta funcionalidad lo antes posible, disculpe por las molestias<p/>
';

require RAIZ_APP . '/vistas/plantillas/plantilla.php';