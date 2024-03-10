<?php
require_once 'config.php';
require 'session_start.php';



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
            die("Error de conexión: " . $this->conexion->connect_error);
        }
    }

    public function crearPelicula(PeliculaDTO $pelicula)
    {
        // Preparar la consulta SQL
        $query = "INSERT INTO peliculas (nombre, descripcion, director, genero, caratula) VALUES (?, ?, ?, ?, ?)";
        $statement = $this->conexion->prepare($query);

        // Verificar si la preparación de la consulta fue exitosa
        if (!$statement) {
            die("Error al preparar la consulta: " . $this->conexion->error);
        }

        // Obtener los valores de la película
        $valores = $pelicula->getPelicula();

        // Ejecutar la consulta con los valores proporcionados
        $statement->bind_param("sssss", $valores['nombre'], $valores['descripcion'], $valores['director'], $valores['genero'], $valores['caratula']);
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
            die("Error al preparar la consulta: " . $this->conexion->error);
        }
    
        // Ejecutar la consulta con el parámetro ID
        $statement->bind_param("i", $ID); // "i" indica que $ID es un entero
        $statement->execute();
        
        // Manejar errores en la ejecución de la consulta
        if ($statement->error) {
            // Manejar el error de ejecución de la consulta
            die("Error al ejecutar la consulta: " . $statement->error);
        }
    
        // Verificar si se eliminó alguna fila
        return $statement->affected_rows > 0;
    }
    

    public function obtenerPeliculaPorID($ID)
    {
        $query = "SELECT * FROM peliculas WHERE ID = :?";
        $statement = $this->conexion->prepare($query);
        $statement->execute(array(':ID' => $ID));
        $peliculaData = $statement->fetch(PDO::FETCH_ASSOC);

        if ($peliculaData!=null) {
            // Crear un nuevo objeto PeliculaDTO con los datos recuperados
            $peliculaDTO = new PeliculaDTO(
                $peliculaData['ID'],
                $peliculaData['nombre'],
                $peliculaData['descripcion'],
                $peliculaData['director'],
                $peliculaData['genero'],
                $peliculaData['caratula']
            );


            return $peliculaDTO;
        } else {
            return null; // Opcional: Manejo de caso en el que no se encuentra ninguna película con el ID especificado
        }
    }

}