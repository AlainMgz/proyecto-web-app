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
    public $ID = '';
    public $pelicula = '';


    public function __construct($id)
    {
        $campos = ['titulo', 'critica', 'puntuacion'];
        parent::__construct('formAgregarPost', ['urlRedireccion' => '../estrenos.php', 'campos' => $campos]);
        $this->ID = $id;
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
                                <span class="form_errors">{$erroresCampos['critica']}</span>
                                <label for="critica">Crítica:</label>
                                <textarea class="form-control" id="critica" name="critica" rows="4" required></textarea>
                            </div>
                            <div class="form-group">
                                <span class="form_errors">{$erroresCampos['puntuacion']}</span>
                                <label for="puntuacion">Puntuación:</label>
                                <select class="form-control" id="puntuacion" name="puntuacion" required>
                                    <option value="">Selecciona una puntuación</option>
                                    <option value="5">&#9733;&#9733;&#9733;&#9733;&#9733;</option>
                                    <option value="4">&#9733;&#9733;&#9733;&#9733;</option>
                                    <option value="3">&#9733;&#9733;&#9733;</option>
                                    <option value="2">&#9733;&#9733;</option>
                                    <option value="1">&#9733;</option>
                                </select>
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
            $this->errores['titulo'] = 'El título de la crítica no puede estar vacío.';
        }
        if (strlen($titulo) > 100) {
            $this->errores['titulo'] = 'El título de la crítica no puede tener más de 100 caracteres.';
        }
        $texto = htmlspecialchars(trim($datos['texto'] ?? ''));
        if (!$texto) {
            $this->errores['texto'] = 'El post no puede estar vacío.';
        }
        if (strlen($texto) > 1000) {
            $this->errores['texto'] = 'La crítica debe tener menos de 300 caracteres.';
        }

        if (count($this->errores) === 0) {
            $postSA = new postSA();

            $username = unserialize($_SESSION["user_obj"])->getNombreUsuario();
            $post= $postSA->crearPost(0, $username, $titulo, $texto, 0, false, -1);
         
        }
        header('Location: ../estrenos.php');
    }

    // Método para mostrar el formulario
    public function mostrarFormulario()
    {
        echo $this->generaFormulario();
    }
}


