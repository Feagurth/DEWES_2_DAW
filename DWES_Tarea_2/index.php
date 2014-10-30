<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
            <title>DWES_Tarea_2</title>
            <link type="text/css" rel="stylesheet" href="estilos.css" />
    </head>
    <body>
        <?php
        // Creamos el array agenda donde se almacenarán el nombre y el teléfono
        // de cada uno de los registros de la agenda
        $agenda;
        $agenda = array();

        /**
         * Función para validar un nombre
         * @param type $nombre Nombre a validar
         * @return boolean True si es correcto, False si es incorrecto
         */
        function validaNombre($nombre) {
            // Validamos el nombre pasado como parámetro usando expresiones 
            // regulares
            if (preg_match("/^[a-zA-ZñÑáÁéÉíÍóÓúÚ ]+$/", $nombre)) {
                // Si es correcto, devolvemos True
                return TRUE;
            } else {
                // Si no es correcto, devolvemos False
                return FALSE;
            }
        }

        /**
         * Función que valida un número de telefono
         * @param type $telefono Numero de teléfono a validar
         * @return boolean True si el telefono es correcto, False si no es 
         * correcto
         */
        function validarTelefono($telefono) {

            // Comprobamos si el telefono no es un valor vacio
            if ($telefono != "") {

                // Si no lo es, lo validamos usando expresiones regulares
                // Situamos \b delante y detrás de la expresión regular
                // para indicar el limite del patrón de busqueda y que no 
                // devuelva como validados patrones parciales, como por ejemplo
                // números de 10 o de menos cifras que si cumplan la regla de 
                // validación de la expresión regular
                if (preg_match("/\b^[9|8|6|7][0-9]{8}\b/", $telefono)) {
                    // Devolvemos True si es válido
                    return TRUE;
                } else {
                    // Devolvemos False si no es válido
                    return FALSE;
                }
            } else {
                // Devolvemos verdadero si su valor es vacío, para permitir la 
                // eliminación de registros
                return TRUE;
            }
        }
        ?>
        <table class="contenedor">
            <tr>
                <td>
                    <table class="agenda">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Teléfono</th>                    
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            // Creamos una variable para almacenar los errores 
                            // y mostrarselos después al usuario
                            $error = "";

                            // Comprobamos si el formulario devuelva valores 
                            // para la agenda
                            if (!empty($_POST['array'])) {
                                // Si los datos de la agenda no son vacios, 
                                // deserializamos los datos y los asignamos al 
                                // a la variable $agenda
                                $agenda = unserialize($_POST['array']);
                            }

                            // Comprobamos si el formulario devuelve valores 
                            // para el nombre
                            if (!empty($_POST['nombre'])) {

                                // Si devuelve datos par el nombre, los 
                                // almacenamos así como la información que 
                                // pudiese venir para el telefono, sea esta 
                                // nula o no
                                $dato_nombre = $_POST['nombre'];
                                $dato_tlf = $_POST['tlf'];

                                // Validamos el nombre y el número de teléfono 
                                if (validaNombre($dato_nombre) && validarTelefono($dato_tlf)) {

                                    // Si el nombre y el número de telefono son 
                                    // correctos, o nulo en el caso del telefono, 
                                    // comprobamos si tenemos datos en la variable 
                                    // $agenda
                                    if (!empty($agenda)) {

                                        // Comprobamos si el nombre que trae el 
                                        // formulario no se encuentra ya en el array. 
                                        // Si no está en el array será una operación 
                                        // de insercción, en caso contrario será una 
                                        // operación de actualización o de borrado.
                                        if (!array_key_exists($dato_nombre, $agenda)) {

                                            // Verificamos si tenemos datos del teléfono
                                            if ($dato_tlf != "") {
                                                $agenda[$dato_nombre] = $dato_tlf;
                                            } else {
                                                // Si no hay teléfono, mostramos un error
                                                $error = "Debe introducir un número<br>"
                                                        . "de teléfono para insertar un<br>"
                                                        . "nuevo registro";
                                            }
                                        } else {

                                            // Comprobamos si tenemos un telefono. 
                                            // De tenerlo será una insercción, 
                                            // en caso contrario un borrado
                                            if ($dato_tlf == "") {

                                                // Como no tenemos un teléfono, 
                                                // borramos el registro del array
                                                unset($agenda[$dato_nombre]);
                                            } else {
                                                // Como tenemos teléfono, añadimos 
                                                // el registro al array
                                                $agenda[$dato_nombre] = $dato_tlf;
                                            }
                                        }
                                    } else {
                                        // Si la agenda está vacía, solo puede 
                                        // haber insercciones. Comprobamos el teléfono.
                                        if ($dato_tlf != "") {

                                            // Si hay teléfono, insertamos el 
                                            // registro en el array
                                            $agenda[$dato_nombre] = $dato_tlf;
                                        } else {
                                            // Si no hay teléfono, mostramos un error
                                            $error = "Debe introducir un número<br>"
                                                    . "de teléfono para insertar un<br>"
                                                    . "nuevo registro";
                                        }
                                    }
                                } else {
                                    // Si el nombre o el número de teléfono 
                                    // no son válidos, mostramos un mensaje de 
                                    // error
                                    $error = "Introduzca un nombre y<br>"
                                            . "un número válidos";
                                }
                            } else {
                                // Si no se ha introducido un nombre y el array 
                                // está vacío, mostramos un mensaje de error
                                if (!empty($_POST['array'])) {

                                    $error = "Introduzca un nombre<br>"
                                            . "para introducir un nuevo<br>"
                                            . "registro";
                                }
                            }

                            // Iteramos por el array y construimos tantas filas 
                            // como registros tengamos, incluyendo en cada una 
                            // dos columnas, una para el nombre y otra para el 
                            // teléfono
                            foreach ($agenda as $nombre => $tlf) {
                                print "<tr>";
                                print "<td class='contenedor'>";
                                print $nombre;
                                print "</td>";
                                print "<td class='contenedor'>";
                                print $tlf;
                                print "</td>";
                                print "</tr>";
                            }
                            ?>        
                        </tbody>            
                    </table>
                </td>
            </tr>
            <tr>
                <td>
                    <form name="input" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                        <table>
                            <tr>
                                <td>
                                    Nombre:
                                </td>
                                <td>
                                    <input type="text" name="nombre" />
                                </td>                                
                            </tr>
                            <tr>
                                <td>
                                    Teléfono: 
                                </td>
                                <td>
                                    <input type="tel" name="tlf" />
                                </td>

                            </tr>
                            <tr>
                                <td>
                                    <!-- Serializamos el array $agenda y lo 
                                    asignamos a un objeto input oculto en el 
                                    formulario, para poder enviarlo y mantener 
                                    los datos almacenados-->
                                    <input type='hidden' name='array' value="<?php echo htmlentities(serialize($agenda)); ?>" />
                                    <input type="submit" value="Enviar" name="enviar"/>
                                </td>
                                <?php
                                // Comprobamos si tenemos algún error almacenado
                                if ($error != "") {

                                    // De ser así, crearemos una columna más 
                                    // para mostrar el error
                                    print "<td class='error'>";
                                    print $error;
                                    print "</td>";
                                }
                                ?>
                            </tr>
                        </table>                        
                    </form>
                </td>
            </tr>
        </table>
    </body>
</html>
