<?php
require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/session_start.php';
require_once __DIR__ . '/../includes/SAs/ReviewSA.php';
require_once __DIR__ . '/Formulario.php';

$tituloPagina = 'ModificarPelicula';

// Definir una nueva clase que extienda Formulario
class FormularioModificarReview extends Formulario{
    public $id;
    public $review;

  public function __construct($id) {
    parent::__construct('formModificarReview', ['urlRedireccion' => '../estrenos.php']);
    $this->id = $id;
    $reviewSA = new reviewSA();
    $this->review = $reviewSA->obtenerReviewPorID($this->id);
}
    // Método para generar los campos del formulario
    protected function generaCamposFormulario(&$datos)
    {
       
        $titulo = $this->review->getTitulo();
        $critica = $this->review->getCritica();
        $puntuacion = $this->review->getPuntuacion();
    
        $contenidoPrincipal = <<<EOS
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="film-container">
                        <form action="tu_ruta_de_destino.php" method="POST">
                            <div class="form-group">
                                <label for="titulo">Título:</label>
                                <input type="text" class="form-control" id="titulo" name="titulo" value="$titulo" required>
                            </div>
                            <div class="form-group">
                                <label for="critica">Crítica:</label>
                                <textarea class="form-control" id="critica" name="critica" rows="4" value="$critica" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="puntuacion">Puntuación:</label>
                                <select class="form-control" id="puntuacion" name="puntuacion" value="$puntuacion" required>
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

        $tituloReview = trim($datos['titulo'] ?? '');
        $tituloReview = filter_var($tituloReview, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if (!$tituloReview || mb_strlen($tituloReview) > 20) {
            $this->errores['titulo'] = 'El titulo de la critica no puede tener mas de 100 caracteres.';
        }

        $critica = trim($datos['critica'] ?? '');
        $critica = filter_var($critica, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if (!$critica || mb_strlen($critica) > 300) {
            $this->errores['critica'] = 'La critica debe tener una longitud inferior a 300 caracteres.';
        }

        $puntuacion = trim($datos['puntuacion'] ?? '');
        $puntuacion = filter_var($puntuacion, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        
        if (count($this->errores) === 0) {
                $reviewSA = new reviewSA();
                $reviewSA->borrarReview($this->id);
                $reviewSA->crearReview($this->id, $this->review->getUsuario(), $tituloReview, $critica, $puntuacion, $this->review->getPelicula());
        }
    }

    // Método para mostrar el formulario
    public function mostrarFormulario()
    {
        echo $this->generaFormulario();
    }
}

