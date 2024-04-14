<?php
require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/session_start.php';
require_once __DIR__ . '/../includes/SAs/PeliculaSA.php';
require_once __DIR__ . '/Formulario.php';

$tituloPagina = 'ModificarPelicula';

// Definir una nueva clase que extienda Formulario
class FormularioModificarPeliculas extends Formulario
{
    public $id;
    public $pelicula;

    public function __construct($id)
    {
        parent::__construct('formModificarPelicula', ['urlRedireccion' => '../estrenos.php']);
        $this->id = $id;
    }
    // Método para generar los campos del formulario
    protected function generaCamposFormulario(&$datos)
    {
        $peliculaSA = new PeliculaSA();
        $pelicula = $peliculaSA->obtenerPeliculaPorID($this->id);

        // Obtener los valores de la película utilizando los getters
        $nombre = $pelicula->getNombre();
        $descripcion = $pelicula->getDescripcion();
        $director = $pelicula->getDirector();
        $genero = $pelicula->getGenero();
        $caratula = $pelicula->getCaratula();
        $trailer = $pelicula->getTrailer();
        $numValoraciones = $pelicula->getNumValoraciones();
        $media = $pelicula->getValoracion();
        $opcionesGenero = $peliculaSA->getGeneros();

        // Genera las opciones del selector
        $opciones = '';
        foreach ($opcionesGenero as $opcion) {
            // Verifica si la opción es igual al género de la película
            $selected = ($opcion === $genero) ? 'selected' : '';
            $opciones .= '<option value="' . $opcion . '" ' . $selected . '>' . $opcion . '</option>';
        }

        $contenidoPrincipal = <<<EOS
        <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="film-container">
                    <form action="tu_ruta_de_destino.php" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="nombrePelicula">Nombre:</label>
                            <input type="text" class="form-control" id="nombrePelicula" name="nombrePelicula" value="$nombre" required>
                        </div>
                        <div class="form-group">
                            <label for="descripcion">Descripción:</label>
                            <textarea class="form-control" id="descripcion" name="descripcion" rows="4" value="$descripcion" required></textarea>
                            </div>
                        <div class="form-group">
                            <label for="director">Director:</label>
                            <input type="text" class="form-control" id="director" name="director" value="$director" required>
                        </div>
                        <div class="form-group">
                            <label for="genero">Género:</label>
                            <select class="form-control" id="genero" name="genero" value="$genero" required>
                                <option value="" disabled selected>Selecciona un género</option>
                                $opciones
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="caratula">Carátula:</label>
                            <input type="file" class="form-control-file" id="caratula" name="caratula" accept=".png" value="$caratula" required>
                        </div>
                        <div class="form-group">
                            <label for="trailer">Tráiler:</label>
                            <input type="text" class="form-control" id="trailer" name="trailer" value="$trailer" required>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Agregar</button>
                        </div>
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

        $nombrePelicula = trim($datos['nombrePelicula'] ?? '');
        $nombrePelicula = filter_var($nombrePelicula, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if (!$nombrePelicula || mb_strlen($nombrePelicula) > 20) {
            $this->errores['nombrePelicula'] = 'El nombre de la pelicula no puede tener ms de 20 caracteres.';
        }

        $descripcion = trim($datos['descripcion'] ?? '');
        $descripcion = filter_var($descripcion, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if (!$descripcion || mb_strlen($descripcion) < 5) {
            $this->errores['descripcion'] = 'La descripcion debe tener una longitud de al menos 5 caracteres.';
        }

        $director = trim($datos['director'] ?? '');
        $director = filter_var($director, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if (!$director || mb_strlen($director) < 5 || mb_strlen($director) > 20) {
            $this->errores['password'] = 'El password tiene que tener una longitud de al menos 5 caracteres y de menos de 20.';
        }

        $genero = trim($datos['genero'] ?? '');
        $genero = filter_var($genero, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if (!$genero || mb_strlen($genero) > 30) {
            $this->errores['genero'] = 'El genero debe tener menos de 30 caracteres';
        }
        $caratula = trim($datos['caratula'] ?? '');
        $caratula = filter_var($caratula, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if (!$caratula || mb_strlen($caratula) > 100) {
            $this->errores['caratula'] = 'La URL de la caratula no puede superar los 100 caracteres';
        }
        $trailer = trim($datos['trailer'] ?? '');
        $trailer = filter_var($trailer, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if (!$trailer || mb_strlen($trailer) > 200) {
            $this->errores['trailer'] = 'La URL del trailer no puede superar los 200 caracteres';
        }

        if (count($this->errores) === 0) {
            $peliculaSA = new PeliculaSA();
            $peliculaSA->borrarPelicula($this->id);
            $peliculaSA->crearPelicula(0, $nombrePelicula, $descripcion, $director, $genero, $caratula, $trailer);
        }
    }

    // Método para mostrar el formulario
    public function mostrarFormulario()
    {
        echo $this->generaFormulario();
    }
}

