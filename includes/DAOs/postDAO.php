<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../session_start.php';
require_once __DIR__ . '/../DTOs/reviewDTO.php';

class postDAO
{
    private $conexion;

    public function __construct()
    {
        // En el constructor nos conectamos a la BD
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "web_app_proyecto";
    }

    /*
FIX: Ahora todas las conexiones se hacen desde las funciones.
    */


    public function creaPost(postDTO $postDTO)
    {
        // Establecer la conexión a la base de datos
        $this->conexion = Aplicacion::getInstance()->getConexionBd();
        if ($this->conexion->connect_error) {
            die("Error de conexión a la base de datos: " . $this->conexion->connect_error);
        }

        // Obtener los valores del postDTO
        $id = $postDTO->getID();
        $usuario = $postDTO->getUsuario();
        $titulo = $postDTO->getTitulo();
        $texto = $postDTO->getTexto();
        $likes = $postDTO->getLikes();
        $esComentario = $postDTO->getEsComentario();
        $IDPadre = $postDTO->getIDPadre();

        // Preparar la consulta SQL
        $query = "INSERT INTO post (ID, usuario, titulo, texto, likes, esComentario, IDPadre) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $statement = $this->conexion->prepare($query);

        // Verificar si la preparación de la consulta fue exitosa
        if (!$statement) {
            die("Error al preparar la consulta: " . $this->conexion->error);
        }

        // Bind parameters
        $statement->bind_param("issisii", $id, $usuario, $titulo, $texto, $likes, $esComentario, $IDPadre);

        // Ejecutar la consulta
        $statement->execute();

        // Verificar si se insertó correctamente
        if ($statement->affected_rows === 1) {
            echo "Post insertado correctamente.";
        } else {
            echo "Error al insertar el post: " . $this->conexion->error;
        }

        // Cerrar la declaración
        $statement->close();

        // Cerrar la conexión
        $this->conexion->close();
    }

    public function buscarPosts()
    {
        // Establecer la conexión a la base de datos
        $this->conexion = Aplicacion::getInstance()->getConexionBd();

        // Preparar la consulta SQL
        $query = "SELECT * FROM post";
        $result = $this->conexion->query($query);

        // Verificar si la consulta fue exitosa
        if (!$result) {
            die("Error al ejecutar la consulta: " . $this->conexion->error);
        }

        // Crear un array para almacenar los posts
        $posts = array();

        // Obtener los resultados y mapearlos a objetos postDTO
        while ($row = $result->fetch_assoc()) {
            $post = new postDTO(
                $row['ID'],
                $row['usuario'],
                $row['titulo'],
                $row['texto'],
                $row['likes'],
                $row['esComentario'],
                $row['IDPadre']
            );
            $posts[] = $post;
        }

        // Cerrar la conexión
        // $this->conexion->close(); // Eliminar esta línea

        // Retornar el array de posts
        return $posts;
    }

    public function buscarPostsPorUsuario($usuario)
    {
        // Establecer la conexión a la base de datos
        $this->conexion = Aplicacion::getInstance()->getConexionBd();

        // Preparar la consulta SQL
        $query = "SELECT * FROM post WHERE usuario = ?";
        $statement = $this->conexion->prepare($query);

        // Verificar si la preparación de la consulta fue exitosa
        if (!$statement) {
            die("Error al preparar la consulta: " . $this->conexion->error);
        }

        // Bind parameter
        $statement->bind_param("s", $usuario);

        // Ejecutar la consulta
        $statement->execute();

        // Obtener el resultado de la consulta
        $result = $statement->get_result();

        // Verificar si la consulta fue exitosa
        if (!$result) {
            die("Error al ejecutar la consulta: " . $this->conexion->error);
        }

        // Crear un array para almacenar los posts
        $posts = array();

        // Obtener los resultados y mapearlos a objetos postDTO
        while ($row = $result->fetch_assoc()) {
            $post = new postDTO(
                $row['ID'],
                $row['usuario'],
                $row['titulo'],
                $row['texto'],
                $row['likes'],
                $row['esComentario'],
                $row['IDPadre']
            );
            $posts[] = $post;
        }

        // Cerrar la declaración
        $statement->close();

        // Cerrar la conexión
     

        // Retornar el array de posts
        return $posts;
    }
}
