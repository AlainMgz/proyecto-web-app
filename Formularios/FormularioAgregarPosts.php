<?php
require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/session_start.php';
require_once __DIR__ . '/../includes/SAs/PostSA.php';
require_once __DIR__ . '/Formulario.php';

class FormularioAgregarPosts
{
    protected $errores = [];
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
                        <div id="sugerencias-post" style="overflow-y: auto; max-height: 15%;"></div>
                        </div>
                    <button type="submit" name="submit" class="btn btn-primary">Publicar</button>
                </form>
            </div>
        ';
    }

    protected function gestionarFormulario($titulo, $contenido){
        if($titulo == '') $this->errores['titulo'] = 'El título no puede estar vacío';
        if(strlen($titulo) > 255) $this->errores['titulo'] = 'El título es demasiado largo';
        if($contenido == '') $this->errores['contenido'] = 'El contenido no puede estar vacío';
        
        if(empty($this->errores)) {
            $postSA = new postSA();
            $postSA->crearPost(0, unserialize($_SESSION["user_obj"])->getNombreUsuario(), $titulo, $contenido, 0, false, -1);
            
            // Redireccionar a esta misma página para actualizar la lista de posts
            header('Location: ' . $_SERVER['PHP_SELF']);
            exit();
        }
    }

public function mostrarFormulario(){
    // Verificar si el formulario ha sido enviado
    if(isset($_POST['submit'])) {
        // Obtener los datos del formulario
        $titulo = $_POST['titulo'];
        $contenido = $_POST['contenido'];
        // Llamar a la función para gestionar el formulario
        $this->gestionarFormulario($titulo, $contenido);
    }
    // Mostrar el formulario
    return $this->crearFormulario();
}

}

?>

<script>
document.addEventListener("DOMContentLoaded", function() {
            var contenidoInput = document.getElementById("contenido");
            var sugerenciasUsuarios = document.getElementById("sugerencias-post");
            
            contenidoInput.addEventListener("input", function() {
                var contenido = contenidoInput.value;
                var lastSpaceIndex = contenido.lastIndexOf(" ");
                var textAfterLastSpace = contenido.substring(lastSpaceIndex + 1);
                var matchUser = textAfterLastSpace.match(/@(\w+)/); // Expresión regular para buscar usuarios
                var matchMovie = textAfterLastSpace.match(/#([\w\s]+)/); // Expresión regular para buscar películas
            
                if (matchUser && matchUser.length === 2) {
                    var nombreUsuario = matchUser[1];
                    // Realizar la llamada AJAX con el nombre de usuario
                    $.ajax({
                        url: "/proyecto-web-app/includes/usuarios_sugeridos.php",
                        method: "GET",
                        data: { usuario: nombreUsuario },
                        success: function (response) { 
                            $("#sugerencias-post").html(response);
                        }
                    });
                } else if (matchMovie && matchMovie.length === 2) {
                    var nombrePelicula = matchMovie[1];
                    // Realizar la llamada AJAX con el nombre de la película
                    $.ajax({
                        url: "/proyecto-web-app/includes/peliculas_sugeridas.php",
                        method: "GET",
                        data: { pelicula: nombrePelicula },
                        success: function (response) { 
                            $("#sugerencias-post").html(response);
                        }
                    });
                } else {
                    // Limpiar sugerencias si no se encontró ninguna mención después del último espacio
                    sugerenciasUsuarios.innerHTML = "";
                }
            });
        });

</script>