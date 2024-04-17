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
        $campos = ['username', 'password', 'email'];
        parent::__construct('formRegistro', ['urlRedireccion' => '../estrenos.php', 'campos' => $campos]);
    }
    // Método para generar los campos del formulario
    protected function generaCamposFormulario(&$datos)
    {

        $erroresCampos = self::generaErroresCampos($this->campos, $this->errores);
        $erroresGlobal = self::generaListaErroresGlobales($this->errores);

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
                        <span class="form_errors">$erroresGlobal</span>
                        <span class="form_errors">{$erroresCampos['username']}</span>
                        <label for="username">Username:</label>
                        <input type="text" id="username" name="username" required>
        
                        <span class="form_errors">{$erroresCampos['email']}</span>
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" required>
        
                        <span class="form_errors">{$erroresCampos['password']}</span>
                        <label for="password">Password:</label>
                        <input type="password" id="password" name="password" required>
        
                        <button type="submit">Submit</button>        
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

        $username = trim($datos['username'] ?? ''); 
        if (empty($username)) {
            $this->errores['username'] = 'El nombre del usuario no puede estar vacío'; 
        }
    
        $password = trim($datos['password'] ?? ''); 
        if (empty($password)) {
            $this->errores['password'] = 'La contraseña no puede estar vacía'; 
        }

        $email = trim($datos['email'] ?? ''); 
        if (empty($email)) {
            $this->errores['email'] = 'El email no puede estar vacio'; 
        }
    
        if (count($this->errores) === 0) {
            $usuarioSA = new UsuarioSA();
           if($usuarioSA->buscaUsuario($username)){
            $this->errores[] = "El usuario ya existe"; // Corregido el mensaje de error
           }
           else{
         $usuario= $usuarioSA->crea($username, $password, $email, 0);
          $_SESSION['login'] = true;
          $_SESSION['user_obj'] = serialize($usuario);
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