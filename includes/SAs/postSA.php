<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../DAOs/postDAO.php';
require_once __DIR__ . '/../DTOs/postDTO.php';
require_once __DIR__ . '/../DAOs/reviewDAO.php';
class postSA
{
    public function __construct()
    {

    }

    public function crearPost($ID, $usuario, $titulo, $texto, $likes, $esComentario, $IDPadre)
    {
        $postDAO = new postDAO();
        $postDTO = new postDTO($ID, $usuario, $titulo, $texto, $likes, $esComentario, $IDPadre);
        $postDAO->creaPost($postDTO);
        return $postDTO;
    }

    public function borraPost($id_post)
    {
        $postDAO = new postDAO();
        return $postDAO->borrarPost($id_post);
    }

    public function buscarPosts()
    {
        $postDAO = new postDAO();
        $posts = $postDAO->buscarPosts();
        return $posts;
    }

    public function buscarPostsPorUsuario($usuario)
    {
        $postDAO = new postDAO();
        $posts = $postDAO->buscarPostsPorUsuario($usuario);
        return $posts;
    }

    public function agregarComentario($comentario)
    {
        $postDAO = new postDAO();
        $postDAO->agregarComentario($comentario);
        return true;
    }

    public function borrarComentario($id_comentario){
        $postDAO=new postDAO();
        return $postDAO->borrarComentario($id_comentario);
    }
    public function buscarComentarios($id_post)
    {
        $postDAO = new postDAO();
        $comentarios = $postDAO->buscarComentarios($id_post);
        return $comentarios;
    }
}
