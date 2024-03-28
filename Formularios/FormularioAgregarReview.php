<?php
require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/session_start.php';
require_once __DIR__ . '/../includes/SAs/PeliculaSA.php';
require_once __DIR__ . '/../includes/SAs/reviewSA.php';
require_once __DIR__ . '/../includes/DTOs/reviewDTO.php';
require_once __DIR__ . '/Formulario.php';

$tituloPagina = 'AgregarReview';

// Definir una nueva clase que extienda Formulario
class FormularioAgregarReview extends Formulario
{
    public $ID='';
    public $pelicula= '';
    
    
    public function __construct($id)
    {
        parent::__construct('formAgregarReview', ['urlRedireccion' => '../estrenos.php']);
     $this->ID=$id;
    }
    // Método para generar los campos del formulario
    protected function generaCamposFormulario(&$datos)
    {
        $contenidoPrincipal = <<<EOS
            <div class="film-container">
                <label for="titulo">Título:</label>
                <input type="text" id="titulo" name="titulo" required>
                <label for="critica">Crítica:</label>
                <input type="text" id="critica" name="critica" required>
                <label for="puntuacion">Puntuacion:</label>
                <input type="text" id="puntuacion" name="puntuacion" required>
                <button type="submit">Agregar</button>
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
            $peliculaSA= new peliculaSA();
            $this->pelicula=$peliculaSA->obtenerPeliculaPorID($this->ID);
            $review = $reviewSA->crearReview($this->ID, $_SESSION["username"], $titulo, $critica, $puntuacion, $this->pelicula->getNombre());
        }
    }

    // Método para mostrar el formulario
    public function mostrarFormulario()
    {
        echo $this->generaFormulario();
    }
}


