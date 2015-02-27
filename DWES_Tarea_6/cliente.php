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

// Creamos un par de variables con la información necesaria para acceder al servicio
$url="http://localhost/DWES_Tarea_6/servicio.php";
$uri="http://localhost/DWES_Tarea_6";

// Creamos un cliente pasandole las opciones como un array
$cliente = new SoapClient(null,array('location'=>$url,'uri'=>$uri));
 

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


// Imprimimos en pantalla la información almacenada en las variables
print("El pvp es ".$pvp);
print("<br />El stock es ".$stock);
print("<br />Las familias son <br />");
print_r(array_values($familias));
print("<br />Los productos de la familia 'CONSOL' son <br />");
print_r(array_values($productosFamilias));