<?php
require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/session_start.php';
require_once __DIR__ . '/../includes/DTOs/UsuarioDTO.php';
require_once __DIR__ . '/../includes/SAs/UsuarioSA.php';
require_once __DIR__ . '/Formulario.php';

$tituloPagina = 'Editar Perfil';

class FormularioEditarPerfil 
{
    protected $campos;
    protected $errores = [];


    public function __construct()
    {
        $this->campos = ['new_username', 'new_email', 'new_password', 'new_profile_image', 'password'];  
    }

    protected static function createMensajeError($errores = [], $idError = '', $htmlElement = 'span', $atts = [])
    {
        if (! isset($errores[$idError])) {
            return '';
        }

        $att = '';
        foreach ($atts as $key => $value) {
            $att .= "$key=\"$value\" ";
        }
        $html = "<$htmlElement $att>{$errores[$idError]}</$htmlElement>";

        return $html;
    }

    protected static function generaErroresCampos($campos, $errores, $htmlElement = 'span', $atts = []) {
        $erroresCampos = [];
        foreach($campos as $campo) {
            $erroresCampos[$campo] = self::createMensajeError($errores, $campo, $htmlElement, $atts);
        }
        return $erroresCampos;
    }

    protected static function generaListaErroresGlobales($errores = array(), $classAtt = '')
    {
        $clavesErroresGlobales = array_filter(array_keys($errores), function ($elem) {
            return is_numeric($elem);
        });

        $numErrores = count($clavesErroresGlobales);
        if ($numErrores == 0) {
            return '';
        }

        $html = "<ul class=\"$classAtt\">";
        foreach ($clavesErroresGlobales as $clave) {
            $html .= "<li>$errores[$clave]</li>";
        }
        $html .= '</ul>';

        return $html;
    }

    // Método para generar los campos del formulario
    public function generaCamposFormularioPopUp($nombre)
    {

        $erroresCampos = self::generaErroresCampos($this->campos, $this->errores);

        $erroresGlobal = self::generaListaErroresGlobales($this->errores);

        $contenidoPrincipal = 
        <<<EOS
            <div class="popup-content">
                <h2>Editar Perfil</h2>
                <span class="form_errors">$erroresGlobal</span>
                <span class="form_errors">{$erroresCampos['new_username']}</span>
                <label for="new_username">Edita su nombre:</label>
                <input type="text" id="new_username" name="new_username">

                <span class="form_errors">{$erroresCampos['new_email']}</span>
                <label for="new_email">Edita su email:</label>
                <input type="email" id="new_email" name="new_email">

                <span class="form_errors">{$erroresCampos['new_password']}</span>
                <label for="new_password">Edita su contraseña:</label>
                <input type="password" id="new_password" name="new_password">

                <span class="form_errors">{$erroresCampos['new_profile_image']}</span>
                <label for="new_profile_image">Edita su imagen de perfil:</label>
                <input type="file" id="new_profile_image" name="new_profile_image" accept="image/*">

                <span class="form_errors">{$erroresCampos['password']}</span>
                <label for="password">Introduce tu contraseña para confirmar los cambios:</label>
                <input type="password" id="password" name="password" required>

                <button id="save-edit">Guarda</button>
                <button id="closeBtn" type="button">Cerrar</button>
            </div>
        EOS;
        return $contenidoPrincipal;
    }

}
