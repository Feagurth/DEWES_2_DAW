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
        // Comprobamos si en la informaicón de POST tenemos información de un 
        // código de producto
        if (!empty($_POST['codigo'])) {

            // De ser así almacenamos el código en una variable
            $codigo = $_POST['codigo'];

            // Inicializamos una variable para controlar la validación del 
            // formulario
            $validacion = true;

            // Comprobamos si en el POST tenemos valor para pvp, de ser así 
            // estaríamos validando los datos, en caso contrario, sería la 
            // primera vez que se carga la página y por tanto hay que 
            // rellenarla con la información de la base de datos
            if (!isset($_POST['PVP'])) {

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
                }

                // Comprobamos si tenemos algún error de conexión con la base de datos
                if (!isset($error)) {

                    // Si no lo tenemos, hacemos una consulta pare recuperar la 
                    // información del producto
                    $producto = $dwes->query("Select * from producto where cod = '" . $codigo . "'");

                    // Recogemos la información de la primera (y única) linea de la 
                    // consulta y lo volcamos a la misma variable
                    $producto = $producto->fetch();
                } else {
                    // Si tenemos algún mensaje de error, lo mostramos la usuario
                    print "<div class='error'> Se ha producido un error: " . $error . ": " . $mensajeError . "</div>";
                }
            } else {

                
                // Creamos un array idéntico al que devolvería la base de datos 
                // al recuperar los datos de la base de datos, pero lo rellenamos 
                // con la información introducida por el usuario que nos llegará 
                // por el POST de la página
                $producto = array(
                    'codigo' => $codigo,
                    'nombre' => $_POST['nombre'],
                    'nombre_corto' => $_POST['nombre_corto'],
                    'descripcion' => $_POST['descripcion'],
                    'PVP' => $_POST['PVP']
                );

                // Comprobamos si el precio es numérico y si no es negativo
                if (is_numeric($producto['PVP']) && $producto['PVP'] >= 0) {
                    
                    // Si la validación es correcta creamos una url con la 
                    // página de actualización y la información almacenada en 
                    // el array pasada como parámetros
                    $destino = "actualizar.php?".  http_build_query($producto);

                    // Usamos la función header para enviar la información a la 
                    // página actualizar.php con la información introducida 
                    // por el usuario
                    header("Location:$destino");
                } else {
                    // Si no se ha podido validar los datos, cambiamos el valor 
                    // de la variable de validacion
                    $validacion = false;
                }
            }
        } else {
            // Si no tenemos ningún código de producto, mostramos un  mensaje 
            // al usuario
            print "<div class='error'>Se ha producido un error: No hay datos de código de producto</div>";
        }
        ?>

        <!-- Usamos htmlspecialchars en la codificación de la acción del 
            formulario para evitar ataques por injección de código.
            Enviamos la página a si misma para realizar el proceso de 
            validación de datos
        -->
        <form id="form_seleccion" action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?> method="post">
            <div id="contenido">
                <h2>Producto: </h2>
                <div class="producto">
                    <!-- Rellenamos los campos creados en HTML con la información almacenada en la variable $producto -->
                    Nombre Corto: <input type="text" id="nombre_corto" name="nombre_corto" value="<?php echo $producto['nombre_corto'] ?>">
                </div>
                <div class="producto">
                    <!-- Rellenamos los campos creados en HTML con la información almacenada en la variable $producto -->
                    Nombre:<br>
                    <textarea id="nombre" name="nombre" cols="38" rows="5" ><?php echo $producto['nombre'] ?></textarea>
                </div>
                <div class="producto">
                    <!-- Rellenamos los campos creados en HTML con la información almacenada en la variable $producto -->
                    Descripcion:<br>
                    <textarea id="descripcion" name="descripcion" cols="38" rows="5"><?php echo $producto['descripcion'] ?></textarea>
                </div>
                <div class="producto">
                    <!-- Rellenamos los campos creados en HTML con la información almacenada en la variable $producto -->
                    PVP: <input type="text" id="PVP" name="PVP" value="<?php echo $producto['PVP'] ?>">

                    <?php
                    // Si la variable de validación es falsa, 
                    // eso quiere decir que el precio introducido no es válido
                    if (!$validacion) {
                        // Mostramos un mensaje al usuario
                        print '<a class="error"> Introduzca un numero valido</a>';
                    }
                    ?>                    
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
