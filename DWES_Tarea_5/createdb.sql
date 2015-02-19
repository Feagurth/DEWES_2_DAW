-- Creamos la base de datos
CREATE DATABASE `Gestion2` DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci;

-- Cambiamos a la base de datos
USE `Gestion2`;

-- Creamos la tabla usuario. Definimos el tamaño de los campos a 32 pues es
-- la longitud de la respuesta que dará la función de encriptación MD5
CREATE TABLE usuario(
	id_usuario INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	user VARCHAR(32) NOT NULL,
	pass VARCHAR(32) NOT NULL, 
	nombre VARCHAR(12) NOT NULL) engine= InnoDB;

-- Insertamos un usuario encriptando sus valores con la función MD5
INSERT INTO usuario VALUES (0, md5('dwes'), md5('abc123.'), 'dwes');

-- Creamos la tabla de personas
CREATE TABLE personas(
	id_persona INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	nombre VARCHAR(32) NOT NULL,
	apellido1 VARCHAR(32) NOT NULL,
	apellido2 VARCHAR(32)) engine= InnoDB;

-- Creamos la tabla para almacenar los registros necesarios
CREATE TABLE registros(
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nreg VARCHAR(15) NOT NULL, 
	tipo_reg VARCHAR(1) NOT NULL,
    tipodoc VARCHAR(15) NOT NULL,
    fecha DATE NOT NULL,
    remit INT NOT NULL,
    dest INT NOT NULL,
	FOREIGN KEY (remit) REFERENCES personas(id_persona),
	FOREIGN KEY (dest) REFERENCES personas(id_persona)) ENGINE=InnoDB;


-- Creamos la tabla documento
CREATE TABLE documentos(
	id_documento INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	id_registro INT NOT NULL, 
	tamanyo VARCHAR(30) NOT NULL, 
    tipo VARCHAR(30) NOT NULL, 
    nombre VARCHAR(30) NOT NULL, 
	documento LONGBLOB NOT NULL, 
	FOREIGN KEY (id_registro) REFERENCES registros(id)) ENGINE = InnoDB;


-- Creamos el usuario 
CREATE USER `dwes`
IDENTIFIED BY 'abc123.';

CREATE USER 'dwes'@'localhost' 
IDENTIFIED BY 'abc123.';

-- Asignamos permisos de la tabla al usuario dwes    
GRANT ALL ON `Gestion1`.*
TO `dwes`;

-- Asignamos permisos de la tabla al usuario dwes    
GRANT ALL ON `Gestion2`.*
TO `dwes`;
