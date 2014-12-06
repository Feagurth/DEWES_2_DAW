-- Creamos la base de datos
CREATE DATABASE `Gestion` DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci;

-- Cambiamos a la base de datos
USE `Gestion`;

-- Creamos la tabla usuario. Definimos el tamaño de los campos a 32 pues es
-- la longitud de la respuesta que dará la función de encriptación MD5
CREATE TABLE usuario(
	id_usuario INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	user VARCHAR(32) NOT NULL,
	pass VARCHAR(32) NOT NULL) engine= InnoDB;

-- Insertamos un usuario encriptando sus valores con la función MD5
INSERT INTO usuario VALUES (0, md5('dwes'), md5('abc123.'));

-- Creamos la tabla documento
CREATE TABLE documentos(
	id_documento INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
        tamanyo VARCHAR(30) NOT NULL, 
        tipo VARCHAR(30) NOT NULL, 
        nombre VARCHAR(30) NOT NULL, 
	documento BLOB NOT NULL) ENGINE = InnoDB;

-- Creamos la tabla de entradas con una referencia a la tabla documentos
CREATE TABLE entradas(
    id_entrada INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nreg VARCHAR(10) NOT NULL, 
    tipodoc VARCHAR(15) NOT NULL,
    fentrada DATE NOT NULL,
    remit VARCHAR(150) NOT NULL,
    dest VARCHAR(150) NOT NULL,
    esc BOOLEAN NOT NULL, 
	id_documento INT, 
	FOREIGN KEY (id_documento) REFERENCES documentos(id_documento)) ENGINE=InnoDB;
        
-- Creamos la tabla de salidas con una referencia a la tabla documentos
CREATE TABLE salidas(
    id_salida INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nreg VARCHAR(10) NOT NULL, 
    tipodoc VARCHAR(15) NOT NULL,
    fsalida DATE NOT NULL,
    remit VARCHAR(150) NOT NULL,
    dest VARCHAR(150) NOT NULL,
    esc BOOLEAN NOT NULL, 
	id_documento INT, 
	FOREIGN KEY (id_documento) REFERENCES documentos(id_documento)) ENGINE=InnoDB;


-- Creamos el usuario 
CREATE USER `dwes`
IDENTIFIED BY 'abc123.';

CREATE USER 'dwes'@'localhost' 
IDENTIFIED BY 'abc123.';

-- Asignamos permisos de la tabla al usuario dwes    
GRANT ALL ON `Gestion`.*
TO `dwes`;
