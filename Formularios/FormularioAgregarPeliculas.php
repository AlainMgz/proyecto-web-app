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
        parent::__construct('formAgregarPelicula', ['urlRedireccion' => '../index.php']);
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

        // Contenido del formulario con el selector de género
        $contenidoPrincipal = <<<EOS
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div class="film-container">
                            <form action="tu_ruta_de_destino.php" method="POST" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="nombrePelicula">Nombre:</label>
                                    <input type="text" class="form-control" id="nombrePelicula" name="nombrePelicula" required>
                                </div>
                                <div class="form-group">
                                    <label for="descripcion">Descripción:</label>
                                    <textarea class="form-control" id="descripcion" name="descripcion" rows="4" required></textarea>
                                    </div>
                                <div class="form-group">
                                    <label for="director">Director:</label>
                                    <input type="text" class="form-control" id="director" name="director" required>
                                </div>
                                <div class="form-group">
                                    <label for="genero">Género:</label>
                                    <select class="form-control" id="genero" name="genero" required>
                                        <option value="" disabled selected>Selecciona un género</option>
                                        $opciones
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="caratula">Carátula:</label>
                                    <input type="file" class="form-control-file" id="caratula" name="caratula" accept=".png" required>
                                </div>
                                <div class="form-group">
                                    <label for="trailer">Tráiler:</label>
                                    <input type="text" class="form-control" id="trailer" name="trailer" required>
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

