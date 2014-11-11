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
        <link type="text/css" rel="stylesheet" href="estilos.css" />
        <title>DWES03_Tarea3pres</title>
    </head>
    <body>

        <div id="encabezado">
            <h1>Tarea: Listado de productos de una familia</h1>

            <?php
            try {
                //$dwes = new PDO('mysql:host=localhost;dbname=dwes', 'dwes', 'abc123.');
                $dwes = new PDO('mysql:host=localhost;dbname=dwes', 'root', '');
                $dwes->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                $error = $e->getCode();
                $mensaje = $e->getMessage();
            }
            if (!isset($error)) {
                $familia = $dwes->query('Select * from familia');
            }

            if (!empty($_POST['cmbFamilia'])) {
                $codFamilia = $_POST['cmbFamilia'];

                $elementos = $dwes->query("Select * from producto where familia = '" . $codFamilia . "'");
            }
            ?>


            <form id="form_seleccion" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <div>
                    Familia: 
                    <select name="cmbFamilia" id="cmbFamilia">
                        <?php
                        if (isset($familia)) {
                            while ($registro = $familia->fetch()) {
                                print '<option value="' . $registro['cod'] . '">' . $registro['nombre'] . '</option>';
                            }
                        }
                        ?>
                    </select>
                    <input type="submit" id="btnMostrarProductos" name="btnMostrarProductos" value="Mostrar Productos" />
                </div>       
            </form>

            <div id="contenido">
                <h2>Productos de la familia:</h2>
                <?php
                if (isset($elementos)) {
                    while ($registro = $elementos->fetch()) {
                        print '<div class="producto">';
                        print "Producto ".$registro['nombre_corto']." ".$registro['PVP']." euros  " ;
                        print '<input type="submit" id="editarProducto" name="editarProducto" value=" Editar " />';
                        print "</div>";
                    }
                }
                ?>

            </div>

            <div id="pie">
            </div>
    </body>
</html>
</html>
