<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */
    /**
     * Funcion verificarUsuarioContrasena
     * 
     * Comprueba si existe un usuario con el código y contraseña dados en la tabla T01_Usuario
     * @author Luis Ferreras González
     * @version 2024-11-27
     * @since 2024-11-27
     * @param string $usu Codigo de usuario
     * @param string $pass Contraseña de usuario sin codificar y sin ser concatenada con el código de usuario
     * @return boolean En caso de que exista devuelve verdadero, si no, falso
     */
    function verificarUsuarioContrasena($usu, $pass){
        $existe=false;
        $pass=$usu.$pass;
        require_once 'confDBPDO.php';
        try{
            $conn = new PDO(SERVIDOR, USUARIO, CONTRASENA);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $query=$conn->prepare("SELECT (T01_CodUsuario), (T01_Password) FROM T01_Usuario WHERE T01_CodUsuario=:usuario AND T01_Password=SHA2(:contrasena, 256);");
            $query->bindParam(':usuario', $usu);
            $query->bindParam(':contrasena', $pass);
            $query->execute();
            $existe=($query->fetchObject()!=null);
        }catch(PDOException $e) {
            echo "Conexión fallida: " . $e->getMessage();
        }finally {
            unset($conn);
        }
        return $existe;
    };
?>