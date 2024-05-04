<?php
require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/session_start.php';
require_once __DIR__ . '/../includes/SAs/PeliculaSA.php';
require_once __DIR__ . '/Formulario.php';

class FormularioAgregarPosts
{
    public function __construct()
    {

    }

 public function crearFormulario()
    {
        return '
    <div class="container mt-3">
        <h2>Escribe un nuevo post</h2>
        <form action="" method="post">
    <div class="form-group">
        <textarea class="form-control" id="titulo" name="titulo" rows="1" placeholder="Título" required></textarea>
    </div>
    <div class="form-group">
        <textarea class="form-control" id="contenido" name="contenido" rows="3" placeholder="Contenido" required></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Publicar</button>
</form>
    </div>
';
    }
}