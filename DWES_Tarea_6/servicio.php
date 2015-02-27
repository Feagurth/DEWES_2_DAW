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

require_once './db.php';

/**
 * Función que devuelve el PVP de un producto
 * @param type $codProducto Codigo del producto
 * @return type Double El PVP del producto
 */
function getPVP($codProducto) {
    // Creamos una instanacia de la base de datos
    $db = new DB();

    // Llamamos a la función correspondiente y devolvemos el resultado
    return $db->getPVP($codProducto);
}

/**
 * Función que devuelve el stock de un producto específico en una tienda específica
 * @param type $codProducto El código del producto
 * @param type $codTienda El código de la tienda
 * @return type Int Stock del producto en la tienda
 */
function getStock($codProducto, $codTienda) {
    // Creamos una instanacia de la base de datos
    $db = new DB();

    return $db->getStock($codProducto, $codTienda);
}

/**
 * Función que devuelve los códigos de las familias
 * @return type Array Un array que contiene el código de las familias
 */
function getFamilias() {

    // Creamos una instanacia de la base de datos
    $db = new DB();

    // Llamamos a la función correspondiente y devolvemos el resultado
    return $db->getFamilias();
}

/**
 * Función que nos permite devolver los productos correspondientes a una familia
 * @param type $codFamilia El código de la familia
 * @return type Array Un array que contiene los productos de una familia especifica
 */
function getProductosFamilia($codFamilia) {

    // Creamos una instanacia de la base de datos
    $db = new DB();

    // Llamamos a la función correspondiente y devolvemos el resultado
    return $db->getProductosFamilia($codFamilia);
}

// Creamos una variable con la dirección en la que estará alojado el servicio
$uri = "http://localhost/DWES_Tarea_6";

// Creamos el servicio, pasándole los parámetros de creación como un array
$server = new SoapServer(null, array('uri' => $uri));

// Asignamos las funciones que tendrá el servicio
$server->addFunction("getPVP");
$server->addFunction("getStock");
$server->addFunction("getFamilias");
$server->addFunction("getProductosFamilia");

// Hacemos que el servicio se encargue de procesar las peticiones
// usando la función handle()
$server->handle();
