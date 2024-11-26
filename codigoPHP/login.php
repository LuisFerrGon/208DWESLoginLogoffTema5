<!DOCTYPE html>
<!--Autor: Luis Ferreras González
    26/11-->
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
            <?php
                /**
                 * @author Luis Ferreras González
                 * @version Fecha de última modificación 26/11/2024
                 */

                //Incluimos la libreria de validacion de formularios
                require_once('../core/231018libreriaValidacion.php');
                
                //Definición de constantes que utilizaremos en prácticamente todos los métodos de la librería
                define('OBLIGATORIO', 1);
                define('OPCIONAL', 0);
                //Definición de constantes para comprobarAlfabético
                define('T_MAX_ALFABETICO',8);
                define('T_MIN_ALFABETICO',4);
                //Definición de constantes para validarPassword
                define('MAX_PASS',8);
                define('MIN_PASS',4);
                define('DEBIL',1);//La contraseña admite solo letras
                define('NORMAL',2);//La contraseña admite numeros y letras
                define('FUERTE',3);//La contraseña admite si contiene al menos una letra mayúscula y un número


                //Inicialización de las variables
                $entradaOK = true; //Variable que nos indica que todo va bien
                
                //Array donde recogemos los mensajes de error
                $aErrores = [
                    'alfabeticoObligatorio' => '',
                    'passwordObligatorio' => ''
                ]; 
                
                //Array donde recogeremos las respuestas correctas (si $entradaOK)
                $aRespuestas = [
                    'alfabeticoObligatorio' => '',
                    'passwordObligatorio' => ''
                ];

                // Verifica si el formulario ha sido enviado
                if (isset($_REQUEST['enviar'])) {
                        //Para cada campo del formulario: Validar entrada y actuar en consecuencia
                        $aErrores['alfabeticoObligatorio'] = validacionFormularios::comprobarAlfabetico($_REQUEST['alfabeticoObligatorio'], T_MAX_ALFABETICO, T_MIN_ALFABETICO, OBLIGATORIO);
                        
                        $aErrores['passwordObligatorio'] = validacionFormularios::validarPassword($_REQUEST['passwordObligatorio'], MAX_PASS, MIN_PASS, DEBIL, OBLIGATORIO);
                        
                        
                        //Recorremos el array de errores
                        foreach ($aErrores as $clave => $valor) {
                            $entradaOK = false;
                            //Limpiamos el campo si hay un error
                            $_REQUEST[$clave] = '';
                        }
                } else {
                        //El formulario no se ha rellenado nunca
                        $entradaOK = false;
                }

                //Tratamiento del formulario
                if ($entradaOK) {
                        //Almacenamos el valor en el array
                        $aRespuestas = [
                            'alfabeticoObligatorio' =>  $_REQUEST['alfabeticoObligatorio'],
                            'passwordObligatorio' => $_REQUEST['passwordObligatorio']
                        ];

                        //Mostramos las respuestas por pantalla
                        echo '<div class="respuestas-container">';
                        echo '<h2 class="respuestas-header">Respuestas:</h2>';
                        foreach ($aRespuestas as $key => $value) {
                            echo '<div class="respuesta-item">';
                            //Si es un array lo convierte a string
                            if (is_array($value)) {
                                echo "$key : " . implode(', ', $value) . "<br>";
                            } else{  
                                //Se hace una excepción para formatear la salida de los objetos de tipo fecha
                                echo ($value instanceof DateTime) ? "$key : " . $value->format('d-m-Y') . "<br>" : "$key : $value <br>";  
                            }
                            echo '</div>';
                        }
                        echo '</div>'; 
                } else {
                        //Mostrar el formulario hasta que lo rellenemos correctamente
                ?>
            <form name="plantilla" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" novalidate>
                <!-- Campo de texto alfabetico obligatorio -->
                <div class="form-group">
                    <label for="alfabeticoObligatorio">Alfabético Obligatorio:</label>
                    <input type="text" id="alfabeticoObligatorio" name="alfabeticoObligatorio" maxlength="<?php echo (T_MAX_ALFABETICO);?>" minlength="<?php echo (T_MIN_ALFABETICO);?>" style="background-color: lightyellow" required value="<?php echo (isset($_REQUEST['alfabeticoObligatorio']) ? $_REQUEST['alfabeticoObligatorio'] : ''); ?>">
                    <?php if (!empty($aErrores['alfabeticoObligatorio'])) { ?> <span style="color: red"><?php echo $aErrores['alfabeticoObligatorio']; ?></span> <?php } ?>
                </div>
                <!-- Campo de contraseña obligatorio -->
                <div class="form-group">
                    <label for="passwordObligatorio">Password Obligatorio (solo letras):</label>
                    <input type="password" id="passwordObligatorio" name="passwordObligatorio" maxlength="<?php echo (MAX_PASS);?>" minlength="<?php echo (MIN_PASS);?>" style="background-color: lightyellow" required value="<?php echo (isset($_REQUEST['passwordObligatorio']) ? $_REQUEST['passwordObligatorio'] : ''); ?>">
                    <?php if (!empty($aErrores['passwordObligatorio'])) { ?> <span style="color: red"><?php echo $aErrores['passwordObligatorio']; ?></span> <?php } ?>
                </div>   
                <!-- Botón de envío -->
                <div class="form-group">
                    <input id="enviar" name="enviar" type="submit" value="Enviar">
                </div>
            </form>
            <?php
                }
            ?>
        </main>
        <footer>
        <footer>
            <a href="../../index.html">Luis Ferreras</a>
            <a href="../../208DWESProyectoDWES/indexProyectoDWES.php">DWES</a>
            <a href="https://github.com/LuisFerrGon/208DWESLoginLogoffTema5">GitHub</a>
        </footer>
    </body>
</html>