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

// Instanciamos las librerias de xajax
require_once('xajax_core/xajax.inc.php');

// Creamos un nuevo objeto xajax con el que trabajar
$xajax = new xajax();

// Registramos las funciones que usaremos para las peticiones ajax
$xajax->register(XAJAX_FUNCTION, "limpiarCesta");
$xajax->register(XAJAX_FUNCTION, "anadirArticulo");
$xajax->register(XAJAX_FUNCTION, "mostrarCesta");

// Damos orden de procesar las peticiones
$xajax->processRequest();

/**
 * Función que nos permite limpiar la cesta de compra
 * @return \xajaxResponse
 */
function limpiarCesta() {

    // Creamos un objeto xajaxResponse que será el encargado de contener la 
    // respuesta a la petición de limpiar la cesta de compra
    $respuesta = new xajaxResponse();

    // Asignamos un valor a la respuesta, en este caso la palabra 'vaciar', de 
    // este modo la petición enviará este mensaje al $_POST de la página para 
    // limpiar la cesta con el codigo correspondiente en productos.php
    $respuesta->setReturnValue("vaciar");

    // Devolvemos la respuesta
    return $respuesta;
}

function anadirArticulo($codArticulo)
{
    
    xdebug_break();
    
    // Creamos un objeto xajaxResponse que será el encargado de contener la 
    // respuesta a la petición de añadir un nuevo artículo
    $respuesta = new xajaxResponse();
    
    // Asignamos un valor a la respuesta, en este caso el código del artículo, de 
    // este modo la petición enviará este mensaje al $_POST de la página para 
    // añadir el artículo 
    $respuesta->setReturnValue($codArticulo);
    
    //Devolvemos la respuesta
    return respuesta;
}

function mostrarCesta()
{
    // Creamos un objeto xajaxResponse que será el encargado de contener la 
    // respuesta a la petición de limpiar la cesta de compra
    $respuesta = new xajaxResponse();

    
    // Asignamos un valor en blanco a la respuesta. Puesto que la cesta se 
    // mostrará en la página cesta.php no hace falta diferenciar valores para 
    // identificar conductas, puesto que la página cesta.pho siempre actuará 
    // del mismo modo
    $respuesta->setReturnValue("");

    // Devolvemos la respuesta
    return $respuesta;
    
}
