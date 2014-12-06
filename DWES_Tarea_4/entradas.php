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
<?php
// Inicializamos la sesión
session_start();

// Comprobamos si tenemos en sesión usuario y password
if (!isset($_SESSION['user']) || !isset($_SESSION['pass'])) {
    // De no ser así volvemos a la página index.php para pedirselos al usuario
    header("location:index.php");
} else {
    // En caso contrario crearemos una conexión con la base de datos para 
    // verificar el usuario y el password
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
    if (!isset($mensajeError)) {

        // Realizamos una consulta a la base de datos buscando registros en la 
        // tabla de usuarios cuyo usuario y contraseña sean los mismos que los 
        // introducidos por el usuario
        $consulta = $gestion->query("select user from usuario where user='${_SESSION['user']}' and pass='${_SESSION['pass']}'");

        // Recuperamos todos los resultados forzando a traer un solo valor 
        // por registro
        $usuario = $consulta->fetchAll(PDO::FETCH_ASSOC);

        // Contamos el número de registros que contiene el array de datos traido 
        // de la base de datos
        if (count($usuario) != 1) {
            // En el caso de que devuelva cualquier valor distinto de 1, eso 
            // quiere decir que el usuario y la contraseña son erróneos, 
            // por tanto volvemos a la página index.php tras limpiar la sesión
            session_unset();

            header("location:index.php");
        }
    }
}
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link type="text/css" rel="stylesheet" href="estilos.css" />
        <script type="text/javascript" src="script.js"></script>
        <title>Entrada de documentos</title>
    </head>
    <body>
        <?php
        
        // Usamos include para poder usar las funciones definidas en el archivo funciones.php
        include './funciones.php';
        
        // Creamos un bloque try-catch para la inicialización de la base 
        // de datos
        try {

            // Inicializamos el valor del número de registro y la variable que 
            // contendrá el path de los ficheros escaneados
            $nreg = "0";
            $fichero = "";

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
                // datos de la tabla entradas ordenador por fecha de entrada e 
                // id_entrada descendiente
                $entrada = $gestion->query('select * from entradas order by fentrada desc, id_entrada desc');

                // Calculamos el siguiente número de registro a usar y lo 
                // almacenamos en una variable
                $nreg = calcularNreg($gestion, "E");
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

                // Verificamos si está marcado el checkbox
                if ($esc == 1 && isset($_FILES['addfile'])) {
                    // Comprobamos si hay información en los ficheros subidos al 
                    // servidor y si se ha producido algún error en la subida de 
                    // los mismos
                    if (isset($_FILES['addfile']) && $_FILES['addfile']['error'] == 0) {

                        // Recuperamos la información del fichero con la función 
                        // fopen especificando 'rb' como parámetro para que lea 
                        // el fichero en binario, guardandolo en una variable 
                        // tipo stream
                        $fichero = fopen($_FILES['addfile']['tmp_name'], 'rb');
                    }
                }

                // Validamos los datos introducidos por el usuario y guardamos 
                // el resultado de la validación en una variable
                $validacion = validarDatos($tipodoc, $fentrada, $remit, $dest);

                // Verificamos que si se ha especificado un arhivo escaneado en 
                // un registro haya un fichero seleccionado antes de la insercción
                if ($esc == 1 && $_FILES['addfile']['error'] != 0) {
                    // En caso de no haberlo, asignamos un valor específico a 
                    // la variable de validación
                    $validacion = 8;
                }

                // Si la validación ha sido exitosa, guaardamos los valores en 
                // la base de datos
                if ($validacion == 0) {

                    try {

                        // Preparamos la base de datos para hacer uso de transacciones
                        $gestion->beginTransaction();

                        // Comprobamos si el registro a introducir tiene un 
                        // fichero asociado
                        if ($esc == 1) {

                            // Preaparamos una sentencia para la insercción del 
                            // fichero en la tabla documentos
                            $stmt = $gestion->prepare("INSERT INTO DOCUMENTOS VALUES(0, ?, ?, ?, ?)");


                            $stmt->bindParam(1, $_FILES['addfile']['size']);
                            $stmt->bindParam(2, $_FILES['addfile']['type']);
                            $stmt->bindParam(3, $_FILES['addfile']['name']);
                            
                            // Asignamos el valor del fichero, especificando 
                            // que se trata de un fichero tipo BLOB, para que 
                            // modifique la información guardada en formato 
                            // stream en la base de datos adaptandolo en el 
                            // proceso
                            $stmt->bindParam(4, $fichero, PDO::PARAM_LOB);

                            // Ejecutamos la sentencia
                            $stmt->execute();

                            // Recuperamos el último id insertado en la base 
                            // de datos, usando pra ello la función lasInsertId 
                            // de PDO
                            $lastId = $gestion->lastInsertId();

                            // Preparamos otra sentencia para insertar un 
                            // registro con el resto de información, incluyendo 
                            // el id del registro insertado en la tabla documetnos
                            $stmt = $gestion->prepare("INSERT INTO ENTRADAS VALUES("
                                    . "0, "
                                    . "'$nreg', "
                                    . "'$tipodoc' ,"
                                    . "'$fentrada' ,"
                                    . "'$remit' ,"
                                    . "'$dest' ,"
                                    . "$esc,"
                                    . "$lastId)");

                            // Ejecutamos la sentencia
                            $stmt->execute();

                            // Realizamos un commit para grabar la información 
                            // en la base de datos
                            $gestion->commit();
                        } else {
                            // Si el registro no tiene asignado un fichero, 
                            // preparamos una sentencia para almacenar la 
                            // información, usando null como valor de 
                            // id_documentos
                            $stmt = $gestion->prepare("INSERT INTO ENTRADAS VALUES("
                                    . "0, "
                                    . "'$nreg', "
                                    . "'$tipodoc' ,"
                                    . "'$fentrada' ,"
                                    . "'$remit' ,"
                                    . "'$dest' ,"
                                    . "$esc,"
                                    . "NULL)");

                            // Ejecutamos la sentencia
                            $stmt->execute();

                            // Realizamos un commit para grabar la información 
                            // en la base de datos                            
                            $gestion->commit();
                        }
                    } catch (Exception $e) {

                        // Si se producen errores durante la grabación de la 
                        // información, realizamos un rollback para no grabar 
                        // nada en la base de datos
                        $gestion->rollBack();

                        // Almacenamos el mensaje de error para mostrarselo 
                        // al usuario
                        $mensajeError = $e->getCode() . ":" . $e->getMessage();
                    }

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
                        case 8:
                            $mensajeError = "Si establece un fichero escaneado debe seleccionar uno antes de la insercción del registro";
                    }
                }

                // Realizamos una consulta con la base de datos para poder 
                // rellenar la tabla de registros
                $entrada = $gestion->query('select * from entradas order by fentrada desc, id_entrada desc');

                // Calculamos un número de registro nuevo
                $nreg = calcularNreg($gestion, "E");
            }
        }
        ?>

        <div id="nuevo_registro">
            <form id="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
                <div>
                    <h3>Nuevo Registro de Entrada</h3>
                    Nº registro: <input type="text" id="nreg" name="nreg" readonly="1" value="<?php echo $nreg ?>"/>
                    Tipo Doc:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" id="tipodoc" name="tipodoc"/>
                    Fecha:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="date" id="fentrada" name="fentrada" value="<?php echo date('Y-m-d') ?>"/>
                </div>
                <div>
                    Remitente:&nbsp;&nbsp;<input type="text" id="remit" name="remit"/>
                    Destinatario: <input type="text" id="dest" name="dest"/>
                    Escaneado: <input type="checkbox" id="esc" name="esc" onclick="mostrarOcultar(document.getElementById('esc').checked);" />&nbsp;&nbsp;
                    <input type="file" id="addfile" name="addfile" readonly="1" value="<?php echo $fichero ?>" />
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

                        print "<td>";
                        // Comprobamos si el registro tiene un fichero vinculado 
                        // al mismo
                        if ($apoyo['esc'] == 1) {
                            // Si es así, guardamos el id del documento en una 
                            // variable y creamos un enlace con una imagen que 
                            // enlace a la página de descarga de ficheros, 
                            // pasándole el id del fichero correspondiente
                            $id_doc = $apoyo['id_documento'];
                            print "<a target='_blank' href='descarga.php?id=$id_doc'>";
                            print "<img src='images/view_file.png' alt='Pulse para descargar el fichero asociado al registro' title='Pulse para descargar el fichero asociado al registro'>";
                            print "</a>";
                        } else {
                            // En caso contrario, creamos la imagen correspondiente 
                            // a la falta de fichero asociado
                            print "<img src='images/no_file.png' alt='No hay fichero asociado al registro' title='No hay fichero asociado al registro'>";
                        }
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

        <!-- Una vez cargada la página, ejecutamos la función de JavaScript 
        mostrarOcultar pasándole false como parámetro para ocultar los controles 
        para añadir ficheros -->
        <script type="text/javascript">mostrarOcultar(false);</script>
    </body>
</html>
