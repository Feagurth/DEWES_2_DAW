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
            <title>DWES02_Tarea2pres</title>
            <link rel="stylesheet" type="text/css" href="estilos.css" />            
    </head>
    <body>
        <?php

        /**
         * Función que nos permite verificar si la extensión de un fichero es
         * .gif, .jpg, .bmp o .png
         * @param type $fileName Fichero a comprobar
         * @return boolean True si tiene una extensión reconocida y False si 
         * no la tiene
         */
        function checkImage($fileName) {

            // Creamos una expresión regular para comprobar que el nombre
            // del fichero acabe en gif, jpg, bmp o png con ignorecase
            $regex = "/.(gif|jpg|bmp|png)$/i";

            // Aplicamos la expresión regular al nombre del fichero
            if (preg_match($regex, $fileName)) {
                // Si hay coincidencia, el nombre del fichero contiene una de 
                // las extensiones, por tanto devolvemos true
                return true;
            } else {
                // Si no hay coincidencia, el nombre del fichero no contiene 
                // una de las extensiones, por tanto devolvemos false                
                return false;
            }
        }

        // Definimos dos variables para almacenar el texto a concatenar
        $cadena1 = "Hola";
        $cadena2 = "mundo";

        /*
         * Primera parte del ejercicio
         */

        // Creamos un encabezado para el ejercicio
        print "<b>Primera parte</b>";
        print "<br/>";
        print "<i>Concatena dos cadenas con el operador punto (.) e imprimir su resultado</i>";
        print "<br/>";
        print "<br/>";
        print "Usaremos la variable \$cadena1 cuyo valor es '$cadena1' y la variable \$cadena2 cuyo valor es '$cadena2'";
        print "<br/>";
        print "concatenándolas con un espacio en blanco.";
        print "<br/>";

        // Mostramos el resultado concatenando las dos cadenas
        print "Resultado: " . $cadena1 . " " . $cadena2;

        // Separamos los ejercicios entre sí
        print "<br/>";
        print "<br/>";
        print "<br/>";

        /*
         * Segunda parte del ejercicio
         */


        // Creamos un encabezado para el ejercicio
        print "<b>Segunda parte</b>";
        print "<br/>";
        print "<i>Mostrar en pantalla una tabla de 10 por 10 con los números del 1 al 100.</i>";
        print "<br/>";
        print "<br/>";

        // Definimos una tabla para mostrar los resultados
        print "<table>";

        // Creamos un bucle for que iterará 10 veces del valor 0 al 9
        for ($i = 0; $i < 10; $i++) {

            // Definimos una fila de nuestra tabla para cada iteración
            // del bucle exterior
            print "<tr>";

            // Creamos un segundo bucle que iterará de los valores 1 al 10
            for ($j = 1; $j < 11; $j++) {

                // Creamos una columna para cada iteración del bucle interior
                print "<td>";

                // Calculamos el valor del numero a imprimir multiplicando 
                // por 10 el valor del indice de iteración exterior y sumándole 
                // el valor del indice de iteración interior                
                print ($i * 10) + $j;

                // Cerramos la columna creada
                print "</td>";
            }

            // Cerramos la fila creada en el bucle
            print "</tr>";
        }

        // Cerramos la tabla
        print "</table>";

        // Separamos los ejercicios entre sí
        print "<br/>";
        print "<br/>";
        print "<br/>";

        /*
         * Tercera parte del ejercicio
         */


        // Creamos un encabezado para el ejercicio
        print "<b>Tercera parte</b>";
        print "<br/>";
        print "<i>Idem al anterior, pero colorear las filas alternando gris y "
                . "blanco. Además, el tamaño será una constante: define(TAM, 10).</i>";
        print "<br/>";
        print "<br/>";

        // Definimos una constante para almacenar el tamaño
        define("TAM", 10);

        // Creamos una tabla
        print "<table>";

        // Creamos un bucle for que iterará desde 0 hasta el valor de la 
        // variable TAM
        for ($i = 0; $i < TAM; $i++) {


            // Para cada iteración del bucle externo, comprobamos si su índice 
            // es par o impar comprobando el resto de su valor entre dos
            if ($i % 2 == 0) {

                // Si el resultado es cero, es una fila impar y crearemos un 
                // fila a la que asignaremos la clase pijama1 para pintar el 
                // fondo de la fila mediante css                
                print "<tr class='pijama1'>";
            } else {
                // Si el resultado es cero, es una fila par y crearemos un 
                // fila a la que asignaremos la clase pijama1 para pintar el 
                // fondo de la fila mediante css                
                print "<tr class='pijama2'>";
            }

            // Creamos un bucle que iterará 10 veces del 1 al 10            
            for ($j = 1; $j < 11; $j++) {

                // Creamos una columna para cada iteración del bucle interior
                print "<td>";

                // Calculamos el valor del numero a imprimir multiplicando 
                // por 10 el valor del indice de iteración exterior y sumándole 
                // el valor del indice de iteración interior                
                print ($i * 10) + $j;

                // Cerramos la columna creada
                print "</td>";
            }

            // Cerramos la fila creada en el bucle
            print "</tr>";
        }

        // Cerramos la tabla
        print "</table>";

        // Separamos los ejercicios entre sí
        print "<br/>";
        print "<br/>";
        print "<br/>";

        /*
         * Cuarta parte del ejercicio
         */



        // Creamos un encabezado para el ejercicio
        print "<b>Cuarta parte</b>";
        print "<br/>";
        print "<i>Hacer un programa que muestre en una tabla de 4 columnas "
                . "todas las imágenes de  un directorio \"fotos\". Suponga que en el "
                . "directorio sólo existen fotos.</i>";
        print "<br/>";
        print "<br/>";

        // Definimos una constante para almacenar el directorio donde se 
        // encuentran las fotos
        define("DIR_FOTOS", "fotos");

        // Definimos una constante para especificar la cantidad de columnas
        // que tendrá nuestra tabla
        define("NUM_COLS", 4);

        // Escaneamos el directorio fotos y guardamos el contenido dentro de 
        // un array
        $fotos = scandir(DIR_FOTOS);

        // Inicializamos una variable de control para ayudarnos a controlar la
        // creación de filas
        $control = 0;

        // Creamos una tabla
        print "<table>";

        // Creamos un bucle que itere por todos los elementos del vector $fotos
        foreach ($fotos as $foto) {

            // Comprobamos que los valores que estamos leyendo en la iteración 
            // no correspondan con los valores de directorio actual y 
            // directorio anterio
            if ($foto != "." && $foto != "..") {

                // Comprobamos si el resto de la variable control entre 4 es cero.
                // Esto indica que será el primer elemento de una nueva linea
                if ($control % NUM_COLS == 0) {
                    // Abrimos una nueva linea en la tabla
                    print "<tr>";
                }

                // Creamos una columna y dentro una imágen con los valores 
                // almacenados en el array y recuperados a cada iteración del 
                // bucle
                print "<td>";
                print "<img src='" . DIR_FOTOS . "/" . $foto . "' alt='" .
                        DIR_FOTOS . "/" . $foto . "' />";
                print "</td>";

                // Comprobamos si el resto de la variable control entre 4 es tres.
                // Esto indica que será el último elemento de una linea            
                if ($control % NUM_COLS == (NUM_COLS - 1)) {
                    // Por tanto cerramos la linea de la tabla
                    print "</tr>";
                }

                // Incrementamos la variable de control
                $control += 1;
            }
        }

        // Cerramos la tabla
        print "</table>";

        // Separamos los ejercicios entre sí
        print "<br/>";
        print "<br/>";
        print "<br/>";

        /*
         * Quinta parte del ejercicio
         */

        // Creamos un encabezado para el ejercicio
        print "<b>Quinta parte</b>";
        print "<br/>";
        print "<i>ídem al anterior, pero que muestre las fotos en 100x100 y que "
                . "al pulsar abra la foto entera. Compruebe que sólo muestra fotos con "
                . "extensión .jpg, .png, bmp o .gif<br />(Haga una función que "
                . "lo compruebe usando las expresiones regulares)</i>";
        print "<br/>";
        print "<br/>";


        // Inicializamos una variable de control para ayudarnos a controlar la
        // creación de filas
        $control2 = 0;

        // Creamos una tabla
        print "<table>";

        // Creamos un bucle que itere por todos los elementos del vector $fotos
        foreach ($fotos as $foto) {

            // Comprobamos que los valores que estamos leyendo en la iteración 
            // no correspondan con los valores de directorio actual y 
            // directorio anterio
            if ($foto != "." && $foto != "..") {

                // Antes de cada iteración comprobamos si la imagen a iterar 
                // contiene una de las extensiones permitidas.
                if (checkImage($foto)) {

                    // Comprobamos si el resto de la variable control entre 4 es cero.
                    // Esto indica que será el primer elemento de una nueva linea
                    if ($control2 % NUM_COLS == 0) {
                        // Abrimos una nueva linea en la tabla
                        print "<tr>";
                    }

                    // Creamos una columna y dentro una imágen con los valores 
                    // almacenados en el array y recuperados a cada iteración del 
                    // bucle, así como un enlace a la url de la foto
                    print "<td>";

                    // Creamos en enlace a la imágen
                    print "<a href='" . DIR_FOTOS . "/" . $foto . "' target='_blank'>";

                    // Creamos la imágen definiendole una clase específica para 
                    // poder modificar su tamaño mediante css
                    print "<img class='resize' src='" . DIR_FOTOS . "/" . $foto . "' alt='" .
                            DIR_FOTOS . "/" . $foto . "' />";

                    print "</td>";

                    // Comprobamos si el resto de la variable control entre 4 es tres.
                    // Esto indica que será el último elemento de una linea            
                    if ($control2 % NUM_COLS == (NUM_COLS - 1)) {
                        // Por tanto cerramos la linea de la tabla
                        print "</tr>";
                    }

                    // Incrementamos la variable de control
                    $control2 += 1;
                }
            }
        }

        // Cerramos la tabla
        print "</table>";
        
        
        
        ?>
    </body>
</html>
