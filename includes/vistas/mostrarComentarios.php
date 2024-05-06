<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../session_start.php';
require_once __DIR__ . '/../SAs/postSA.php';

class mostrarComentarios {
    public function __construct() {}

    public function construirComentarios($postId, $usuario) {
        $postSA = new postSA();
        $comments = $postSA->buscarComentarios($postId);

        $contenidoComments = '';

        foreach ($comments as $comment) {
            $usuarioSA = new UsuarioSA();
            $usuarioComent = $usuarioSA->buscaUsuario($comment->getUsuario());

            $contenidoComments .= '
                <li class="list-group-item">
                    <div class="card-body">
                        <div class="media px-2 pt-3">
                            <img src="img/' . $usuarioComent->getProfileImage() . '" alt="Avatar" class="rounded-circle mr-2" style="width: 40px; height: 40px;">
                            <div class="media-body">
                                <h5 class="mt-0">@<a href="usuario.php?nombre=' . urlencode($comment->getUsuario()) . '">' . escape($comment->getUsuario()) . '</a></h5>
                            </div>
                        </div>';
                        $texto_post = $comment->getContenido();

                        $texto_post_con_enlaces = preg_replace('/@(\w[\w.-]*)/', '<a href="usuario.php?nombre=$1">@$1</a>', $texto_post);
                        $texto_post_con_enlaces = preg_replace('/#(\w[\w.-]*)/', '<a href="infoPeliculas.php?nombre=$1">#$1</a>', $texto_post_con_enlaces);

                        $contenidoComments .= '
                        <p class="card-text">' . $texto_post_con_enlaces . '</p>
                        <p class="card-text text-muted">' . escape($comment->getFecha()) . '</p>
                        <form action="" method="post">
                            <input type="hidden" name="id_comment_delete" value="' . escape($comment->getId()) . '">
            ';

            if ($usuario === $comment->getUsuario()) {
                $contenidoComments .= '
                    <button type="submit" class="btn btn-outline-danger">
                        <i class="fas fa-trash-alt"></i> <!-- Icono de papelera -->
                    </button>
                ';
            }

            $contenidoComments .= '
                        </form>
                    </div>
                </li>
            ';
        }

        return $contenidoComments;
    }
}

