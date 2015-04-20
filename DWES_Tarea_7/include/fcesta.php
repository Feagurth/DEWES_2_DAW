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
require_once('CestaCompra.php');
require_once('DB.php');

// Iniciamos la sesión para poder trabajar con la cesta de la compra
session_start();

// Creamos un nuevo objeto xajax con el que trabajar
$xajax = new xajax();

// Registramos las funciones que usaremos para las peticiones ajax
$xajax->register(XAJAX_FUNCTION, "limpiarCesta");
$xajax->register(XAJAX_FUNCTION, "anadirArticulo");
$xajax->register(XAJAX_FUNCTION, "mostrarCesta");

// Damos orden de procesar las peticiones
$xajax->processRequest();

/**
 * Función que nos permite limpiar la cesta de compra y mostrarla en la página
 * @return \xajaxResponse Contenido HTML con la información de la cesta para 
 * mostrar en la página
 */
function limpiarCesta() {

    // Creamos un objeto xajaxResponse que será el encargado de contener la 
    // respuesta a la petición de limpiar la cesta de compra
    $respuesta = new xajaxResponse();

    // Eliminamos la cesta de la sesión
    unset($_SESSION['cesta']);

    // Creamos un nuevo objeto cesta que estará vacío por defecto
    $canasto = new CestaCompra();

    // Y le asignamos una nueva cesta de la compra que estará vacía por defecto
    $_SESSION['cesta'] = $canasto;

    // Usamos la función de apoyo para formatear el resultado en HTML
    $salida = formatearCesta($canasto);

    // Asignamos el resultado como el contenido html del objeto con id cesta
    $respuesta->assign('cesta', 'innerHTML', $salida);

    // Devolvemos la respuesta
    return $respuesta;
}

/**
 * Función que nos permite añadir un artículo a la cesta y mostrarla en la página
 * @param String $codArticulo Código del artículo a añadir a la cesta
 * @return \xajaxResponse Contenido HTML con la información de la cesta para 
 * mostrar en la página
 */
function anadirArticulo($codArticulo) {

    // Creamos un nuevo objeto cesta
    $canasto = new CestaCompra();

    // Comprobamos si en sesión tenemos alguna cesta almacenada
    if (isset($_SESSION['cesta'])) {
        // Si es así, guardamos la cesta almacenada en sesioón en el objeto 
        // recién creado, para poder continuar añadiendo objetos a esa cesta
        $canasto = $_SESSION['cesta'];
    }

    // Añadimos un nuevo artículo a la cesta usando la función adecuada 
    // pasándole el código del artículo
    $canasto->nuevo_articulo($codArticulo);

    // Guardamos la cesta en la sesión
    $canasto->guarda_cesta();

    // Creamos un objeto xajaxResponse que será el encargado de contener la 
    // respuesta a la petición de añadir un nuevo artículo
    $respuesta = new xajaxResponse();

    // Usamos la función de apoyo para formatear el resultado en HTML
    $salida = formatearCesta($canasto);

    // Asignamos el resultado como el contenido html del objeto con id cesta
    $respuesta->assign('cesta', 'innerHTML', $salida);

    //Devolvemos la respuesta
    return $respuesta;
}

/**
 * Función que nos permite mostrar mostrar una cesta formateada
 * @return \xajaxResponse Contenido HTML con la información de la cesta para 
 * mostrar en la página
 */
function mostrarCesta() {

    // Creamos un nuevo objeto cesta
    $canasto = new CestaCompra();

    // Comprobamos si en sesión tenemos alguna cesta almacenada
    if (isset($_SESSION['cesta'])) {
        // Si es así, guardamos la cesta almacenada en sesioón en el objeto 
        // recién creado, para poder continuar añadiendo objetos a esa cesta
        $canasto = $_SESSION['cesta'];
    }

    // Creamos un objeto xajaxResponse que será el encargado de contener la 
    // respuesta a la petición de añadir un nuevo artículo
    $respuesta = new xajaxResponse();

    // Usamos la función de apoyo para formatear el resultado en HTML
    $salida = formatearCesta($canasto);

    // Asignamos el resultado como el contenido html del objeto con id cesta
    $respuesta->assign('cesta', 'innerHTML', $salida);

    //Devolvemos la respuesta
    return $respuesta;
}

/**
 * Función que nos permite dar un formato HTML a una cesta para posteriormente 
 * hacerla visible en un html
 * @param object $cesta Cesta a formatear
 * @return string HTML con el contenido de la cesta y los botones necesarios
 */
function formatearCesta($cesta) {

    // Inicializamos una variable de salida
    $salida = "";

    // Concatenamos el resultado en html de la cesta vacia
    $salida .= "<h3><img src='cesta.png' alt='Cesta' width='24' height='21'> Cesta</h3>";
    $salida .= "<hr />";
    $salida .= $cesta->muestra();
    $salida .= "<form id='vaciar' onclick='limpiarCesta();'>";
    $salida .= "<input type='button' name='vaciar' value='Vaciar Cesta'";

    // Verificamos si la cesta está vacía
    if ($cesta->vacia()) {
        // Si lo está, deshabilitamos el bóton de vaciar la cesta
        $salida .= "disabled='true'";
    }

    $salida .= "/></form>";
    $salida .= "<form id='comprar' action='cesta.php' method='post'>";
    $salida .= "<input type='submit' name='comprar' value='Comprar'";

    // Verificamos si la cesta está vacía
    if ($cesta->vacia()) {
        // Si lo está, deshabilitamos el bóton de comprar
        $salida .= "disabled='true'";
    }

    // Terminamos de formatear la salida
    $salida .= "/></form>";

    // Y devolvemos la cadena
    return $salida;
}
