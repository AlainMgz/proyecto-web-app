<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../session_start.php';

class PeliculaDAO
{
    private $conexion;

    public function __construct()
    {
        //En el constructor nos conectamos a la BD
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "web_app_proyecto";

        // Crear la conexión
        $this->conexion = new mysqli($servername, $username, $password, $dbname);

        // Verificar si la conexión fue exitosa
        if ($this->conexion->connect_error) {
            die ("Error de conexión: " . $this->conexion->connect_error);
        }
    }

    public function crearPelicula(PeliculaDTO $pelicula)
    {
        // Preparar la consulta SQL
        $query = "INSERT INTO peliculas (nombre, descripcion, director, genero, caratula, numValoraciones, valoracion) VALUES (?, ?, ?, ?, ?, 0, 0)";
        $statement = $this->conexion->prepare($query);

        // Verificar si la preparación de la consulta fue exitosa
        if (!$statement) {
            die ("Error al preparar la consulta: " . $this->conexion->error);
        }

        // Obtener los valores de la película
        $valores = $pelicula->getPelicula();

        // Ejecutar la consulta con los valores proporcionados
        $statement->bind_param("sssss", $valores['nombre'], $valores['descripcion'], $valores['director'], $valores['genero'], $valores['caratula'],  $valores['numValoraciones'],  $valores['valoracion']);
        $statement->execute();

        // Verificar si se insertó alguna fila
        $rows_affected = $statement->affected_rows;

        // Cerrar la declaración
        $statement->close();

        // Retornar verdadero si se insertó alguna fila, falso de lo contrario
        return $rows_affected > 0;
    }

    public function borrarPelicula($ID)
    {
        // Validar el parámetro ID
        if (!is_numeric($ID) || $ID <= 0) {
            // Manejar el error de ID no válido
            return false;
        }

        // Consulta preparada con marcadores de posición sin nombres específicos
        $query = "DELETE FROM peliculas WHERE ID = ?";
        $statement = $this->conexion->prepare($query);
        if (!$statement) {
            // Manejar el error al preparar la consulta
            die ("Error al preparar la consulta: " . $this->conexion->error);
        }

        // Ejecutar la consulta con el parámetro ID
        $statement->bind_param("i", $ID); // "i" indica que $ID es un entero
        $statement->execute();

        // Manejar errores en la ejecución de la consulta
        if ($statement->error) {
            // Manejar el error de ejecución de la consulta
            die ("Error al ejecutar la consulta: " . $statement->error);
        }

        // Verificar si se eliminó alguna fila
        return $statement->affected_rows > 0;
    }


    public function obtenerPeliculaPorID($ID)
    {
        $query = "SELECT * FROM peliculas WHERE ID = ?";
        $statement = $this->conexion->prepare($query);
        $statement->bind_param("i", $ID); // "i" indica que $ID es un integer
        $statement->execute();
        $result = $statement->get_result();

        // Obtener la fila de resultados como un array asociativo
        $peliculaData = $result->fetch_assoc();

        if ($peliculaData != null) {
            // Crear un nuevo objeto PeliculaDTO con los datos recuperados
            $peliculaDTO = new PeliculaDTO(
                $peliculaData['ID'],
                $peliculaData['nombre'],
                $peliculaData['descripcion'],
                $peliculaData['director'],
                $peliculaData['genero'],
                $peliculaData['caratula'],
                $peliculaData['trailer'],
                $peliculaData['numValoraciones'],
                $peliculaData['valoracion']
            );

            return $peliculaDTO;
        } else {
            return null; // Opcional: Manejo de caso en el que no se encuentra ninguna película con el nombre especificado
        }
    }

    public function obtenerPeliculaPorNombre($nombre)
    {
        $query = "SELECT * FROM peliculas WHERE nombre = ?";
        $statement = $this->conexion->prepare($query);
        $statement->bind_param("s", $nombre); // "s" indica que $nombre es una cadena
        $statement->execute();
        $result = $statement->get_result();

        // Obtener la fila de resultados como un array asociativo
        $peliculaData = $result->fetch_assoc();

        if ($peliculaData != null) {
            // Crear un nuevo objeto PeliculaDTO con los datos recuperados
            $peliculaDTO = new PeliculaDTO(
                $peliculaData['ID'],
                $peliculaData['nombre'],
                $peliculaData['descripcion'],
                $peliculaData['director'],
                $peliculaData['genero'],
                $peliculaData['caratula'],
                $peliculaData['trailer'],
                $peliculaData['numValoraciones'],
                $peliculaData['valoraciones']
            );

            return $peliculaDTO;
        } else {
            return null; // Opcional: Manejo de caso en el que no se encuentra ninguna película con el nombre especificado
        }
    }

