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
        <title>Creación de base de datos</title>
    </head>
    <body>
        <?php
        if (!empty($_GET['control'])) {

            if ($_GET['control'] == "1") {
                try {
                    // Creamos una conexión con la base de datos usando el 
                    // usuario root
                    $gestion = new PDO('mysql:host=localhost;dbname=', 'root', '');
                    // Cargamos el contenido del fichero sql para crear un 
                    // usuario en una variable
                    $sql = file_get_contents('createdb.sql');
                    // Finalmente ejecutamos los comandos sql
                    $gestion->exec($sql);
                } catch (PDOException $e) {
                    $error = $e->getCode();
                    $mensajeError = $e->getMessage();
                }
            }
        }
        ?>
        <div>
            <p>Creación de base de datos</p>
            <input type="button" title="Creación de base de datos" alt="Creación de base de datos" value="Creación de base de datos" onclick="window.location.href = 'creadb.php?control=1'"/>
        </div>
        <?php
        print "<div>";
        print "<p>";
        if (isset($error)) {
            print "Código de error: " . $error . " - Mensaje: " . $mensajeError;
        } else {
            if (!empty($_GET['control'])) {
                if ($_GET['control'] == "1") {
                    print "La creación de la base de datos se ha realizado correctamente";
                }
            }
        }
        print "</p>";
        print "</div>";
        ?>
        <div>
            <br>
            <input type="button" title="Volver" alt="Volver" value="Volver" onclick="window.location.href = 'index.php'" />
        </div>

    </body>
</html>
