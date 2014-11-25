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
        <link type="text/css" rel="stylesheet" href="estilos.css" />
        <title>Entrada de documentos</title>
    </head>
    <body>
        <?php
        // Creamos un bloque try-catch para la inicialización de la base 
        // de datos
        try {
            // Creamos una conexión a la base de datos especificando el host, 
            // la base de datos, el usuario y la contraseña
            $dwes = new PDO('mysql:host=localhost;dbname=gestion', 'dwes', 'abc123.');
            // Especificamos atributos para que en caso de error, salte una excepción
            $dwes->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            // Si se produce una excepción almacenamos el error y el 
            // mensaje asociado
            $error = $e->getCode();
            $mensajeError = $e->getMessage();
        }

        if (!isset($error)) {

            $entrada = $dwes->query('select * from entradas order by fentrada');
        }
        ?>

        <div id="nuevo_registro">
            <form id="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div>
                    <h3>Nuevo Registro</h3>
                    Nº registro: <input type="text" id="nreg" name="nreg" />
                    Tipo Doc:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" id="tipodoc" name="tipodoc" />
                    Fecha:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="date" id="fentrada" name="fentrada" />
                </div>
                <div>
                    Remitente:&nbsp;&nbsp;<input type="text" id="remit" name="remit" />
                    Destinatario: <input type="text" id="dest" name="dest" />
                    Escaneado: <input type="text" id="esc" name="esc" />
                </div>
                <div>
                    <input type="submit" value="Insertar registro" title="Insertar registro" alt="Insertar registro" />
                </div>

            </form>
        </div>
        <div id="listado">
            <table>
                <thead>
                    <tr>
                        <th>Id_Entrada</th>
                        <th>NReg</th>
                        <th>tipodoc</th>
                        <th>fentrada</th>
                        <th>remit</th>
                        <th>dest</th>
                        <th>esc</th>
                    </tr>
                </thead>
                <?php
                if (isset($entrada)) {

                    while ($apoyo = $entrada->fetch()) {
                        print "<tr>";

                        print "<td>";
                        print $apoyo['id_entrada'];
                        print "</td>";

                        print "<td>";
                        print $apoyo['nreg'];
                        print "</td>";

                        print "<td>";
                        print $apoyo['tipodoc'];
                        print "</td>";

                        print "<td>";
                        print $apoyo['fentrada'];
                        print "</td>";

                        print "<td>";
                        print $apoyo['remit'];
                        print "</td>";

                        print "<td>";
                        print $apoyo['dest'];
                        print "</td>";

                        print "<td>";
                        print $apoyo['esc'];
                        print "</td>";


                        print "</tr>";
                    }
                }
                ?>
            </table>

        </div>

    </body>
</html>
