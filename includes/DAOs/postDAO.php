<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../session_start.php';
require_once __DIR__ . '/../DTOs/reviewDTO.php';
require_once __DIR__ . '/../DTOs/comentarioDTO.php';

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
        $statement->bind_param("isssiii", $id, $usuario, $titulo, $texto, $likes, $esComentario, $IDPadre);
    
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

    public function agregarComentario($comentarioDTO)
    {
        // Establecer la conexión a la base de datos
        $this->conexion = Aplicacion::getInstance()->getConexionBd();

        // Obtener los valores del comentarioDTO
        $id_post = $comentarioDTO->getIdPost();
        $usuario = $comentarioDTO->getUsuario();
        $contenido = $comentarioDTO->getContenido();

        // Preparar la consulta SQL
        $query = "INSERT INTO comentarios (id_post, usuario, contenido) VALUES (?, ?, ?)";
        $statement = $this->conexion->prepare($query);

        // Verificar si la preparación de la consulta fue exitosa
        if (!$statement) {
            die("Error al preparar la consulta: " . $this->conexion->error);
        }

        // Bind parameters
        $statement->bind_param("iss", $id_post, $usuario, $contenido);

        // Ejecutar la consulta
        $statement->execute();

        // Verificar si se insertó correctamente
        if ($statement->affected_rows === 1) {
            echo "Comentario insertado correctamente.";
        } else {
            echo "Error al insertar el comentario: " . $this->conexion->error;
        }

        // Cerrar la declaración
        $statement->close();

    }

    public function borrarPost($id_post)
    {
        // Establecer la conexión a la base de datos
        $this->conexion = Aplicacion::getInstance()->getConexionBd();

        // Eliminar todos los comentarios asociados al post
        $queryDeleteComments = "DELETE FROM comentarios WHERE id_post = ?";
        $statementDeleteComments = $this->conexion->prepare($queryDeleteComments);

        // Verificar si la preparación de la consulta fue exitosa
        if (!$statementDeleteComments) {
            die("Error al preparar la consulta para eliminar comentarios: " . $this->conexion->error);
        }

        // Bind parameter
        $statementDeleteComments->bind_param("i", $id_post);

        // Ejecutar la consulta
        $statementDeleteComments->execute();

        // Verificar si se eliminaron los comentarios correctamente
        if ($statementDeleteComments->affected_rows < 0) {
            echo "Error al eliminar comentarios asociados al post: " . $this->conexion->error;
        }

        // Cerrar la declaración
        $statementDeleteComments->close();

        // Preparar la consulta SQL para eliminar el post
        $queryDeletePost = "DELETE FROM post WHERE ID = ?";
        $statementDeletePost = $this->conexion->prepare($queryDeletePost);

        // Verificar si la preparación de la consulta fue exitosa
        if (!$statementDeletePost) {
            die("Error al preparar la consulta para eliminar el post: " . $this->conexion->error);
        }

        // Bind parameter
        $statementDeletePost->bind_param("i", $id_post);

        // Ejecutar la consulta
        $statementDeletePost->execute();

        // Verificar si se eliminó el post correctamente
        if ($statementDeletePost->affected_rows === 1) {
            echo "Post eliminado correctamente.";
        } else {
            echo "Error al eliminar el post: " . $this->conexion->error;
        }

        // Cerrar la declaración
        $statementDeletePost->close();

        // Cerrar la conexión
        $this->conexion->close();
    }

    public function buscarComentarios($id_post)
    {
        // Establecer la conexión a la base de datos
        $this->conexion = Aplicacion::getInstance()->getConexionBd();

        // Array para almacenar los comentarios
        $comentarios = array();

        // Preparar la consulta SQL
        $query = "SELECT * FROM comentarios WHERE id_post = ?";
        $statement = $this->conexion->prepare($query);

        // Verificar si la preparación de la consulta fue exitosa
        if (!$statement) {
            die("Error al preparar la consulta: " . $this->conexion->error);
        }

        // Bind parameter
        $statement->bind_param("i", $id_post);

        // Ejecutar la consulta
        $statement->execute();

        // Obtener el resultado de la consulta
        $result = $statement->get_result();

        // Verificar si la consulta fue exitosa
        if (!$result) {
            die("Error al ejecutar la consulta: " . $this->conexion->error);
        }

        // Obtener los resultados y mapearlos a objetos comentarioDTO
        while ($row = $result->fetch_assoc()) {
            $comentario = new comentarioDTO(
                $row['id'],
                $row['id_post'],
                $row['usuario'],
                $row['contenido'],
                $row['fecha']
            );
            $comentarios[] = $comentario;
        }

        // Cerrar la declaración
        $statement->close();

        // Cerrar la conexión
        // $this->conexion->close(); // Eliminar esta línea si la conexión se cierra en otro lugar

        // Retornar el array de comentarios
        return $comentarios;
    }

    public function borrarComentario($id_comentario)
    {
        // Establecer la conexión a la base de datos
        $this->conexion = Aplicacion::getInstance()->getConexionBd();

        // Preparar la consulta SQL para eliminar el comentario
        $query = "DELETE FROM comentarios WHERE id = ?";
        $statement = $this->conexion->prepare($query);

        // Verificar si la preparación de la consulta fue exitosa
        if (!$statement) {
            die("Error al preparar la consulta para eliminar el comentario: " . $this->conexion->error);
        }

        // Bind parameter
        $statement->bind_param("i", $id_comentario);

        // Ejecutar la consulta
        $statement->execute();

        // Verificar si se eliminó el comentario correctamente
        if ($statement->affected_rows === 1) {
            echo "Comentario eliminado correctamente.";
        } else {
            echo "Error al eliminar el comentario: " . $this->conexion->error;
        }

        // Cerrar la declaración
        $statement->close();

        // Cerrar la conexión
        $this->conexion->close();
    }

    public function agregarLike($IDpost, $id_usuario)
    {
        // Establecer la conexión a la base de datos
        $this->conexion = Aplicacion::getInstance()->getConexionBd();
    
        // Iniciar una transacción
        $this->conexion->begin_transaction();
    
        // Preparar la consulta SQL para insertar el like en la tabla likes
        $query_likes = "INSERT INTO likes (id, id_post) VALUES (?, ?)";
        $statement_likes = $this->conexion->prepare($query_likes);
    
        // Verificar si la preparación de la consulta fue exitosa
        if (!$statement_likes) {
            die("Error al preparar la consulta para agregar like: " . $this->conexion->error);
        }
    
        // Bind parameters para la tabla likes
        $statement_likes->bind_param("ii", $id_usuario, $IDpost);
    
        // Ejecutar la consulta para la tabla likes
        $statement_likes->execute();
    
        // Verificar si se insertó el like correctamente en la tabla likes
        if ($statement_likes->affected_rows === 1) {
            echo "Like agregado correctamente al post con ID $IDpost.";
        } else {
            echo "Error al agregar like al post con ID $IDpost: " . $this->conexion->error;
        }
    
        // Cerrar la declaración de la tabla likes
        $statement_likes->close();
    
        // Preparar la consulta SQL para actualizar el número de likes en la tabla post
        $query_post = "UPDATE post SET likes = likes + 1 WHERE ID = ?";
        $statement_post = $this->conexion->prepare($query_post);
    
        // Verificar si la preparación de la consulta fue exitosa
        if (!$statement_post) {
            die("Error al preparar la consulta para agregar like: " . $this->conexion->error);
        }
    
        // Bind parameter para la tabla post
        $statement_post->bind_param("i", $IDpost);
    
        // Ejecutar la consulta para la tabla post
        $statement_post->execute();
    
        // Verificar si se actualizó el post correctamente
        if ($statement_post->affected_rows === 1) {
            echo "Like agregado correctamente al post con ID $IDpost.";
        } else {
            echo "Error al agregar like al post con ID $IDpost: " . $this->conexion->error;
        }
    
        // Cerrar la declaración de la tabla post
        $statement_post->close();
    
        // Hacer commit de la transacción
        $this->conexion->commit();
    
        // Cerrar la conexión
        $this->conexion->close();
    }
    

    public function usuarioDioLike($id_post, $id_usuario)
{
    // Establecer la conexión a la base de datos
    $this->conexion = Aplicacion::getInstance()->getConexionBd();

    // Preparar la consulta SQL para verificar si el usuario ya dio like al post
    $query = "SELECT COUNT(*) as count FROM likes WHERE id_post = ? AND id = ?";
    $statement = $this->conexion->prepare($query);

    // Verificar si la preparación de la consulta fue exitosa
    if (!$statement) {
        die("Error al preparar la consulta para verificar si el usuario dio like: " . $this->conexion->error);
    }

    // Bind parameters
    $statement->bind_param("ii", $id_post, $id_usuario);

    // Ejecutar la consulta
    $statement->execute();

    // Obtener el resultado de la consulta
    $result = $statement->get_result();

    // Verificar si la consulta fue exitosa
    if (!$result) {
        die("Error al ejecutar la consulta para verificar si el usuario dio like: " . $this->conexion->error);
    }

    // Obtener el número de filas afectadas
    $row = $result->fetch_assoc();
    $count = $row['count'];

    // Cerrar la declaración
    $statement->close();

    // Retornar true si el usuario ya dio like, false en caso contrario
    return ($count > 0);
}

