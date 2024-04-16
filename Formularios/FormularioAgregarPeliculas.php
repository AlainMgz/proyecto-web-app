<?php
require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/session_start.php';
require_once __DIR__ . '/../includes/SAs/PeliculaSA.php';
require_once __DIR__ . '/Formulario.php';

$tituloPagina = 'AgregarPelicula';

// Definir una nueva clase que extienda Formulario
class FormularioAgregarPeliculas extends Formulario
{
    public function __construct()
    {
        parent::__construct('formAgregarPelicula', ['urlRedireccion' => '../index.php', 'enctype' => 'multipart/form-data']);
    }
    // Método para generar los campos del formulario
    protected function generaCamposFormulario(&$datos)
    {
        $peliculaSA = new PeliculaSA();
        // Array de opciones para el selector de género
        $opcionesGenero = $peliculaSA->getGeneros();

        // Genera las opciones del selector
        $opciones = '';
        foreach ($opcionesGenero as $opcion) {
            $opciones .= '<option value="' . $opcion . '">' . $opcion . '</option>';
        }
        //print_r($this->errores);
        // Contenido del formulario con el selector de género
        $contenidoPrincipal = <<<EOS
            <div class="film-container">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombrePelicula" name="nombrePelicula" required>
                <label for="descripcion">Descripción:</label>
                <input type="text" id="descripcion" name="descripcion" required>
                <label for="director">Director:</label>
                <input type="text" id="director" name="director" required>
                <label for="genero">Género:</label>
                <select id="genero" name="genero" required>
                    <option value="" disabled selected>Selecciona un género</option>
                    $opciones
                </select>
                <label for="caratula">Carátula:</label>
                <input type="file" id="caratula" name="caratula" accept=".png, .jpg, .jpeg, .gif" required>
                <label for="trailer">Tráiler:</label>
                <input type="text" id="trailer" name="trailer" required>
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
            $this->errores['nombrePelicula'] = 'El nombre de la pelicula no puede tener mas de 20 caracteres.';
        }

        $descripcion = trim($datos['descripcion'] ?? '');
        $descripcion = filter_var($descripcion, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if (!$descripcion || mb_strlen($descripcion) < 5) {
            $this->errores['descripcion'] = 'La descripcion debe tener una longitud de al menos 5 caracteres.';
        }

        $director = trim($datos['director'] ?? '');
        $director = filter_var($director, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if (!$director || mb_strlen($director) < 5 || mb_strlen($director) > 20) {
            $this->errores['password'] = 'El nombre del director tiene que tener una longitud de al menos 5 caracteres y de menos de 20.';
        }

        $genero = trim($datos['genero'] ?? '');
        $genero = filter_var($genero, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if (!$genero || mb_strlen($genero) > 30) {
            $this->errores['genero'] = 'El genero debe tener menos de 30 caracteres';
        }
        if (isset($_FILES['caratula']) && $_FILES['caratula']['error'] == 0) {
            $targetDir = __DIR__ . '/../img/';
            $fileType = strtolower(pathinfo($_FILES['caratula']['name'], PATHINFO_EXTENSION));
            $targetFile = $targetDir . $nombrePelicula . $fileType;
            $allowedTypes = array('png', 'jpg', 'jpeg', 'gif');
            $maxFileSize = 10 * 1024 * 1024; // 10MB
            
            if (!in_array($fileType, $allowedTypes)) {
                echo $fileType;
                $this->errores['caratula'] = 'Solo se permiten archivos de tipo PNG, JPG, JPEG y GIF';
            } elseif ($_FILES['caratula']['size'] > $maxFileSize) {
                $this->errores['caratula'] = 'El tamaño de la imagen no puede superar los 10MB';
            } elseif (move_uploaded_file($_FILES['caratula']['tmp_name'], $targetFile)) {
                $caratula = $nombrePelicula . "." . $fileType;
            } else {
                echo 'Error al subir la imagen';
                $this->errores['caratula'] = 'Ha habido un error al subir la imagen';
            }
        } else {
            echo 'No se ha subido la imagen';
            $this->errores['caratula'] = 'No se ha subido la imagen';
        }
        $trailer = trim($datos['trailer'] ?? '');
        $trailer = filter_var($trailer, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if (!$trailer || mb_strlen($trailer) > 200) {
            $this->errores['trailer'] = 'La URL del trailer no puede superar los 200 caracteres';
        }

        if (count($this->errores) === 0) {
            $pelicula = new PeliculaDTO(0, $nombrePelicula, $descripcion, $director, $genero, $caratula, $trailer, 0, 0);
            $peliculaSA = new PeliculaSA();
            $peliculaSA->crearPelicula(0, $nombrePelicula, $descripcion, $director, $genero, $caratula, $trailer);
        }
    }

    // Método para mostrar el formulario
    public function mostrarFormulario()
    {
        echo $this->generaFormulario();
    }
}

