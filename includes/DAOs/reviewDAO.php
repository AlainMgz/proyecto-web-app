<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../session_start.php';
require_once __DIR__ . '/../DTOs/reviewDTO.php';

class ReviewDAO
{
    private $conexion;

    public function __construct()
    {
        // En el constructor nos conectamos a la BD
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

    public function crearReview(ReviewDTO $review)
    {
        // Preparar la consulta SQL
        $query = "INSERT INTO reviews (usuario, titulo, critica, puntuacion, pelicula) VALUES (?, ?, ?, ?, ?)";
        $statement = $this->conexion->prepare($query);

        // Verificar si la preparación de la consulta fue exitosa
        if (!$statement) {
            die("Error al preparar la consulta: " . $this->conexion->error);
        }

        // Obtener los valores de la review
        $valores = $review->getReview();

        // Ejecutar la consulta con los valores proporcionados
        $statement->bind_param("sssis", $valores['usuario'], $valores['titulo'], $valores['critica'], $valores['puntuacion'], $valores['pelicula']);
        $statement->execute();

        // Verificar si se insertó alguna fila
        $rows_affected = $statement->affected_rows;

        // Cerrar la declaración
        $statement->close();

        // Retornar verdadero si se insertó alguna fila, falso de lo contrario
        return $rows_affected > 0;
    }

    public function borrarReview($ID)
    {
        // Validar el parámetro ID
        if (!is_numeric($ID) || $ID <= 0) {
            // Manejar el error de ID no válido
            return false;
        }

        // Consulta preparada con marcadores de posición sin nombres específicos
        $query = "DELETE FROM reviews WHERE ID = ?";
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

    public function obtenerListaReviews()
    {
        $query = "SELECT * FROM reviews";
        $statement = $this->conexion->prepare($query);

        if (!$statement) {
            die ("Error al preparar la consulta: " . $this->conexion->error);
        }

        $statement->execute();

        $result = $statement->get_result();

        $reviews= array();

        while ($row = $result->fetch_assoc()) {
            $review = new reviewDTO(
                $row['ID'],
                $row['usuario'],
                $row['titulo'],
                $row['critica'],
                $row['puntuacion'],
                $row['pelicula']
             
            );
            $reviews[] = $review;
        }

        return $reviews;
    }
    /*COMPLETAR*/
    public function modificarReview(ReviewDTO $review)
    {

    }
    public function obtenerReviewPorID($id)
    {


    }

    public function obtenerReviewPorUsuario($usuario)
    {

    }

    public function obtenerReviewPorPelicula($pelicula) //pelicula es el nombre de la pelicula
    {
  // Consulta SQL para obtener todas las películas del género especificado
  $query = "SELECT * FROM reviews WHERE pelicula  = ?";

  // Preparar la consulta SQL
  $statement = $this->conexion->prepare($query);

  // Verificar si la preparación de la consulta fue exitosa
  if (!$statement) {
      die ("Error al preparar la consulta: " . $this->conexion->error);
  }

  // Ejecutar la consulta con el género proporcionado
  $statement->bind_param("s", $pelicula); // "s" indica que $genero es una cadena
  $statement->execute();

  // Obtener el resultado de la consulta
  $result = $statement->get_result();

  // Crear un array para almacenar las películas del género especificado
  $reviews = array();

  while ($row = $result->fetch_assoc()) {
      $review = new reviewDTO(
        $row['ID'],
                $row['usuario'],
                $row['titulo'],
                $row['critica'],
                $row['puntuacion'],
                $row['pelicula']
      );
      // Agregar la película al array
      $reviews[] = $review;
  }

  // Retornar el array de películas del género especificado
  return $reviews;
    }

}
