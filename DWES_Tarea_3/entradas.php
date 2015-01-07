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

        /**
         * Método para verificar los datos introducidos por el usuario
         * @param type $tipodoc Tipo de documento
         * @param type $fentrada Fecha de entrada
         * @param type $remit Remitente
         * @param type $dest Destinatario
         * @return int Devuelve 
         * 0 si la validación es correcta
         * 1 si hay un error en el remitente
         * 1 si hay un error en el destinatario
         * 3 si hay un error en el tipo de documento
         * 4 si hay un error en la fecha
         * 5 si el remitente está vacío
         * 6 si el destinatario está vacío
         * 7 si el tipo de documento está vacío
         */
        function validarDatos($tipodoc, $fentrada, $remit, $dest) {
            // Inicializamos la variable de salida al valor que tendría si 
            // toda la validación fuese correcta
            $validacion = 0;

            // Verificamos con expresiones regulares que los caracteres 
            // introducidos para el remitente son los permitidos
            if (!preg_match("/^[0-9a-zA-ZñÑáÁéÉíÍóÓúÚ ]+$/", $remit)) {
                // Si la validación no se cumple, asignamos el valor 
                // correspondiente a la variable de salida
                $validacion = 1;
            }

            // Verificamos con expresiones regulares que los caracteres 
            // introducidos para el destinatario son los permitidos
            if (!preg_match("/^[0-9a-zA-ZñÑáÁéÉíÍóÓúÚ ]+$/", $dest)) {
                // Si la validación no se cumple, asignamos el valor 
                // correspondiente a la variable de salida                
                $validacion = 2;
            }

            // Verificamos con expresiones regulares que los caracteres 
            // introducidos para el tipo de documento son los permitidos           
            if (!preg_match("/^[0-9a-zA-ZñÑáÁéÉíÍóÓúÚ ]+$/", $tipodoc)) {
                // Si la validación no se cumple, asignamos el valor 
                // correspondiente a la variable de salida                
                $validacion = 3;
            }

            // Verificamos que la fecha de entrada no sea superior a la fecha 
            // actual puesto que no deberían permitirse la entrada de documentos 
            // con dias posteriores al actual. No se puede registrar documentos 
            // que aún no han llegado a la oficina
            if ($fentrada > date('Y-m-d')) {
                // Si la validación no se cumple, asignamos el valor 
                // correspondiente a la variable de salida                
                $validacion = 4;
            }
            
            // Verificamos que el remitente no esté vacío
            if ($remit == "") {
                // Si la validación no se cumple, asignamos el valor 
                // correspondiente a la variable de salida                                
                $validacion = 5;
            }

            // Verificamos que el destinatario no esté vacío
            if ($dest == "") {
                // Si la validación no se cumple, asignamos el valor 
                // correspondiente a la variable de salida                                
                $validacion = 6;
            }

            // Verificamos que el tipo de documento no esté vacío
            if ($tipodoc == "") {
                // Si la validación no se cumple, asignamos el valor 
                // correspondiente a la variable de salida                                
                $validacion = 7;
            }            

            // Devolvemos la variable con el resultado de la validación
            return $validacion;
        }

        /**
         * Función que nos permite generar un número de registro
         * @param type $bd Instancia de la base de datos donde están los 
         * registros de entrada
         * @return string El Número de registro generado
         */
        function calcularNreg($bd) {

            // Realizamos una consulta para recuperar el número de registro más alto 
            // que haya en la tabla de entradas de la base de datos
            $nreg = $bd->query('Select max(nreg) from entradas');

            // Reali<amos la consulta
            $nreg = $nreg->fetch();

            // Asignamos el número de registros a una variable
            $nreg = $nreg[0];

            // Quitamos los 4 primeros caracteres del número recuperado, que 
            // corresponden con el año y las comparamos con el año actual del 
            // sistema
            if (substr($nreg, 0, 4) == getdate()['year']) {
                // Si son iguales, quitamos los caracteres del año, convertimos 
                // la cadena resultante a entero y le sumamos 1.
                $nreg = ((int) substr($nreg, 4)) + 1;
            } else {
                // Si son distintos, asignamos 1 a la variable
                $nreg = 1;
            }

            // Finalmente cogemos el año actual del sistema y le concatenamos 
            // el número calculado formateado a 2 cifras con ceros en caso de 
            // tener un sólo dígito, consiguiendo de este modo el número de 
            // registro siguiente al más alto de la base de datos
            $nreg = getdate()['year'] . sprintf('%1$02d', $nreg);

            // Finalmente devolvemos el valor generado
            return $nreg;
        }

        // Creamos un bloque try-catch para la inicialización de la base 
        // de datos
        try {

            // Inicializamos el valor del número de registro
            $nreg = "0";

            // Creamos una conexión a la base de datos especificando el host, 
            // la base de datos, el usuario y la contraseña
            $gestion = new PDO('mysql:host=localhost;dbname=gestion', 'dwes', 'abc123.');
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
            // información de algún destinatario. De no ser así, es la primera 
            // carga de la página. En caso contrario, la carga es para validar 
            // e insertar un registro.
            if (empty($_POST['dest'])) {

                // Realizamos una consulta con la base de datos para traer los 
                // datos de la tabla entradas ordenados por fecha de entrada e 
                // id_entrada descendente
                $entrada = $gestion->query('select * from entradas order by fentrada, id_entrada desc');

                // Calculamos el siguiente número de registro a usar y lo 
                // almacenamos en una variable
                $nreg = calcularNreg($gestion);
            } else {

                // Si es una insercción, volcamos los valores a insertar en 
                // variables directamente desde el POST de la página
                $nreg = $_POST['nreg'];
                $tipodoc = $_POST['tipodoc'];
                $fentrada = $_POST['fentrada'];
                $remit = $_POST['remit'];
                $dest = $_POST['dest'];

                // Hay que verificar si el POST trae valores para el checkbox 
                // de escaneado, puesto que si solo aparece el valor on si el 
                // checkbox ha sido marcado. Si no se ha marcado el checkbox, 
                // el POST no trae información alguna. Le asignamos 1 en caso 
                // de estar marcado y 0 si no lo está
                $esc = (isset($_POST['esc']) ? "1" : "0");

                // Validamos los datos introducidos por el usuario y guardamos 
                // el resultado de la validación en una variable
                $validacion = validarDatos($tipodoc, $fentrada, $remit, $dest);

                // Si la validación ha sido exitosa, guaardamos los valores en 
                // la base de datos
                if ($validacion == 0) {

                    // Realizamos una insercción en la base de datos
                    $resultado = $gestion->exec("insert into entradas values("
                            . "0, "
                            . "$nreg, "
                            . "'$tipodoc' ,"
                            . "'$fentrada' ,"
                            . "'$remit' ,"
                            . "'$dest' ,"
                            . "$esc)");

                    // Desasignamos el valor de fecha de entrada
                    unset($fentrada);
                } else {
                    // Si la validación no ha sido correcta creamos un mensaje 
                    // de error específico para el error
                    switch ($validacion) {
                        case 1:
                            $mensajeError = "El remitente introducido no es válido. Introduzca un valor correcto";
                            break;
                        case 2:
                            $mensajeError = "El destinatario introducido no es válido. Introduzca un valor correcto";
                            break;
                        case 3:
                            $mensajeError = "El tipo de documento introducido no es válido. Introduzca un valor correcto";
                            break;
                        case 4:
                            $mensajeError = "La fecha introducida no es válida. Introduzca un valor correcto";
                            break;
                        case 5:
                            $mensajeError = "El campo remitente no puede estar vacío";
                            break;
                        case 6:
                            $mensajeError = "El campo destinatario no puede estar vacío";
                            break;
                        case 7:
                            $mensajeError = "El campo tipo documento no puede estar vacío";
                            break;
                    }
                }

                // Realizamos una consulta con la base de datos para poder 
                // rellenar la tabla de registros
                $entrada = $gestion->query('select * from entradas order by fentrada desc');

                // Calculamos un número de registro nuevo
                $nreg = calcularNreg($gestion);
            }
        }
        ?>

        <div id="nuevo_registro">
            <form id="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div>
                    <h3>Nuevo Registro de Entrada</h3>
                    Nº registro: <input type="text" id="nreg" name="nreg" readonly="1" value="<?php echo $nreg ?>"/>
                    Tipo Doc:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" id="tipodoc" name="tipodoc"/>
                    Fecha:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="date" id="fentrada" name="fentrada" value="<?php echo date('Y-m-d') ?>"/>
                </div>
                <div>
                    Remitente:&nbsp;&nbsp;<input type="text" id="remit" name="remit"/>
                    Destinatario: <input type="text" id="dest" name="dest"/>
                    Escaneado: <input type="checkbox" id="esc" name="esc"/>
                </div>
                <div>
                    <input type="submit" value="Insertar registro" title="Insertar registro" alt="Insertar registro">
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
                        <th>Id</th>
                        <th>Nº Registro</th>
                        <th>Tipo de Documento</th>
                        <th>Fecha Entrada</th>
                        <th>Remitente</th>
                        <th>Destinatario</th>
                        <th>Escaneado</th>
                    </tr>
                </thead>
                <?php
                // Creamos un contador y lo inicializamos
                $contador = 1;

                // Comprobamos si tenemos valores por los que iterar para crear 
                // la tabla de entradas
                if (isset($entrada)) {

                    // Iteramos por todos los registros consultados
                    while ($apoyo = $entrada->fetch()) {

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
                        print $apoyo['id_entrada'];
                        print "</td>";

                        print "<td>";
                        print $apoyo['nreg'];
                        print "</td>";

                        print "<td>";
                        print $apoyo['tipodoc'];
                        print "</td>";

                        // Formateamos la fecha recuperada de la base de datos 
                        // a formato dd/mm/yyyy
                        print "<td>";
                        print date("d/m/Y", strtotime($apoyo['fentrada']));
                        print "</td>";

                        print "<td>";
                        print $apoyo['remit'];
                        print "</td>";

                        print "<td>";
                        print $apoyo['dest'];
                        print "</td>";

                        // Formateamos el vlaor del escaneado con letras para 
                        // hacerlo más legible
                        print "<td>";
                        print ($apoyo['esc'] == 1 ? "Si" : "No");
                        print "</td>";

                        print "</tr>";

                        // Aumentamos el valor de l contador para la siguiente 
                        // vuelta
                        $contador++;
                    }
                }
                ?>
            </table>

        </div>

    </body>
</html>
