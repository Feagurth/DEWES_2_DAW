<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<!--
Copyright (C) 2014 Luis Cabrerizo Gómez

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.
-->
<?php
// Iniciamos sesión
session_start();

// Si el usuario aún no se ha autentificado, pedimos las credenciales
if (!isset($_SERVER['PHP_AUTH_USER'])) {
    header('WWW-Authenticate: Basic realm="Contenido restringido"');
    header("HTTP/1.0 401 Unauthorized");
    exit;
} else {

    // Declaramos una variable y la inizializamos a 0. Esta variable nos servirá 
    // para controlar si el usuario está correctamente dado de alta en la base 
    // de datos o si no lo está
    $control = 0;

    try {

        // Creamos una conexión a la base de datos especificando el host, 
        // la base de datos, el usuario y la contraseña
        $gestion = new PDO('mysql:host=localhost;dbname=gestion', 'root', '');

        // Especificamos atributos para que en caso de error, salte una excepción
        $gestion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {

        // Si se produce una excepción almacenamos el error y el 
        // mensaje asociado
        $error = $e->getCode();
        $mensajeError = $e->getMessage();
    }
    if (!isset($mensajeError)) {

        // Realizamos una consulta a la base de datos buscando registros en la 
        // tabla de usuarios cuyo usuario y contraseña sean los mismos que los 
        // introducidos por el usuario
        $consulta = $gestion->query("select user from usuario where user=md5('${_SERVER['PHP_AUTH_USER']}') and pass=md5('${_SERVER['PHP_AUTH_PW']}')");

        // Recuperamos todos los resultados forzando a traer un solo valor 
        // por registro
        $usuario = $consulta->fetchAll(PDO::FETCH_ASSOC);

        // Contamos el número de registros que contiene el array de datos traido 
        // de la base de datos
        if (count($usuario) == 1) {
            // Si tenemos datos, modificamos el valor de la variable de control
            $control = 1;

            // Guardamos el hash del usuario y del password en sesión
            $_SESSION['user'] = md5($_SERVER['PHP_AUTH_USER']);
            $_SESSION['pass'] = md5($_SERVER['PHP_AUTH_PW']);
        } else {
            // Si no tenemos resultados, limpiamos los valores de sesión
            session_unset();
        }
    }
}
?>


<html>
    <head>
        <meta http-equiv = "Content-Type" content = "text/html; charset=utf-8"/>
        <link type = "text/css" rel = "stylesheet" href = "estilos.css"/>                
        <title>Página principal</title>
    </head>
    <body>
        <div id="contenedor">
            <?php
            if (isset($mensajeError)) {
                print "<div class='error'>";
                echo $mensajeError;
                print "</div>";
            }
            ?>
            <div class="<?php
            if ($control == 0) {
                echo "invisible";
            } else {
                echo "visible";
            }
            ?>">

                <a class="imagen" href="entradas.php">
                    <img src="images/in.png" alt="Acceso a la página de documentos entrantes" title="Acceso a la página de documentos entrantes" />

                </a>   

                <a class="imagen" href="salidas.php">
                    <img src="images/out.png" alt="Acceso a la página de documentos salientes" title="Acceso a la página de documentos salientes" />
                </a>            

            </div>
        </div>
    </body>
</html>
