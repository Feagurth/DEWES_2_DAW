CREATE USER `dwes`
IDENTIFIED BY 'abc123.';

CREATE USER 'dwes'@'localhost' 
IDENTIFIED BY 'abc123.';

GRANT ALL ON `dwes`.*
TO `dwes`;