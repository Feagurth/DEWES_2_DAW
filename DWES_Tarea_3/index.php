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
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <link type="text/css" rel="stylesheet" href="estilos.css">
        <title>Página principal</title>
    </head>
    <body>
            <?php
        // Creamos un bloque try-catch para la inicialización de la base 
        // de datos
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


        // Comprobamos si se ha producido un error al conectar a la base 
        // de datos
        if (!isset($error)) {
            $boton1 = "invisible";
            $boton2 = "visible";
        } else {
            $boton1 = "visible";
            $boton2 = "invisible";
        }
        ?>

        <div id="<?php echo $boton1 ?>"
             <p>No se ha detectado una base de datos.</p>
            <input type="button" title="Pulsar para crear base de datos" alt="Pulsar para crear base de datos" value="Pulsar para crear base de datos" onclick="document.location.href = 'creadb.php'" />
        </div>

        <div id="contenedor">
            <div id="<?php echo $boton2 ?>">

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
