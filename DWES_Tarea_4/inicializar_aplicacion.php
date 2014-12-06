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
        <meta charset="UTF-8">
        <title>Creación de base de datos</title>
        <link type="text/css" rel="stylesheet" href="estilos.css" />
    </head>
    <body>
        <?php
        // Creamos una variable de control para verificar si hay que mostrar o 
        // no el botón de creación de la base de datos
        $control = 0;

        // Creamos una conexión con la base de datos usando el 
        // usuario root
        $gestion = new PDO('mysql:host=localhost;dbname=', 'root', '');

        // Comprobamos que el GET de la página contiene información de control
        if (!empty($_GET['control'])) {

            // Verificamos que esa información vale 1, lo que quiere decir que 
            // habrémos pulsado el botón de creación de base de datos
            if ($_GET['control'] == "1") {
                try {
                    // Cargamos el contenido del fichero sql para crear un 
                    // usuario en una variable
                    $sql = file_get_contents('createdb.sql');
                    // Finalmente ejecutamos los comandos sql
                    $gestion->exec($sql);

                    // Si todo está correcto, modificamos la variable de control 
                    // para que no muestre el botón
                    $control = 1;
                } catch (PDOException $e) {
                    // Controlamos las excepciones
                    $error = $e->getCode();
                    $mensajeError = $e->getMessage();
                }
            }
        } else {

            try {
                // Realizamos una consulta a gestor de base de datos para ver si 
                // hay alguna base de datos que se corresponda con la que usamos 
                // en la página
                $consulta = $gestion->query("SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = 'Gestion'");

                // Recuperamos todos los resultados forzando a traer un solo valor 
                // por registro
                $resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);

                // Comprobamos si hay al menos un registro, lo que quiere decir que 
                // la base de datos existe
                if (count($resultado) == 1) {
                    // Cambiamos el valor de la variable de control a 1 para no 
                    // mostrar el botón
                    $control = 1;
                }
            } catch (PDOException $e) {
                // Controlamos las excepciones
                $error = $e->getCode();
                $mensajeError = $e->getMessage();
            }
        }
        ?>
        <div>
            <p>Creación de base de datos</p>
            <div  id="<?php
        // Dependiendo del valor de la variable de control, mostramos u 
        // ocultamos el div que contiene el botón crear la base de datos
        if ($control == 0) {
            echo "visible";
        } else {
            echo "invisible";
        }
        ?>">
                <input type="button" title="Creación de base de datos" alt="Creación de base de datos" value="Creación de base de datos" onclick="window.location.href = 'inicializar_aplicacion.php?control=1'"/>
            </div>
        </div>
<?php
// Creamos la estructura de la página para mostrar el mensaje 
// de error o de ejecución correcta.
print "<div>";
print "<p>";
if (isset($error)) {
    print "Código de error: " . $error . " - Mensaje: " . $mensajeError;
} else {
    if (!empty($_GET['control'])) {
        if ($_GET['control'] == "1") {
            print "La creación de la base de datos se ha realizado correctamente";
        }
    }
}
print "</p>";
print "</div>";
?>
        <div>
            <br>
            <input type="button" title="Volver" alt="Volver" value="Volver" onclick="window.location.href = 'index.php'" />
        </div>

    </body>
</html>
