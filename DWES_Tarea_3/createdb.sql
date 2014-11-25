-- Creamos la base de datos
CREATE DATABASE `Gestion` DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci;

-- Cambiamos a la base de datos
USE `Gestion`;

-- Creamos la tabla de entradas
CREATE TABLE entradas(
	id_entrada INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nreg VARCHAR(10) NOT NULL, 
    tipodoc VARCHAR(15) NOT NULL,
    fentrada DATE NOT NULL,
    remit VARCHAR(150) NOT NULL,
    dest VARCHAR(150) NOT NULL,
    esc BOOLEAN NOT NULL);
        
-- Creamos la tabla de salidas
    CREATE TABLE salidas(
	id_entrada INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nreg VARCHAR(10) NOT NULL, 
    tipodoc VARCHAR(15) NOT NULL,
    fsalida DATE NOT NULL,
    remit VARCHAR(150) NOT NULL,
    dest VARCHAR(150) NOT NULL,
    esc BOOLEAN NOT NULL);
    
-- Creamos el usuario 
CREATE USER `dwes`
IDENTIFIED BY 'abc123.';

CREATE USER 'dwes'@'localhost' 
IDENTIFIED BY 'abc123.';

-- Asignamos permisos de la tabla al usuario dwes    
GRANT ALL ON `Gestion`.*
TO `dwes`;