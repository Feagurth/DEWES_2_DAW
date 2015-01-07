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
        <link rel="stylesheet" type="text/css" href=estilos.css />
        <title>Alta de cliente</title>
    </head>
    <body>
        <?php
        // Incluimos el fichero configuracion.inc.php donde se guardan el 
        // usuario y el password de la base de datos        
        include_once './configuracion.inc.php';

        // Creamos un bloque try-catch para la inicialización de la base 
        // de datos
        try {
            // Creamos una conexión a la base de datos especificando el host, 
            // la base de datos, el usuario y la contraseña
            $gestion = new PDO('mysql:host=localhost;dbname=' . $BaseDeDatos, $Usuario, $Pass);
            // Especificamos atributos para que en caso de error, salte una excepción
            $gestion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            // Si se produce una excepción almacenamos el mensaje asociado
            $mensajeError = $e->getMessage();
        }

        // Comprobamos si ha ocurrido algún error en la conexión con la base de 
        // datos. De no ser así, seguimos con la carga de datos de la página
        if (!isset($mensajeError)) {

            // Comprobamos si en la información del POST de la página hay 
            // información de algún cliente. De no ser así, es la primera 
            // carga de la página. En caso contrario, la carga es para validar 
            // e insertar un registro.
            if (empty($_POST['dni'])) {

                // Realizamos una consulta con la base de datos para traer los 
                // datos de la tabla cliente ordenador 
                $distribuye = $gestion->query('select * from cliente order by nombre desc');
            } else {

                // Si es una insercción, volcamos los valores a insertar en 
                // variables directamente desde el POST de la página
                $dni = $_POST['dni'];
                $nombre = $_POST['nombre'];
                $edad = $_POST['edad'];

                // Realizamos una insercción en la base de datos
                $resultado = $gestion->exec("insert into cliente values("
                        . "$dni, "
                        . "'$nombre', "
                        . "$edad)");


                // Realizamos una consulta con la base de datos para poder 
                // rellenar la tabla de registros
                $distribuye = $gestion->query('select * from cliente order by nombre desc');
            }
        }
        ?>
        <div id="nuevo_registro">
            <form id="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div>
                    <h3>Nuevo Registro de Cliente</h3>
                    DNI: <input type="text" id="dni" name="dni" />
                    Nombre: <input type="text" id="nombre" name="nombre"/>
                    Edad: <input type="text" id="edad" name="edad"/>
                </div>
                <div>
                    <input type="submit" value="Insertar cliente" title="Insertar cliente" alt="Insertar cliente">
                    <input type="button" value="Volver" title="Volver" alt="Volver" onclick="window.location.replace('index.php')"/>
                </div>
                <?php
                // Si tenemos un mensaje de error, lo mostramos al usuario
                if (isset($mensajeError)) {
                    print "<div class='error'>";
                    print $mensajeError;
                    print "</div>";
                }
                ?>

            </form>
        </div>    
        <div id="listado">
            <table>
                <thead>
                    <tr>
                        <th>DNI</th>
                        <th>Nombre</th>
                        <th>Edad</th>                        
                    </tr>
                </thead>
                <?php
                // Creamos un contador y lo inicializamos
                $contador = 1;

                // Comprobamos si tenemos valores por los que iterar para crear 
                // la tabla de entradas
                if (isset($distribuye)) {

                    // Iteramos por todos los registros consultados
                    while ($apoyo = $distribuye->fetch()) {

                        // Si el valor de contador es impar creamos una fila 
                        // con una clase y si es par con otra clase distinta, 
                        // para poder así colorear las filas de distinto modo 
                        // alternativamente                        
                        if ($contador % 2 == 1) {
                            print "<tr class='pijama1'>";
                        } else {
                            print "<tr class='pijama2'>";
                        }

                        // Creamos columnas para cada fila con los valores 
                        // recogidos de la base de datos
                        print "<td>";
                        print $apoyo['dni'];
                        print "</td>";

                        print "<td>";
                        print $apoyo['nombre'];
                        print "</td>";

                        print "<td>";
                        print $apoyo['edad'];
                        print "</td>";

                        print "</tr>";
                        
                        // Incrementamos el contador
                        $contador++;
                    }
                }
                ?>
            </table>

        </div>        
    </body>
</html>
