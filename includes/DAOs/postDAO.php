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
        $id = $postDTO->getID();
        $usuario = $postDTO->getUsuario();
        $titulo = $postDTO->getTitulo();
        $texto = $postDTO->getTexto();
        $likes = $postDTO->getLikes();
        $esComentario= $postDTO->getEsComentario();
        $IDPadre= $postDTO->getIDPadre();
    
        // Preparar la consulta SQL
        $stmt = $this->conexion->prepare("INSERT INTO post (ID, usuario, titulo, texto, likes, esComentario, IDPadre) VALUES (?, ?, ?, ?, ?, ?, ?)");
        if ($stmt === false) {
            die("Error al preparar la consulta: " . $this->conexion->error);
        }
    
        // Bind parameters
        $stmt->bind_param("issisii", $id, $usuario, $titulo, $texto, $likes, $esComentario, $IDPadre);
    
        // Ejecutar la consulta
        $stmt->execute();
    
        // Verificar si se insertó correctamente
        if ($stmt->affected_rows === 1) {
            echo "Post insertado correctamente.";
        } else {
            echo "Error al insertar el post: " . $this->conexion->error;
        }
    
        // Cerrar la declaración
        $stmt->close();
    }
    
}

