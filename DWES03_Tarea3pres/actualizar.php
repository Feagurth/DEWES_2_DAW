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
        <meta charset="UTF-8">
        <title>DWES03_Tarea3pres</title>
        <link type="text/css" rel="stylesheet" href="estilos.css">
    </head>
    <body>
        <?php
        // Comprobamos si en la información de GET tenemos un código de ser así
        // es el código del artículo a editar. Usamos GET en lugar de POST porque
        // hemos enviado los datos desde editar.php con header pasando los valores 
        // como parámetros en la dirección
        if (!empty($_GET['codigo'])) {

            // Almacenamos los valores enviados por la página editar.php en 
            // variables
            $codigo = $_GET['codigo'];
            $nombre = $_GET['nombre'];
            $nombre_corto = $_GET['nombre_corto'];
            $descripcion = $_GET['descripcion'];
            $pvp = $_GET['PVP'];

            // Creamos un bloque try-catch para la inicialización de la base 
            // de datos
            try {

                // Creamos una conexión a la base de datos especificando el host, 
                // la base de datos, el usuario y la contraseña
                $dwes = new PDO('mysql:host=localhost;dbname=dwes', 'dwes', 'abc123.');

                // Especificamos atributos para que en caso de error, salte una excepción
                $dwes->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {

                // Si se produce una excepción almacenamos el error y el 
                // mensaje asociado
                $error = $e->getCode();
                $mensajeError = $e->getMessage();
            }

            // Si no tenemos errores en la base de datos, procedemos a la 
            // actualización de los datos del artículo
            if (!isset($error)) {

                // Ejecutamos una actualización usando los valores enviados por 
                // la página editar.php
                $resultado = $dwes->exec("UPDATE producto set "
                        . "nombre = '" . $nombre . "', "
                        . "nombre_corto='" . $nombre_corto . "', "
                        . "descripcion='" . $descripcion . "', "
                        . "PVP='" . $pvp . "' "
                        . "WHERE cod='" . $codigo . "'");

                // Comprobamos si se ha realizado la operación correctamente
                if (isset($resultado)) {

                    // Comprobamos si se ha actualizado el artículo
                    if ($resultado == 1) {

                        // De ser todo correcto, mostramos un mensaje al usuario
                        print "<div>Se han actualizado los datos</div>";
                    } else {
                        // Si se ha producido un error, mostramos un mensaje al usuairo
                        print "<div class='error'>Se ha producido un error</div>";
                    }
                } else {
                    // Si no tenemos valores en $resultado, se ha producido un 
                    // error y mostramos un mensaje al usuario
                    print "<div class='error'>Se ha producido un error</div>";
                }
            } else {
                // Si no podemos conectar con la base de datos, mostramos 
                // un mensaje de error al usuario
                print "<div class='error'>Se ha producido un error: " . $error . ": " . $mensajeError . "</div>";
            }
        } else {
            // Si no tenemos ningún código de producto, mostramos un  mensaje 
            // al usuario
            print "<div class='error'>Se ha producido un error: No hay datos de código de producto</div>";
        }
        ?>

        <input type="button" id="continuar" name="continuar" value="Continuar" onclick="window.location.replace('listado.php')">
    </body>
</html>
