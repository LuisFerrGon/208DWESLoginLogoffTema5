<?php
    /**
     * @author Luis Ferreras González
     * @version 2024/11/27
     */

    //Se inicia o reanuda la sesión
    session_start();

    //
    

    //Incluimos la libreria de validacion de formularios
    require_once('../core/231018libreriaValidacion.php');
    require_once('../core/validacionUsuarioContrasena.php');

    //Definición de constantes que utilizaremos en prácticamente todos los métodos de la librería
    define('OBLIGATORIO', 1);
    define('OPCIONAL', 0);
    //Definición de constantes para comprobarAlfabético
    define('T_MAX_ALFABETICO', 8);
    define('T_MIN_ALFABETICO', 4);
    //Definición de constantes para validarPassword
    define('MAX_PASS', 8);
    define('MIN_PASS', 4);
    define('DEBIL', 1); //La contraseña admite solo letras
    define('NORMAL', 2); //La contraseña admite numeros y letras
    define('FUERTE', 3); //La contraseña admite si contiene al menos una letra mayúscula y un número
    //Inicialización de las variables
    $entradaOK = true; //Variable que nos indica que todo va bien
    //Array donde recogemos los mensajes de error
    $aErrores = [
        'codigoUsuario' => '',
        'contrasenaUsuario' => ''
    ];

    //Array donde recogeremos las respuestas correctas (si $entradaOK)
    $aRespuestas = [
        'codigoUsuario' => '',
        'contrasenaUsuario' => ''
    ];

    // Verifica si el formulario ha sido enviado
    if (isset($_REQUEST['login'])) {
        //Para cada campo del formulario: Validar entrada y actuar en consecuencia
        $aErrores['codigoUsuario'] = validacionFormularios::comprobarAlfabetico($_REQUEST['codigoUsuario'], T_MAX_ALFABETICO, T_MIN_ALFABETICO, OBLIGATORIO);

        $aErrores['contrasenaUsuario'] = validacionFormularios::validarPassword($_REQUEST['contrasenaUsuario'], MAX_PASS, MIN_PASS, DEBIL, OBLIGATORIO);
        if ($aErrores['codigoUsuario'] == null && $aErrores['contrasenaUsuario'] == null) {
            $entradaOK = verificarUsuarioContrasena($_REQUEST['codigoUsuario'], $_REQUEST['contrasenaUsuario']);
        }
        //Recorremos el array de errores
        foreach ($aErrores as $valor) {
            if ($valor != null) {
                $entradaOK = false;
            }
        }
    } else {
        //El formulario no se ha rellenado nunca
        $entradaOK = false;
    }

    //Tratamiento del formulario
    if ($entradaOK) {
        //Almacenamos el valor en el array
        $aRespuestas = [
            'codigoUsuario' => $_REQUEST['codigoUsuario'],
            'contrasenaUsuario' => $_REQUEST['contrasenaUsuario']
        ];
        $_SERVER['PHP_AUTH_USER'] = $aRespuestas['codigoUsuario'];
        $_SERVER['PHP_AUTH_PW'] = $aRespuestas['contrasenaUsuario'];
        echo "<script>window.open('programa.php', '_self')</script>";
    } else {
        //Mostrar el formulario hasta que lo rellenemos correctamente
?>
    <!DOCTYPE html>
    <!--Autor: Luis Ferreras González
        27/11-->
    <html lang="es">
        <head>
            <meta charset="UTF-8">
            <title>Index</title>
            <link type="text/css" rel="stylesheet" href="../webroot/estilos.css">
        </head>
        <body>
            <header>
                <h1>Desarrollo Web en Entorno Servidor</h1>
                <button type="button"><a href="../index.php">Volver</a></button>
            </header>
            <main>
                <h2>Log in</h2>

                <form name="plantilla" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" novalidate>
                    <!-- Campo de texto alfabetico obligatorio -->
                    <div class="form-group">
                        <label for="codigoUsuario">Usuario:</label>
                        <input type="text" id="codigoUsuario" name="codigoUsuario" maxlength="<?php echo (T_MAX_ALFABETICO); ?>" minlength="<?php echo (T_MIN_ALFABETICO); ?>" style="background-color: lightyellow" required>
                    </div>
                    <!-- Campo de contraseña obligatorio -->
                    <div class="form-group">
                        <label for="contrasenaUsuario">Contraseña:</label>
                        <input type="password" id="contrasenaUsuario" name="contrasenaUsuario" maxlength="<?php echo (MAX_PASS); ?>" minlength="<?php echo (MIN_PASS); ?>" style="background-color: lightyellow" required>
                    </div>   
                    <!-- Botón de envío -->
                    <div class="form-group">
                        <input id="login" name="login" type="submit" value="Iniciar sesión">
                    </div>
                </form>        </main>
            <footer>
                <footer>
                    <a href="../../index.html">Luis Ferreras</a>
                    <a href="../../208DWESProyectoDWES/indexProyectoDWES.php">DWES</a>
                    <a href="https://github.com/LuisFerrGon/208DWESLoginLogoffTema5">GitHub</a>
                </footer>
        </body>
    </html>
<?php
    }
?>