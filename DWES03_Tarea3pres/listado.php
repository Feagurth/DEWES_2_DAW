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
        <link type="text/css" rel="stylesheet" href="estilos.css">
        <title>DWES03_Tarea3pres</title>
    </head>
    <body>

        <div id="encabezado">
            <h1>Tarea: Listado de productos de una familia</h1>

            <?php
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
                // Comprobamos si el mensaje de error tiene el código de 1045 
                // el cual corresponde al error de acceso denegado al usuario
                if ($error == 1045) {
                    // Creamos una conexión con la base de datos usando el 
                    // usuario root
                    $dwes = new PDO('mysql:host=localhost;dbname=', 'root', '');
                    // Cargamos el contenido del fichero sql para crear un 
                    // usuario en una variable
                    $sql = file_get_contents('createuser.sql');
                    // Finalmente ejecutamos los comandos sql
                    $dwes->exec($sql);
                }
                // Comprobamos si el mensaje de error tiene el código de 1049 
                // el cual corresponde con el error de base de datos desconocida
                if ($error == 1049) {                    // Creamos una conexión con la base de datos usando el 
                    // usuario root
                    $dwes = new PDO('mysql:host=localhost;dbname=', 'root', '');
                    // Cargamos el contenido del fichero sql para crear la base
                    // de datos en una variable
                    $sql = file_get_contents('createdb.sql');
                    // Finalmente ejecutamos los comandos sql
                    $dwes->exec($sql);
                }
            }
            // Comprobamos si se ha producido un error al conectar a la base 
            // de datos
            if (!isset($error)) {
                // Si no hay errores, realizamos una consulta a la base de 
                // datos para recuperar todos los registros de las familias 
                // de productos
                $familia = $dwes->query('Select * from familia');
                // Comprobamos si en la información de POST tenemos información del 
                // objeto que contiene las familias
                if (!empty($_POST['cmbFamilia'])) {
                    // Si trae información es que hemos pulsado el botón de 
                    // Mostrar Productos y por tanto hemos seleccionado una familia.
                    // Recuperamos el código de la familia seleccionada y lo 
                    // almacenamos
                    $codFamilia = $_POST['cmbFamilia'];
                    // Realizamos una consulta a la base de datos usando el código 
                    // para recuperar todos los productos de esa familia
                    $productos = $dwes->query("Select cod, nombre_corto, PVP from producto where familia = '" . $codFamilia . "'");
                }
            } else {
                // Comprobamos si el mensaje de error que tenemos corresponde 
                // con los códigos de error de usuario sin permisos o de base 
                // de datos desconocida
                if ($error != 1045 && $error != 1049) {
                    // Si no es el caso, lo mostramos la usuario
                    print "<div class='error'> Se ha producido un error: " . $error . ": " . $mensajeError . "</div>";
                } else {
                    // De ser uno de los dos errores arriba mencionados, 
                    // volveremos a cargar la página para que inicie con las 
                    // modificaciones generadas durante el control de errores
                    header("Location:listado.php");
                }
            }
            ?>

            <!-- Usamos htmlspecialchars en la codificación de la acción del 
            formulario para evitar ataques por injección de código -->
            <form id="form_seleccion" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div>
                    Familia: 
                    <select name="cmbFamilia" id="cmbFamilia">
                        <?php
                        // Comprobamos si hemos recuperado correctamente los 
                        // valores de las familias de productos
                        if (isset($familia)) {
                            // De ser así iteramos por todas las filas de la 
                            // consulta, volcando cada una en la variable $apoyo
                            while ($apoyo = $familia->fetch()) {
                                // Para cada linea de la consulta creamos una 
                                // etiqueta option asígnandole el código de la 
                                // familia como valor y el texto como descripción
                                print '<option value="' . $apoyo['cod'] . '">' . $apoyo['nombre'] . '</option>';
                            }
                        }
                        ?>
                    </select>
                    <input type="submit" id="btnMostrarProductos" name="btnMostrarProductos" value="Mostrar Productos">                    
                </div>       
            </form>
            <div>
                &nbsp;
            </div>
        </div>

        <div id="contenido">
            <h2>Productos de la familia:</h2>
            <?php
            // Comprobamos si hemos recuperado correctamente los 
            // valores de los productos cuya familia hemos seleccionado
            if (isset($productos)) {
                // De ser así iteramos por todas las filas de la 
                // consulta, volcando cada una en la variable $apoyo
                while ($apoyo = $productos->fetch()) {
                    // Creamos para cada fila de la consulta una etiqueta <div> 
                    // que contendrá un formulario con el nombre corto de 
                    // producto, el precio y un botón que nos permitirá editar
                    // los datos del mismo desde la página editar.php
                    print '<div class="producto">';
                    print '<form id="form_edicion" action="editar.php" method="post">';
                    print "Producto " . $apoyo['nombre_corto'] . " " . $apoyo['PVP'] . " euros  ";
                    print '<input type="submit" id="editarProducto" name="editarProducto" value=" Editar " />';
                    print '<input type="hidden" id="nombreCortoSel" name="nombreCortoSel" value="' . $apoyo['nombre_corto'] . '">';
                    print '<input type="hidden" id="codigo" name="codigo" value="' . $apoyo['cod'] . '">';
                    print "</form>";
                    print "</div>";
                }
            }
            ?>

        </div>

        <div id="pie">
        </div>

    </body>
</html>