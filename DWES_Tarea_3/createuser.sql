-- Creamos el usuario 
CREATE USER `dwes`
IDENTIFIED BY 'abc123.';

CREATE USER 'dwes'@'localhost' 
IDENTIFIED BY 'abc123.';

-- Asignamos permisos de la tabla al usuario dwes    
GRANT ALL ON `Gestion`.*
TO `dwes`;