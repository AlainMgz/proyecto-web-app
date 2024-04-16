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
            <div class="film-container">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombrePelicula" name="nombrePelicula" value="$nombre" required>
                <label for="descripcion">Descripción:</label>
                <input type="text" id="descripcion" name="descripcion" value="$descripcion" required>
                <label for="director">Director:</label>
                <label for="genero">Género:</label>
                <select id="genero" name="genero" required>
                    <option value="" disabled>Selecciona un género</option>
                    $opciones
                </select>
                <input type="text" id="director" name="director" value="$director" required>
                <label for="caratula">Carátula:</label>
                <input type="file" id="caratula" name="caratula" accept=".jpg, .png, .jpeg, .gif" required>
                <label for="trailer">Tráiler:</label>
                <input type="text" id="trailer" name="trailer" value="$trailer" required>
                <button type="submit">Agregar</button>
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
        if (isset($_FILES['caratula']) && $_FILES['caratula']['error'] == 0) {
            $targetDir = __DIR__ . '/../img/';
            $targetFile = $targetDir . basename($_FILES['caratula']['name']);
            
            $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
            $allowedTypes = array('png', 'jpg', 'jpeg', 'gif');

            if (!in_array($fileType, $allowedTypes)) {
                $this->errores['caratula'] = 'Solo se permiten archivos de tipo PNG, JPG, JPEG y GIF';
            } else {
                if (move_uploaded_file($_FILES['caratula']['tmp_name'], $targetFile)) {
                    $caratula = basename($_FILES['caratula']['name']);
                } else {
                    $this->errores['caratula'] = 'Ha habido un error al subir la imagen';
                }
            }
        }
        $trailer = trim($datos['trailer'] ?? '');
        $trailer = filter_var($trailer, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if (!$trailer || mb_strlen($trailer) > 200) {
            $this->errores['trailer'] = 'La URL del trailer no puede superar los 200 caracteres';
        }

        if (count($this->errores) === 0) {
            $pelicula = new PeliculaDTO(0, $nombrePelicula, $descripcion, $director, $genero, $caratula, $trailer, $this->numValoraciones, $this->media);
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

