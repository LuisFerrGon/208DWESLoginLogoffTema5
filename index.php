<?php
    /**
     * @author Luis Ferreras González
     * @version 2024/12/04
     */

    //Se cambia si se hace un cambio en la aplicación
    $fechaUltimaRevision= strtotime("04 December 2024");

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
    $idioma=isset($_COOKIE['idioma']) ? $_COOKIE['idioma'] : 'en';
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
        </header>
        <main>
            <div id="idiomas">
                <a href="?idioma=es" <?php if($idioma=="es"){echo "id='idiomaEscogido'";}?>>Español</a>
                <a href="?idioma=en" <?php if($idioma=="en"){echo "id='idiomaEscogido'";}?>>Inglés</a>
                <a href="?idioma=pt" <?php if($idioma=="pt"){echo "id='idiomaEscogido'";}?>>Portugués</a>
                <button type="button"><a href="codigoPHP/login.php">Iniciar sesión</a></button>
            </div>
            <img src="webroot/images/mapaSimpleRecorte.PNG" alt="Mapa de la aplicación" id="mapaAplicacion"/>
        </main>
        <footer>
            <a href="../index.html">Luis Ferreras</a>
            <a href="../208DWESProyectoDWES/indexProyectoDWES.php">DWES</a>
            <a href="https://github.com/LuisFerrGon/208DWESLoginLogoffTema5" target="_blank">GitHub</a>
            <p>Última revisión: <?php echo(date('d/m/Y', $fechaUltimaRevision))?></p>
        </footer>
    </body>
</html>