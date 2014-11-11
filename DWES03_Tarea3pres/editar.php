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
        <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
        <title>DWES03_Tarea3pres</title>
        <link href="estilos.css" rel="stylesheet" type="text/css">
    </head>

    <body>

        <div id="encabezado">
            <h1>Tarea: Edicion de un producto</h1>
        </div>

        <?php
        if (!empty($_POST['codigo'])) {
            $codigo = $_POST['codigo'];
            
            try {
                $dwes = new PDO('mysql:host=localhost;dbname=dwes', 'dwes', 'abc123.');
                $dwes->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                $error = $e->getCode();
                $mensaje = $e->getMessage();
            }

            if (!isset($error)) {
                $producto = $dwes->query("Select * from producto where cod = '" . $codigo."'");
                $producto = $producto->fetch();
            }
        }
        ?>

        <form id="form_seleccion" action="actualizar.php" method="post">
            <div id="contenido">
                <h2>Producto: </h2>
                <div class="producto">
                    Nombre Corto: <input type="text" id="nombreCorto" name="nombreCorto" value="<?php echo $producto['nombre_corto'] ?>">
                </div>
                <div class="producto">
                    Nombre:<br>
                    <textarea id="nombre" name="nombre" cols="38" rows="5" ><?php echo $producto['nombre_corto'] ?>></textarea>
                </div>
                <div class="producto">
                    Descripcion:<br>
                    <textarea id="descripcion" name="descripcion" cols="38" rows="5"><?php echo $producto['descripcion'] ?></textarea>
                </div>
                <div class="producto">
                    PVP: <input type="text" id="pvp" name="pvp" value="<?php echo $producto['PVP'] ?>">
                </div>
                <div>
                    <input type="submit" id="actualizar" name="actualizar" value="Actualizar">
                    <input type="button" id="cancelar" name="cancelar" value="Cancelar" onclick="window.location.replace('listado.php')">
                    <input type="hidden" id="codigo" name="codigo" value="<?php echo $codigo ?>">

                </div>
            </div>
        </form>
        <div id="pie">
        </div>
    </body>
</html>
