<!DOCTYPE html>
<!--Autor: Luis Ferreras González
    26/11-->
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Luis Ferreras</title>
        <link rel="stylesheet" type="text/css" href="../webroot/estilosEjercicios.css">
    </head>
    <body>
        <header>
            <h1>Detalle</h1>
            <button type="button"><a href="programa.php">Volver</a></button>
        </header>
        <main>
            <?php
                /**
                 * @author Luis Ferreras Gonzalez
                 * @version 26/11/2024
                 */
                function mostrarSuperglobal($nombre, $variable){
                    if(!empty($variable)){
                        echo "<h2>$nombre</h2>";
                        foreach($variable as $key=>$value){
                            print_r($key."=>".$value."<br>");
                        }
                    }else{
                        echo "<h2>La variable $nombre está vacia</h2>";
                    }
                }
                if(isset($_SESSION)){
                    mostrarSuperglobal('$_SESSION', $_SESSION);
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
            <a href="https://github.com/LuisFerrGon/208DWESLoginLogoffTema5">GitHub</a>
        </footer>
    </body>
</html>