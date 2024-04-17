<?php
require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/session_start.php';
require_once __DIR__ . '/../includes/SAs/PeliculaSA.php';
require_once __DIR__ . '/../includes/SAs/reviewSA.php';
require_once __DIR__ . '/../includes/DTOs/reviewDTO.php';
require_once __DIR__ . '/../includes/DTOs/UsuarioDTO.php';
require_once __DIR__ . '/Formulario.php';

$tituloPagina = 'AgregarReview';

// Definir una nueva clase que extienda Formulario
class FormularioAgregarReview extends Formulario
{
    public $ID = '';
    public $pelicula = '';


    public function __construct($id)
    {
        parent::__construct('formAgregarReview', ['urlRedireccion' => '../estrenos.php']);
        $this->ID = $id;
    }
    // Método para generar los campos del formulario
    protected function generaCamposFormulario(&$datos)
    {
        $contenidoPrincipal = <<<EOS
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="film-container">
                        <form action="tu_ruta_de_destino.php" method="POST">
                            <div class="form-group">
                                <label for="titulo">Título:</label>
                                <input type="text" class="form-control" id="titulo" name="titulo" required>
                            </div>
                            <div class="form-group">
                                <label for="critica">Crítica:</label>
                                <textarea class="form-control" id="critica" name="critica" rows="4" required></textarea>
                            </div>
                            <div class="form-group">
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
                        </form>
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

        $titulo = trim($datos['titulo'] ?? '');
        $titulo = filter_var($titulo, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if (!$titulo || mb_strlen($titulo) > 100) {
            $this->errores['titulo'] = 'El titulo de la critica no puede tener ms de 100 caracteres.';
        }
        $critica = trim($datos['critica'] ?? '');
        $critica = filter_var($critica, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if (!$critica || mb_strlen($critica) > 300) {
            $this->errores['critica'] = 'La crítica debe tener menos de 300 caracteres.';
        }
        $puntuacion = trim($datos['puntuacion'] ?? '');
        $puntuacion = filter_var($puntuacion, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if (!$puntuacion || $puntuacion < 0 || $puntuacion > 5) {
            $this->errores['puntuacion'] = 'La puntuación debe ser un número entre 0 y 5.';
        }

        if (count($this->errores) === 0) {
            $reviewSA = new reviewSA();
            $peliculaSA = new peliculaSA();
            $this->pelicula = $peliculaSA->obtenerPeliculaPorID($this->ID);
            $username = unserialize($_SESSION["user_obj"])->getNombreUsuario();
            $review = $reviewSA->crearReview($this->ID, $username, $titulo, $critica, $puntuacion, $this->pelicula->getNombre());
            $peliculaSA->realizarMedia($peliculaSA->obtenerPeliculaPorID($this->ID));
        }
    }

    // Método para mostrar el formulario
    public function mostrarFormulario()
    {
        echo $this->generaFormulario();
    }
}


