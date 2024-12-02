<?php
    /**
     * @author Luis Ferreras González
     * @version 2024/12/02
     */

    //Se inicia o reanuda la sesión
    session_start();

    // Si la cookie está vacia se crea y se le pone un valor por defecto
    if (!isset($_COOKIE['idioma'])) {
            setcookie("idioma", "es", time() + 60, "/");
    }
    // Si el idioma enviado está vacio o es null
    if (isset($_REQUEST['idioma'])) {	
            setcookie("idioma", $_REQUEST['idioma'], time() + 60, "/");
            header('Location: ' . $_SERVER['PHP_SELF']);
            exit();
    }
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Index</title>
        <link type="text/css" rel="stylesheet" href="webroot/estilos.css">
    </head>
    <body>
        <header>
            <h1>Desarrollo Web en Entorno Servidor</h1>
            <button type="button"><a href="codigoPHP/login.php">Iniciar sesión</a></button>
            <div>
                <a class="españa" href="?idioma=es">
                    <img src="doc/españa.png" alt="es">
                </a>
                <a class="inglaterra" href="?idioma=en">
                    <img src="doc/inglaterra.png" alt="en">
                </a>
                <a class="portugal" href="?idioma=pt">
                    <img src="doc/portugal.jpg" alt="pt">
                </a>
            </div>
        </header>
        <main>
            <h2>Index</h2>
        </main>
        <footer>
            <a href="../index.html">Luis Ferreras</a>
            <a href="../208DWESProyectoDWES/indexProyectoDWES.php">DWES</a>
            <a href="https://github.com/LuisFerrGon/208DWESLoginLogoffTema5" target="_blank">GitHub</a>
        </footer>
    </body>
</html>