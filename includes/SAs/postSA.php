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

    public function buscarPosts(){
        $postDAO = new postDAO();
        $posts = $postDAO->buscarPosts();
        return $posts;
    }

    
}