//se encarga del borrado de todos los posts cuya id coincida con $IDPost
public function borrarLikesPorId($idPost) {
    // Establecer la conexión a la base de datos
    $this->conexion = Aplicacion::getInstance()->getConexionBd();

    // Eliminar todos los likes asociados al post
    $queryDeleteLikes = "DELETE FROM likes WHERE id_post = ?";
    $statementDeleteLikes = $this->conexion->prepare($queryDeleteLikes);

    // Verificar si la preparación de la consulta fue exitosa
    if (!$statementDeleteLikes) {
        throw new Exception("Error al preparar la consulta para eliminar likes: " . $this->conexion->error);
    }

    // Bind parameter
    $statementDeleteLikes->bind_param("i", $idPost);

    // Ejecutar la consulta
    $statementDeleteLikes->execute();

    // Verificar si se eliminaron los likes correctamente
    if ($statementDeleteLikes->affected_rows < 0) {
        throw new Exception("Error al eliminar likes asociados al post: " . $this->conexion->error);
    }

    // Cerrar la conexión

}
public function buscarIdsSeguidos($id_usuario)
{
    // Establecer la conexión a la base de datos
    $this->conexion = Aplicacion::getInstance()->getConexionBd();

    // Array para almacenar los ids de las personas seguidas
    $ids_seguidos = array();

    // Preparar la consulta SQL para obtener los ids de las personas seguidas
    $query = "SELECT follows FROM followers WHERE user = ?";
    $statement = $this->conexion->prepare($query);

    // Verificar si la preparación de la consulta fue exitosa
    if (!$statement) {
        die("Error al preparar la consulta para obtener los usuarios seguidos: " . $this->conexion->error);
    }

    // Bind parameter
    $statement->bind_param("i", $id_usuario);

    // Ejecutar la consulta
    $statement->execute();

    // Obtener el resultado de la consulta
    $result = $statement->get_result();

    // Verificar si la consulta fue exitosa
    if (!$result) {
        die("Error al ejecutar la consulta para obtener los usuarios seguidos: " . $this->conexion->error);
    }

    // Obtener los ids de las personas seguidas y almacenarlos en el array
    while ($row = $result->fetch_assoc()) {
        $ids_seguidos[] = $row['follows'];
    }

    // Cerrar la declaración
    $statement->close();

    // Retornar el array de ids de las personas seguidas
    return $ids_seguidos;
}

