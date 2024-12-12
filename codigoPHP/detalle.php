<?php
    /**
     * @author Luis Ferreras González
     * @version 2024/12/12
     */

    //Se cambia si se hace un cambio en la aplicación
    $fechaUltimaRevision= strtotime("12 December 2024");
    
    //Se inicia o reanuda la sesión
    session_start();

    $idioma=isset($_COOKIE['idioma']) ? $_COOKIE['idioma'] : 'en';
    //Si no se inició sesión anteriormente
    if(!isset($_SESSION['usuarioDAW208LoginLogoffTema5'])){
        header("Location: login.php");
        exit();
    }

    // Redirige a la página de programa
    if (isset($_REQUEST['programa'])) {
        header("Location: programa.php");
        exit();
    }
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
            <h1>Detalle</h1>
        </header>
        <main>
            <div id="idiomas">
                <a href="?idioma=es" <?php if($idioma=="es"){echo "id='idiomaEscogido'";}?>>Español</a>
                <a href="?idioma=en" <?php if($idioma=="en"){echo "id='idiomaEscogido'";}?>>Inglés</a>
                <a href="?idioma=pt" <?php if($idioma=="pt"){echo "id='idiomaEscogido'";}?>>Portugués</a>
                <form>
                    <input type="submit" name="programa" value="Volver">
                </form>
            </div>
            <?php
                function mostrarSuperglobal($nombre, $variable){
                    if(!empty($variable)){
                        echo "<h2>$nombre</h2>";
                        foreach($variable as $key=>$value){
                            // Verificamos si el valor es un objeto y lo convertimos a JSON
                            if (is_object($value)) {
                                $value = json_encode($value, JSON_PRETTY_PRINT);
                            }
                            print_r($key."=>".$value."<br>");
                        }
                    }else{
                        echo "<h2>La variable $nombre está vacia</h2>";
                    }
                }
                if(isset($_SESSION)){
                    mostrarSuperglobal('$_SESSION', $_SESSION);
                }else{
                    echo '<h2>La variable $_SESSION está vacia</h2>';
                }
                mostrarSuperglobal('$_COOKIE', $_COOKIE);
                mostrarSuperglobal('$_SERVER', $_SERVER);
                mostrarSuperglobal('$_REQUEST', $_REQUEST);
                mostrarSuperglobal('$_GET', $_GET);
                mostrarSuperglobal('$_POST', $_POST);
                mostrarSuperglobal('$_ENV', $_ENV);
                mostrarSuperglobal('$_FILES', $_FILES);
                phpinfo();
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