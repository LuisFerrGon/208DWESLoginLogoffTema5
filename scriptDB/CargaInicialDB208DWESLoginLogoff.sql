/**
 * Author:  Luis Ferreras
 * Created: 19 nov 2024
 */
INSERT INTO DB208DWESLoginLogoffTema5.T01_Usuario
    (T01_CodUsuario, T01_Password, T01_DescUsuario, T01_Perfil)
VALUES
    ('admin', SHA2('adminpaso',256), 'administrador', 'administrador')
;
INSERT INTO DB208DWESLoginLogoffTema5.T01_Usuario
    (T01_CodUsuario, T01_Password, T01_DescUsuario)
VALUES
    ('victor', SHA2('victorpaso',256), 'Víctor García Gordón'),
    ('alex', SHA2('alexpaso',256), 'Alex Asensio Sánchez'),
    ('luis', SHA2('luispaso', 256), 'Luis Ferreras González'),
    ('jesus', SHA2('jesuspaso',256), 'Jesus Ferreras González'),
    ('heraclio', SHA2('heracliopaso',256), 'Heraclio Borbujo Moran'),
    ('amor', SHA2('amorpaso',256), 'Amor Rodriguez Navarro')
;
INSERT INTO DB208DWESLoginLogoffTema5.T02_Departamento
    (T02_CodDepartamento, T02_DescDepartamento, T02_VolumenDeNegocio)
VALUES
    ('CMP', 'Compra', 1000),
    ('VNT', 'Venta', 500.50),
    ('MKT', 'Marketing', 40.02)
;