public function buscarUsernamesSeguidos($ids) {
    // Establecer la conexión a la base de datos
    $this->conexion = Aplicacion::getInstance()->getConexionBd();

    // Construir la parte IN de la consulta SQL
    $placeholders = implode(',', array_fill(0, count($ids), '?'));

    // Preparar la consulta SQL
    $query = "SELECT username FROM users WHERE id IN ($placeholders)";
    $statement = $this->conexion->prepare($query);

    // Verificar si la preparación de la consulta fue exitosa
    if (!$statement) {
        die("Error al preparar la consulta: " . $this->conexion->error);
    }

    // Bind parameters
    $types = str_repeat('i', count($ids)); // 'i' para integer
    $statement->bind_param($types, ...$ids);

    // Ejecutar la consulta
    $statement->execute();

    // Obtener el resultado de la consulta
    $result = $statement->get_result();

    // Crear un array para almacenar los usernames de los usuarios encontrados
    $usernames = array();

    // Obtener los resultados y almacenar los usernames en el array
    while ($row = $result->fetch_assoc()) {
        $usernames[] = $row['username'];
    }

    // Cerrar la declaración
    $statement->close();

    // Retornar el array con los usernames de los usuarios
    return $usernames;
}


public function postsSeguidos($usernames) {
    // Establecer la conexión a la base de datos
    $this->conexion = Aplicacion::getInstance()->getConexionBd();

    // Construir la parte IN de la consulta SQL para los usernames
    $placeholders = implode(',', array_fill(0, count($usernames), '?'));

    // Preparar la consulta SQL
    $query = "SELECT * FROM post WHERE usuario IN (SELECT id FROM users WHERE username IN ($placeholders))";
    $statement = $this->conexion->prepare($query);

    // Verificar si la preparación de la consulta fue exitosa
    if (!$statement) {
        die("Error al preparar la consulta: " . $this->conexion->error);
    }

    // Bind parameters
    $types = str_repeat('s', count($usernames)); // 's' para string
    $statement->bind_param($types, ...$usernames);

    // Ejecutar la consulta
    $statement->execute();

    // Obtener el resultado de la consulta
    $result = $statement->get_result();

    // Crear un array para almacenar los posts encontrados
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

    // Retornar el array con los posts de los usuarios
    return $posts;
}


}
