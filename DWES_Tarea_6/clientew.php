<?php

/* 
 * Copyright (C) 2015 Luis Cabrerizo Gómez
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

require_once './webservicew.php';

// Permitimos el uso de acentos y caracteres especiales
header('Content-Type: text/html; charset=UTF-8');


// Creamos un nuevo cliente usando la clase interface del servicio web que tenemos
$cliente = new webservice();

// Usamos la funcion getPVP del servicio para recuperar el PVP de un artículo y 
// lo almacenamos en una variable
$pvp = $cliente->getPVP('PS3320GB');

// Usamos la funcion getStock del servicio para recuperar el stick de un artículo 
// determinado en una tienda específica y lo almacenamos en una variable
$stock = $cliente->getStock('PS3320GB', '1');

// Usamos la funcion getFamilias del servicio para recuperar las familias de 
// los artículos y lo almacenamos en una variable
$familias = $cliente->getFamilias();

// Usamos la funcion getProductosFamilia del servicio para recuperar el los 
// productos de una familia determinada y lo almacenamos en una variable
$productosFamilias = $cliente->getProductosFamilia('CONSOL');

// Imprimimos el pvp del artículo seleccionado
echo "El artículo PS3320GB vale: " . $pvp . " euros";
echo "<br />";
echo "<br />";

// Imprimimos el stock del artículo seleccionado en la tienda especificada
echo "El artículo PS3320GB en la tienda 1 tiene un stock de: " . $stock;
echo "<br />";
echo "<br />";

// Mostramos un mesaje para el usuario
echo "Los códigos de todas las famílias son: ";

// Definimos una variable para almacenar la cadena y la inicializamos
$cadena = "";

// Iteramos por el array de familias recuperando los códigos
foreach ($familias as $codFam) {
    // Concatenamos los códigos de familia en la variable de almacenaje junto 
    // con una coma y un espacio en blanco que nos servirán de separador
    $cadena = $cadena . $codFam . ", ";
}

// Imprimimos el resultado quitando los últimos dos caracteres correspondientes 
// a la última coma y el espacio en blanco que concatenamos
echo substr($cadena, 0, -2);
echo "<br />";
echo "<br />";
        

// Mostramos un mesaje para el usuario
echo "Los códigos de los productos pertenecientes a la familia CONSOL son: ";

// Limpiamos el contenido de la variable de almacenaje para reusarla
$cadena = "";

// Recorremos el array de productos de las familias recuperando los productos
foreach ($productosFamilias as $prod) {
    // Concatenamos los códigos de producto en la variable de almacenaje junto 
    // con una coma y un espacio en blanco que nos servirán de separador
    $cadena = $cadena . $prod . ", ";
}

// Imprimimos el resultado quitando los últimos dos caracteres correspondientes 
// a la última coma y el espacio en blanco que concatenamos
echo substr($cadena, 0, -2);
echo "<br />";
echo "<br />";