<!DOCTYPE html>
<!--
Copyright (C) 2015 Luis Cabrerizo Gómez

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
try {
    require_once './Db.php';

    // Inicializamos la variable de error
    $error = "";
    
    // Creamos una nueva instancia de la base de datos
    $db = new DB();

    // Verificamos si hay parámetros de modo en el get, por si la página se usa 
    // sin Javascript
    if (isset($_GET['modo'])) {

        // Comprobamos si hay valor de id en el get
        if (isset($_GET['id'])) {

            // Asignamos el valor del id a una variable
            $id = $_GET['id'];

            // Comprobamos si el modo que se ha pasado es el de eliminar
            if ($modo === 'e') {

                // Si es así, se elimina el usuario
                $db->eliminarUsuario($id);

                // Quitamos el valor de id del GET para que no se realize 
                // otro borrado al refrescar
                unset($_GET['id']);
            }
        }
    }
// Recuperamos los datos de los usuarios
    $datos = $db->listarUsuarios();
} catch (Exception $ex) {
    // Si se produce una excepción, almacenamos el mensaje de error 
    // en una variable
    $error = $ex->getMessage();
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Examen</title>
        <link type = "text/css" rel = "stylesheet" href = "estilos.css"/>
        <script type="text/javascript" src="HTTP://code.jquery.com/jquery-latest.js"></script>        
        <script type="text/javascript" src="script.js"></script>        
    </head>
    <body>
        <div>
            <h1>Luis Cabrerizo Gómez - Examen 3ª Evaluación</h1>
            
        </div>
        <div class="visitas">
            <!-- Mostramos la información de la ultima visita y el número de visitas desde las cookies -->            
            <p>Última visita: <?php echo $_COOKIE['ultimavisita'] ?></p>
            <p>Nº Visitas: <?php echo $_COOKIE['visitas'] ?></p>
        </div>
        <div class="listado">
            <table id="tabla">
                <thead>
                    <tr>
                        <td>Id</td>
                        <td>Usuario</td>
                        <td>Contraseña</td>
                        <td>Nombre</td>
                        <td>Ap1</td>
                        <td>Ap2</td>
                        <td>Tfno.</td>
                        <td>Eliminar</td>                        
                    </tr>
                </thead>
                <tbody>
                    <?php
                    
                    // Iteramos por todas las filas de usuarios
                    foreach ($datos as $fila) {

                        // Creamos una fila
                        echo "<tr>";

                        // Creamos la s columnas asociadas
                        echo "<td>" . $fila['id'] . "</td>";
                        echo "<td>" . $fila['usuario'] . "</td>";
                        echo "<td>" . $fila['password'] . "</td>";
                        echo "<td>" . $fila['nombre'] . "</td>";
                        echo "<td>" . $fila['ap1'] . "</td>";
                        echo "<td>" . $fila['ap2'] . "</td>";
                        echo "<td>" . $fila['tfno'] . "</td>";
                        
                        // Creamos una última columna con un elemento anchor 
                        // con un enlace a la misma página pasándole los valores 
                        // de modo y de id por si la página se ejecuta sin Javascript
                        echo"<td><a id='" . $fila['id'] . "' href='index.php?id=" . $fila['id'] . "&modo=e'>Borrar</a></td>";
                        echo "</tr>";
                    }
                    ?>                    
                    </tr>
                </tbody>
            </table>
        </div>
        <div class=".error">
            <!-- Aquí mostramos los mensajes de error-->
            <p><?php echo $error ?></p>
        </div>
    </body>
</html>
