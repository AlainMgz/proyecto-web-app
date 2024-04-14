<?php
require_once __DIR__ . '/includes/config.php';
require_once BASE_APP . '/includes/session_start.php';
require_once __DIR__ . '/includes/DTOs/UsuarioDTO.php';
require_once __DIR__ . '/includes/SAs/PeliculaSA.php';

$contenidoPrincipal='<h1>Blog</h1>
<p>Estamos trabajando para ofrecer esta funcionalidad lo antes posible, disculpe por las molestias<p/>
';

require BASE_APP . '/includes/vistas/plantillas/plantilla.php';