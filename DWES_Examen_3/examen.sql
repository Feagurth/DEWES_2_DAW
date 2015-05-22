-- Creamos la base de datos
CREATE DATABASE IF NOT EXISTS `examenDWES` DEFAULT CHARACTER SET utf8;
USE `examenDWES`;

-- Creamos las tabla
CREATE TABLE IF NOT EXISTS `examenDWES`.`usuariosapp` (
`id` mediumint( 9 ) NOT NULL AUTO_INCREMENT ,
`usuario` varchar( 25 )  NOT NULL ,
`password` varchar( 50 )NOT NULL ,
`nombre` varchar( 50 ) NOT NULL ,
`ap1` varchar( 50 )  NOT NULL ,
`ap2` varchar( 50 )  NOT NULL ,
`tfno` varchar( 8 )  ,
PRIMARY KEY ( `id` ) ,
UNIQUE KEY `id` ( `id` , `usuario` )
) ENGINE = InnoDB DEFAULT CHARSET = utf8 COLLATE = utf8_unicode_ci;

-- Creamos el usuario y le asignamos privilegios

GRANT SELECT,INSERT,UPDATE,DELETE
ON `examenDWES`.* TO `usuadmin`@`localhost` IDENTIFIED BY 'administrador';

GRANT SELECT,INSERT,UPDATE,DELETE
ON `examenDWES`.* TO `usuadmin`@`%` IDENTIFIED BY 'administrador';

-- Insertamos un usuario

INSERT INTO `examenDWES`.`usuariosapp` (usuario, password, nombre, ap1, ap2) VALUES ('usuexam',md5('pwdexam'),'UsuarioExam','Mayo','2015');
INSERT INTO `examenDWES`.`usuariosapp` (usuario, password, nombre, ap1, ap2) VALUES ('us1',md5('1'),'u1','Mayo','2015');
INSERT INTO `examenDWES`.`usuariosapp` (usuario, password, nombre, ap1, ap2) VALUES ('us2',md5('2'),'u2','Mayo','2015');
INSERT INTO `examenDWES`.`usuariosapp` (usuario, password, nombre, ap1, ap2) VALUES ('us3',md5('3'),'u3','Mayo','2015');