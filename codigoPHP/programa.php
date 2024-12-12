<?php
    /**
     * @author Luis Ferreras González
     * @version 2024/12/12
     */

    //Se cambia si se hace un cambio en la aplicación
    $fechaUltimaRevision= strtotime("12 December 2024");
    
    //Se inicia o reanuda la sesión
    session_start();

    //Si no se inició sesión anteriormente
    if(!isset($_SESSION['usuarioDAW208LoginLogoffTema5'])){
        header("Location: login.php");
        exit();
    }

    // Redirige a la página de detalle
    if (isset($_REQUEST['detalle'])) {
        header("Location: detalle.php");
        exit();
    }

    // Cerramos la sesión
    if (isset($_REQUEST['cerrarsesion'])) {
        session_destroy();
        header("Location: ../index.php");
        exit();
    }
    
    $idioma=isset($_COOKIE['idioma']) ? $_COOKIE['idioma'] : 'en';
    $oUsuarioActivo=$_SESSION['usuarioDAW208LoginLogoffTema5'];
        $descripcion=$oUsuarioActivo->T01_DescUsuario;
        $fecha=$oUsuarioActivo->T01_FechaHoraUltimaConexion;
        $conexiones=$oUsuarioActivo->T01_NumConexiones;
    $bienvenida=[
        'es'=>[
           0=>"¡Bienvenido ".$descripcion."! Esta es la primera vez que te conectas.",
           1=>"¡Bienvenido de nuevo ".$descripcion."! Esta es la ".($conexiones+1)."ª vez que te conectas, te conectaste por última vez el ".date('d/m/Y H:i:s', strtotime($fecha))
        ],
        'en'=>[
           0=>"Welcome ".$descripcion."! This is the first time you log in.",
           1=>"Welcome again ".$descripcion."! You have logged in ".($conexiones+1)." times, last time was ".date('m/d/Y H:i:s', strtotime($fecha))
        ],
        'pt' => [
            0 => "Bem-vindo ".$descripcion."! Esta é a primeira vez que você se conecta.",
            1 => "Bem-vindo de volta ".$descripcion."! Esta é a ".($conexiones+1)." vez que você se conecta, e você se conectou pela última vez em ".date('d/m/Y H:i:s', strtotime($fecha))
        ]
    ];
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Luis Ferreras</title>
        <link rel="stylesheet" type="text/css" href="../webroot/estilos.css">
    </head>
    <body>
        <header>
            <h1>Programa</h1>
        </header>
        <main>
            <div id="idiomas">
                <a href="?idioma=es" <?php if($idioma=="es"){echo "id='idiomaEscogido'";}?>>Español</a>
                <a href="?idioma=en" <?php if($idioma=="en"){echo "id='idiomaEscogido'";}?>>Inglés</a>
                <a href="?idioma=pt" <?php if($idioma=="pt"){echo "id='idiomaEscogido'";}?>>Portugués</a>
                <form>
                    <input type="submit" name="cerrarsesion" value="Cerrar Sesión">
                </form>
                <form>
                    <input type="submit" name="detalle" value="Detalle">
                </form>
            </div>
            <?php
                echo "<p>".$bienvenida[$idioma][$conexiones!=0]."</p>";
            ?>
            <div style='height: 30px'></div>
        </main>
        <footer>
            <a href="../../index.html">Luis Ferreras</a>
            <a href="../../208DWESProyectoDWES/indexProyectoDWES.php">DWES</a>
            <a href="https://github.com/LuisFerrGon/208DWESLoginLogoffTema5" target="_blank">GitHub</a>
            <p>Última revisión: <?php echo(date('d/m/Y', $fechaUltimaRevision))?></p>
        </footer>
    </body>
</html>