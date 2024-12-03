<?php
    /**
     * @author Luis Ferreras González
     * @version 2024/12/02
     */

    //Se inicia o reanuda la sesión
    session_start();

    //Si se inició sesión anteriormente, entra a la aplicación
    if(isset($_SESSION['usuarioDAW208LoginLogoffTema5'])){
        header("Location: programa.php");
        exit();
    }

    //Incluimos la libreria de validacion de formularios
    require_once('../core/231018libreriaValidacion.php');
    require_once('../core/confDBPDO.php');

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
        //Se valida usuario y contraseña
        $aErrores['codigoUsuario'] = validacionFormularios::comprobarAlfabetico($_REQUEST['codigoUsuario'], T_MAX_ALFABETICO, T_MIN_ALFABETICO, OBLIGATORIO);
        $aErrores['contrasenaUsuario'] = validacionFormularios::validarPassword($_REQUEST['contrasenaUsuario'], MAX_PASS, MIN_PASS, DEBIL, OBLIGATORIO);
        if ($aErrores['codigoUsuario'] == null && $aErrores['contrasenaUsuario'] == null) {
            try{
                $conn = new PDO(SERVIDOR, USUARIO, CONTRASENA);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $query=$conn->prepare("SELECT * FROM T01_Usuario WHERE T01_CodUsuario=:usuario AND T01_Password=SHA2(:contrasena, 256);");
                $codigo=$_REQUEST['codigoUsuario'];
                $pass=$codigo.$_REQUEST['contrasenaUsuario'];
                $query->bindParam(':usuario', $codigo);
                $query->bindParam(':contrasena', $pass);
                $query->execute();
                $oUsuarioActivo=$query->fetchObject();
                if($oUsuarioActivo==null){
                    $entradaOK=false;
                }else{
                    $_SESSION['usuarioDAW208LoginLogoffTema5']=$oUsuarioActivo;
                }
            }catch(PDOException $e) {
                echo "Conexión fallida: " . $e->getMessage();
                $entradaOK=false;
            }finally {
                unset($conn);
            }
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
        try{
            $conn = new PDO(SERVIDOR, USUARIO, CONTRASENA);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $update=$conn->prepare("UPDATE T01_Usuario SET T01_NumConexiones=T01_NumConexiones+1, T01_FechaHoraUltimaConexion=NOW() WHERE T01_CodUsuario=:usuario AND T01_Password=:contrasena;");
            $update->bindParam(':usuario', $oUsuarioActivo->T01_CodUsuario);
            $update->bindParam(':contrasena', $oUsuarioActivo->T01_Password);
            $update->execute();
            $_SESSION['usuarioDAW208LoginLogoffTema5']=$oUsuarioActivo;
            header("Location: programa.php");
        }catch(PDOException $e) {
            echo "Conexión fallida: " . $e->getMessage();
        }finally {
            unset($conn);
        }
    } else {
        //Mostrar el formulario hasta que lo rellenemos correctamente
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Index</title>
        <link type="text/css" rel="stylesheet" href="../webroot/estilos.css">
    </head>
    <body>
        <header>
            <h1>Desarrollo Web en Entorno Servidor</h1>
        </header>
        <main>
            <button type="button"><a href="../index.php">Volver</a></button>
            <div id="formulariologin">
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
                </form>
            </div>
        </main>
        <footer>
            <a href="../../index.html">Luis Ferreras</a>
            <a href="../../208DWESProyectoDWES/indexProyectoDWES.php">DWES</a>
            <a href="https://github.com/LuisFerrGon/208DWESLoginLogoffTema5" target="_blank">GitHub</a>
        </footer>
    </body>
</html>
<?php
    }
?>