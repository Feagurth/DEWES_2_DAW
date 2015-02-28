<?php

/*
 * Copyright (C) 2015 Luis Cabrerizo Gomez
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
 * Clase que contendra la funcionalidad del servicio web
 *
 * @author Luis Cabrerizo Gomez
 */
class webservice {

    /**
     * Funcion que devuelve el PVP de un producto
     * @param string $codProducto Codigo del producto
     * @return double El PVP del producto
     */
    function getPVP($codProducto) {
        // Creamos una instanacia de la base de datos
        $db = new DB();

        // Llamamos a la funcion correspondiente y devolvemos el resultado
        return $db->getPVP($codProducto);
    }

    /**
     * Funcion que devuelve el stock de un producto especifico en una tienda especifica
     * @param string $codProducto El codigo del producto
     * @param int $codTienda El codigo de la tienda
     * @return int Int Stock del producto en la tienda
     */
    function getStock($codProducto, $codTienda) {
        // Creamos una instanacia de la base de datos
        $db = new DB();

        return $db->getStock($codProducto, $codTienda);
    }

    /**
     * Funcion que devuelve los codigos de las familias
     * @return array Un array que contiene el codigo de las familias
     */
    function getFamilias() {

        // Creamos una instanacia de la base de datos
        $db = new DB();

        // Llamamos a la funcion correspondiente y devolvemos el resultado
        return $db->getFamilias();
    }

    /**
     * Funcion que nos permite devolver los productos correspondientes a una familia
     * @param string $codFamilia El codigo de la familia
     * @return array Array Un array que contiene los productos de una familia especifica
     */
    function getProductosFamilia($codFamilia) {

        // Creamos una instanacia de la base de datos
        $db = new DB();

        // Llamamos a la funcion correspondiente y devolvemos el resultado
        return $db->getProductosFamilia($codFamilia);
    }

}
