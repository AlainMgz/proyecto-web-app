<?php
require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/session_start.php';
require_once __DIR__ . '/../includes/DTOs/UsuarioDTO.php';
require_once __DIR__ . '/../includes/SAs/UsuarioSA.php';
require_once __DIR__ . '/Formulario.php';

$tituloPagina = 'Registro';

// Definir una nueva clase que extienda Formulario
class FormularioRegistro extends Formulario
{
        public function __construct()
    {
        parent::__construct('formRegistro', ['urlRedireccion' => '../estrenos.php']);
    }
    // Método para generar los campos del formulario
    protected function generaCamposFormulario(&$datos)
    {
        if (isset($_SESSION["login"]) && $_SESSION["login"] == true) {
            $contenidoPrincipal = <<<EOS
            <div class="login-content">
                <div class="title_container">
                    <p>You are already logged in!</p>
                    <p>Welcome {$_SESSION['username']}!</p>
                </div>
            </div>
            EOS;
        } else {
            $contenidoPrincipal = <<<EOS
            <div class="login-content">
                <div class="login-container">
                    <h2>Create account</h2>
                    <form action="includes/Procesamiento/procesarRegistro.php" method="post">
                        <label for="username">Username:</label>
                        <input type="text" id="username" name="username" required>
        
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" required>
        
                        <label for="password">Password:</label>
                        <input type="password" id="password" name="password" required>
        
                        <button type="submit">Submit</button>
                    </form>
        
                    <div class="create-account-link">
                        <p>If you already have an account, <a href="login.php">login</a>.</p>
                    </div>
                </div>
            </div>
            EOS;
    }
    return $contenidoPrincipal;
}
    
    

    // Método para procesar los datos del formulario
    protected function procesaFormulario(&$datos)
    {
        $this->errores = [];

        $username = trim($datos['username'] ?? ''); // Corregido el índice
        if (empty($username)) {
            $this->errores[] = 'El nombre del usuario no puede estar vacío'; // Añadido al array sin clave específica
        }
    
        $password = trim($datos['password'] ?? ''); // Corregido el índice
        if (empty($password)) {
            $this->errores[] = 'La contraseña no puede estar vacía'; // Añadido al array sin clave específica
        }

        $email = trim($datos['email'] ?? ''); // Corregido el índice
        if (empty($password)) {
            $this->errores[] = 'El email no puede estar vacio'; // Añadido al array sin clave específica
        }
    
        if (count($this->errores) === 0) {
            $usuarioSA = new UsuarioSA();
           if($usuarioSA->buscaUsuario($username)){
            $this->errores[] = "El usuario ya existe"; // Corregido el mensaje de error
           }
           else{
          $usuarioSA->crea($username, $password, $email, 0);
          header("Location: estrenos.php"); // Redirige al usuario después del inicio de sesión exitoso
                exit(); // Detiene la ejecución del script después de la redirección
        }
        }
    }

    // Método para mostrar el formulario
    public function mostrarFormulario()
    {
        echo $this->generaFormulario();
    }
}