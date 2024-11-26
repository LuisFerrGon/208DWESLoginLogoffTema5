/**
 * Author:  Luis Ferreras
 * Created: 19 nov 2024
 */
CREATE DATABASE IF NOT EXISTS DB208DWESLoginLogoff;
USE DB208DWESProyectoTema5;
CREATE USER IF NOT EXISTS 'user208DWESLoginLogoff'@'%' IDENTIFIED BY 'paso';
GRANT ALL PRIVILEGES ON DB208DWESLoginLogoff.* TO 'user208DWESLoginLogoff'@'%';
CREATE TABLE IF NOT EXISTS DB208DWESLoginLogoff.T01_Usuario(
    T01_CodUsuario CHAR(8) PRIMARY KEY,
    T01_Password VARCHAR(64),
    T01_DescUsuario VARCHAR(255),
    T01_NumConexiones INT DEFAULT 0,
    T01_FechaHoraUltimaConexion DATETIME,
    T01_Perfil ENUM('usuario', 'administrador') DEFAULT 'usuario',
    T01_ImagenUsuario BLOB
);
CREATE TABLE IF NOT EXISTS DB208DWESLoginLogoff.T02_Departamento(
    T02_CodDepartamento char(3) PRIMARY KEY,
    T02_DescDepartamento varchar(255),
    T02_FechaCreacionDepartamento datetime DEFAULT CURRENT_TIMESTAMP(),
    T02_VolumenDeNegocio float,
    T02_FechaBajaDepartamento datetime DEFAULT NULL
);