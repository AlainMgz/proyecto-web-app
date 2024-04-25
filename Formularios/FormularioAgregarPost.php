<?php
require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/session_start.php';
require_once __DIR__ . '/../includes/SAs/PeliculaSA.php';
require_once __DIR__ . '/../includes/SAs/reviewSA.php';
require_once __DIR__ . '/../includes/SAS/postSA.php';
require_once __DIR__ . '/../includes/DTOs/reviewDTO.php';
require_once __DIR__ . '/../includes/DTOs/UsuarioDTO.php';
require_once __DIR__ . '/../includes/DTOS/postDTO.php';
require_once __DIR__ . '/Formulario.php';

$tituloPagina = 'AgregarPost';

/*
FORMULARIO UNICAMENTE PARA TESTEO
*/
// Definir una nueva clase que extienda Formulario
class FormularioAgregarPost extends Formulario
{
    public function __construct()
    {
        $campos = ['titulo', 'texto']; // Cambiado de 'critica' a 'texto'
        parent::__construct('formAgregarPost', ['urlRedireccion' => '../estrenos.php', 'campos' => $campos]);
    }

    // Método para generar los campos del formulario
    protected function generaCamposFormulario(&$datos)
    {
        $erroresCampos = self::generaErroresCampos($this->campos, $this->errores);
        $erroresGlobal = self::generaListaErroresGlobales($this->errores);

        $contenidoPrincipal = <<<EOS
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="film-container">
                        <span class="form_errors">$erroresGlobal</span>
                            <div class="form-group">
                                <span class="form_errors">{$erroresCampos['titulo']}</span>
                                <label for="titulo">Título:</label>
                                <input type="text" class="form-control" id="titulo" name="titulo" required>
                            </div>
                            <div class="form-group">
                                <span class="form_errors">{$erroresCampos['texto']}</span>
                                <label for="texto">Texto:</label> <!-- Cambiado de 'critica' a 'texto' -->
                                <textarea class="form-control" id="texto" name="texto" rows="4" required></textarea> <!-- Cambiado de 'critica' a 'texto' -->
                            </div>
                        <button type="submit" class="btn btn-primary btn-block">Agregar</button>
                    </div>
                </div>
            </div>
        </div>
        EOS;
        return $contenidoPrincipal;
    }

    // Método para procesar los datos del formulario
    protected function procesaFormulario(&$datos)
    {
        $this->errores = [];

        $titulo = htmlspecialchars(trim($datos['titulo'] ?? ''));
        if (!$titulo) {
            $this->errores['titulo'] = 'El título del post no puede estar vacío.'; // Cambiado el mensaje de error
        }
        if (strlen($titulo) > 100) {
            $this->errores['titulo'] = 'El título del post no puede tener más de 100 caracteres.'; // Cambiado el mensaje de error
        }

        $texto = htmlspecialchars(trim($datos['texto'] ?? '')); // Cambiado de 'critica' a 'texto'
        if (!$texto) {
            $this->errores['texto'] = 'El texto del post no puede estar vacío.'; // Cambiado el mensaje de error
        }
        if (strlen($texto) > 1000) {
            $this->errores['texto'] = 'El texto del post debe tener menos de 1000 caracteres.'; // Cambiado el mensaje de error
        }

        if (count($this->errores) === 0) {
            $postSA = new postSA();
            $username = unserialize($_SESSION["user_obj"])->getNombreUsuario();
            // Cambiado el nombre de las variables a pasar a la función crearPost para que coincidan con el orden esperado
            $post = $postSA->crearPost(0, $username, $titulo, $texto, 0, false, -1);
            if ($post === false) {
                $this->errores['global'] = 'Error al crear el post.'; // Agregado manejo de error
            }
        }
        header('Location: ../estrenos.php');
    }

    // Método para mostrar el formulario
    public function mostrarFormulario()
    {
        echo $this->generaFormulario();
    }
}
