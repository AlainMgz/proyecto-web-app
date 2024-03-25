<?php
require_once __DIR__ .'/../config.php';
require_once __DIR__ . '/../session_start.php';

class rankingDAO
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

    public function obtenerMejorValoradas(){
        $query = "SELECT * FROM peliculas";
        $statement = $this->conexion->prepare($query);
        
        if (!$statement) {
            die("Error al preparar la consulta: " . $this->conexion->error);
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
                $row['trailer']
            );
            $peliculas[] = $pelicula;
        }
        
        return $peliculas;
    }
    public function modificarPelicula(PeliculaDTO $pelicula) {
    // Preparar la consulta SQL
    $query = "UPDATE peliculas SET nombre=?, descripcion=?, director=?, genero=?, caratula=? WHERE ID=?";
    $statement = $this->conexion->prepare($query);

    // Verificar si la preparación de la consulta fue exitosa
    if (!$statement) {
        die("Error al preparar la consulta: " . $this->conexion->error);
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
}