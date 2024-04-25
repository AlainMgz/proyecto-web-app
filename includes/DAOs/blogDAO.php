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

        // Aquí deberías establecer la conexión a la base de datos
    }
    public function crearPelicula(PeliculaDTO $pelicula)
    {
        // Preparar la consulta SQL
        $this->conexion = Aplicacion::getInstance()->getConexionBd();
        $query = "INSERT INTO peliculas (nombre, descripcion, director, genero, caratula, trailer, numValoraciones, valoracion) VALUES (?, ?, ?, ?, ?, ?, 0, 0)";
        $statement = $this->conexion->prepare($query);

        // Verificar si la preparación de la consulta fue exitosa
        if (!$statement) {
            die("Error al preparar la consulta: " . $this->conexion->error);
        }

        // Obtener los valores de la película y filtrarlos
        $valores = $pelicula->getPelicula();
        $nombre = html_entity_decode($valores['nombre']);
        $descripcion = html_entity_decode($valores['descripcion']);
        $director = html_entity_decode($valores['director']);
        $genero = html_entity_decode($valores['genero']);
        $caratula = html_entity_decode($valores['caratula']);
        $trailer = html_entity_decode($valores['trailer']);

        // Escape de los valores para prevenir inyección SQL
        $nombre = $this->conexion->real_escape_string($nombre);
        $descripcion = $this->conexion->real_escape_string($descripcion);
        $director = $this->conexion->real_escape_string($director);
        $genero = $this->conexion->real_escape_string($genero);
        $caratula = $this->conexion->real_escape_string($caratula);
        $trailer = $this->conexion->real_escape_string($trailer);

        // Ejecutar la consulta con los valores proporcionados
        $statement->bind_param("ssssss", $nombre, $descripcion, $director, $genero, $caratula, $trailer);
        $statement->execute();

        // Verificar si se insertó alguna fila
        $rows_affected = $statement->affected_rows;

        // Cerrar la declaración
        $statement->close();

        // Retornar verdadero si se insertó alguna fila, falso de lo contrario
        return $rows_affected > 0;
    }

    /*
Crear
Editar
Borrar
Likear
Comentar
    */

}