    public function filtrarPeliculasPorGenero($genero)
    {
        if ($genero == "Todos") {
            return $this->obtenerListaPeliculas();
        }
        // Consulta SQL para obtener todas las películas del género especificado
        $query = "SELECT * FROM peliculas WHERE genero = ?";

        // Preparar la consulta SQL
        $statement = $this->conexion->prepare($query);

        // Verificar si la preparación de la consulta fue exitosa
        if (!$statement) {
            die ("Error al preparar la consulta: " . $this->conexion->error);
        }

        // Ejecutar la consulta con el género proporcionado
        $statement->bind_param("s", $genero); // "s" indica que $genero es una cadena
        $statement->execute();

        // Obtener el resultado de la consulta
        $result = $statement->get_result();

        // Crear un array para almacenar las películas del género especificado
        $peliculas = array();

        // Recorrer los resultados y crear objetos PeliculaDTO
        while ($row = $result->fetch_assoc()) {
            $pelicula = new PeliculaDTO(
                $row['ID'],
                $row['nombre'],
                $row['descripcion'],
                $row['director'],
                $row['genero'],
                $row['caratula'],
                $row['trailer'],
                $row['numValoraciones'],
                $row['valoracion']
            );
            // Agregar la película al array
            $peliculas[] = $pelicula;
        }

        // Retornar el array de películas del género especificado
        return $peliculas;
    }

    public function obtenerListaPeliculas()
    {
        $query = "SELECT * FROM peliculas";
        $statement = $this->conexion->prepare($query);

        if (!$statement) {
            die ("Error al preparar la consulta: " . $this->conexion->error);
        }

        $statement->execute();

        $result = $statement->get_result();

        $peliculas = array();

        while ($row = $result->fetch_assoc()) {
            $pelicula = new PeliculaDTO(
                $row['ID'],
                $row['nombre'],
                $row['descripcion'],
                $row['director'],
                $row['genero'],
                $row['caratula'],
                $row['trailer'],
                $row['numValoraciones'],
                $row['valoracion']
            );
            $peliculas[] = $pelicula;
        }

        return $peliculas;
    }
    public function modificarPelicula(PeliculaDTO $pelicula)
    {
        // Preparar la consulta SQL
        $query = "UPDATE peliculas SET nombre=?, descripcion=?, director=?, genero=?, caratula=? WHERE ID=?";
        $statement = $this->conexion->prepare($query);

        // Verificar si la preparación de la consulta fue exitosa
        if (!$statement) {
            die ("Error al preparar la consulta: " . $this->conexion->error);
        }

        // Obtener los valores de la película
        $valores = $pelicula->getPelicula();

        // Obtener el ID de la película
        $id = $valores['ID'];

        // Ejecutar la consulta con los valores proporcionados
        $statement->bind_param("sssssi", $valores['nombre'], $valores['descripcion'], $valores['director'], $valores['genero'], $valores['caratula'], $id);
        $statement->execute();

        // Verificar si se modificó alguna fila
        $rows_affected = $statement->affected_rows;

        // Cerrar la declaración
        $statement->close();

        // Retornar verdadero si se modificó alguna fila, falso de lo contrario
        return $rows_affected > 0;
    }

    public function getGeneros()
    {
        $query = "SELECT * FROM generos";
        $statement = $this->conexion->prepare($query);

        if (!$statement) {
            die ("Error al preparar la consulta: " . $this->conexion->error);
        }

        $statement->execute();

        $result = $statement->get_result();

        $generos = array();

        while ($row = $result->fetch_assoc()) {
            $generos[] = $row['genero']; // Agregar el valor de la columna 'genero' al array $generos
        }

        return $generos;
    }

}