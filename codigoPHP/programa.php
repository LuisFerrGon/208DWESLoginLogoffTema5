<?php
    /**
     * @author Luis Ferreras González
     * @version 2024/12/02
     */

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
    $mensaje=[
        'es'=>[
           0=>"¡Bienvenido ".$descripcion."! Esta es la primera vez que te conectas.",
           1=>"¡Bienvenido de nuevo ".$descripcion."! Esta es la ".($conexiones+1)."ª vez que te conectas, te conectaste por última vez el ".date('d/m/Y H:i:s', strtotime($fecha))
        ]
    ];
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Luis Ferreras</title>
        <link rel="stylesheet" type="text/css" href="../webroot/estilosEjercicios.css">
    </head>
    <body>
        <header>
            <h1>Programa</h1>
            <form>
                <input type="submit" name="cerrarsesion" value="Cerrar Sesión">
            </form>
            <form>
                <input type="submit" name="detalle" value="Detalle">
            </form>
            <?php
                if($conexiones==0){
                    echo "<p>¡Bienvenido ".$descripcion."! Esta es la primera vez que te conectas.</p>";
                }else{
                    echo "<p>¡Bienvenido de nuevo ".$descripcion."! Esta es la ".($conexiones+1)."ª vez que te conectas, te conectaste por última vez el ".date('d/m/Y H:i:s', strtotime($fecha))."</p>";
                }
            ?>
        </header>
        <main>
            <div style='height: 30px'></div>
        </main>
        <footer>
            <a href="../../index.html">Luis Ferreras</a>
            <a href="../../208DWESProyectoDWES/indexProyectoDWES.php">DWES</a>
            <a href="https://github.com/LuisFerrGon/208DWESLoginLogoffTema5" target="_blank">GitHub</a>
        </footer>
    </body>
</html>