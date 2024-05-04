// En el archivo mostrarPosts.php
<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../session_start.php';
require_once __DIR__ . '/../SAs/postSA.php';
class mostrarPosts {
    public function __construct() {}

    public function construirPosts($posts, $usuario) {
        $contenidoPosts = '<div class="container">'; // Inicializa la variable fuera del bucle

        foreach ($posts as $post) {
            $contenidoPosts .= '
                <div class="mt-3">
                    <div class="card mb-4">
                        <div class="media px-3 pt-3">
            ';

            $usuarioSA = new UsuarioSA();
            $postSA= new postSA();
            $usuarioPost = $usuarioSA->buscaUsuario($post->getUsuario());
            $contenidoPosts .= '
                            <img src="img/' . $usuarioPost->getProfileImage() . '" alt="Avatar" class="rounded-circle mr-2" style="width: 40px; height: 40px;">
                            <div class="media-body">
                                <h5 class="mt-0">@<a href="usuario.php?nombre=' . urlencode($post->getUsuario()) . '">' . escape($post->getUsuario()) . '</a></h5>
                            </div>
                        </div>
                        <div class="card-body">
                            <h6 class="card-subtitle mb-2 text-muted">' . escape($post->getTitulo()) . '</h6>
                            <p class="card-text">' . escape($post->getTexto()) . '</p>
                            <p class="card-text">Likes: ' . escape($post->getLikes()) . '</p>
            ';

            if ($usuario === $post->getUsuario()) {
                $contenidoPosts .= '
                    <!-- Formulario para eliminar el post -->
                    <form action="" method="post">
                        <input type="hidden" name="id_post_delete" value="' . escape($post->getID()) . '">
                        <button type="submit" class="btn btn-outline-danger">
                            <i class="fas fa-trash-alt"></i> <!-- Icono de papelera -->
                        </button>
                    </form>
                ';
            }

            if ($usuario !== $post->getUsuario() && !$postSA->usuarioDioLike($post->getID(), $usuario)) {
                $contenidoPosts .= '
                    <!-- Formulario para dar like -->
                    <form action="" method="post">
                        <input type="hidden" name="id_post_like" value="' . escape($post->getID()) . '">
                        <button type="submit" class="btn btn-primary">Like</button>
                    </form>
                ';
            } elseif ($postSA->usuarioDioLike($post->getID(), $usuario)) {
                $contenidoPosts .= '<p class="text-muted">Ya has dado like a este post.</p>';
            }

            $contenidoPosts .= '
                            </div>
                            <button class="btn btn-link" onclick="toggleComments(' . escape($post->getID()) . ')">Mostrar/ocultar comentarios</button>
                            <div id="comments-' . escape($post->getID()) . '" style="display: none;">
                                <div id="comments-body-' . escape($post->getID()) . '">
                                    <form id="form-comment-' . escape($post->getID()) . '" action="" method="post">
                                        <h2>Escribe tu comentario:</h2>
                                        <div class="form-group">
                                            <textarea class="form-control" name="contenido" rows="2" placeholder="Escribe tu comentario..." required></textarea>
                                        </div>
                                        <input type="hidden" name="id_post" value="' . escape($post->getID()) . '">
                                        <button type="submit" class="btn btn-primary">Comentar</button>
                                    </form>
                                    <h3>Respuestas:</h3>
                                </div>
                                <div id="comments-list-' . escape($post->getID()) . '">
            ';

            $comments = $postSA->buscarComentarios($post->getID());
            $contenidoPosts .= '<ul class="list-group list-group-flush">';
            foreach ($comments as $comment) {
                $contenidoPosts .= '
                    <li class="list-group-item">
                        <div class="card-body">
                            <div class="media px-2 pt-3">
                                '; 
                                $usuarioSA = new UsuarioSA();
                                $usuarioComent = $usuarioSA->buscaUsuario($comment->getUsuario());
                                $contenidoPosts .= '
                                <img src="img/' . $usuarioComent->getProfileImage() . '" alt="Avatar" class="rounded-circle mr-2" style="width: 40px; height: 40px;">
                                <div class="media-body">
                                    <h5 class="mt-0">@<a href="usuario.php?nombre=' . urlencode($comment->getUsuario()) . '">' . escape($comment->getUsuario()) . '</a></h5>
                                </div>
                            </div>
                            <p class="card-text">' . escape($comment->getContenido()) . '</p>
                            <p class="card-text text-muted">' . escape($comment->getFecha()) . '</p>
                            <form action="" method="post">
                                <input type="hidden" name="id_comment_delete" value="' . escape($comment->getId()) . '">
                ';

                if ($usuario === $comment->getUsuario()) {
                    $contenidoPosts .= '
                        <button type="submit" class="btn btn-outline-danger">
                            <i class="fas fa-trash-alt"></i> <!-- Icono de papelera -->
                        </button>
                    ';
                }

                $contenidoPosts .= '
                            </form>
                        </div>
                    </li>
                ';
            }

            $contenidoPosts .= '
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        ';
    }

    $contenidoPosts .= '';

    return $contenidoPosts;
}
}
