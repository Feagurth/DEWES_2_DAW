<!DOCTYPE html>
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
    </head>
    <body>
        <?php
        if (!empty($_POST['codigo'])) {
            $codigo = $_POST['codigo'];
            $nombre = $_POST['nombre'];
            $nombreCorto = $_POST['nombreCorto'];
            $descripcion = $_POST['descripcion'];
            $pvp = $_POST['pvp'];

            try {
                $dwes = new PDO('mysql:host=localhost;dbname=dwes', 'dwes', 'abc123.');
                $dwes->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                $error = $e->getCode();
                $mensaje = $e->getMessage();
            }

            if (!isset($error)) {
                $resultado = $dwes->exec("UPDATE producto set "
                        . "nombre = '" . $nombre . "', "
                        . "nombre_corto='" . $nombreCorto . "', "
                        . "descripcion='" . $descripcion . "', "
                        . "PVP='" . $pvp . "' "
                        . "WHERE cod='" . $codigo . "'");

                if (isset($resultado)) {
                    if($resultado == 1)
                    {
                        print "<div>Se han actualizado los datos</div>";                        
                    }
                    else
                    {
                        print "<div>Se ha producido un error</div>";
                    }
                    
                }
            }
        }
        ?>

        <input type="button" id="continuar" name="continuar" value="continuar" onclick="window.location.replace('listado.php')">
    </body>
</html>
