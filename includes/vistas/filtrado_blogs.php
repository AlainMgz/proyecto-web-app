<!-- cabecera_secundaria.php -->
<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../session_start.php';

class filtrado_blogs{

    public function __construct(){
        
    }
public function filtrar(){
    return '
<div class="container mt-3 bg-light">
    <div class="row justify-content-center">
        <div class="col">
            <button type="button" class="btn btn-secondary">Últimos</button>
            <button type="button" class="btn btn-secondary">Siguiendo</button>
        </div>
    </div>
</div>
';
}
}