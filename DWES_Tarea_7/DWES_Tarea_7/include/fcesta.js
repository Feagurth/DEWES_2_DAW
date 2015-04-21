
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

/**
 * Functión syncrona que nos permite limpiar la cesta de la compra
 * @returns {Boolean|xajax.request|respuesta}
 */
function limpiarCesta()
{
    // Realizamos una petición ajax sobre la función limpiarCesta del 
    // fichero fcesta.php en modo síncrono
    var respuesta = xajax.request({xjxfun: "limpiarCesta"}, {mode: 'synchronous'});

    // Devolvemos el resultado de la petición
    return respuesta;
}

/**
 * Functión que nos permite añadir un artículo a la cesta de la compra
 * @param {String} codigo Código del artículo a añadir a la cesta
 * @returns {Boolean|xajax.request}
 */
function anadirArticulo(codigo)
{
    // Realizamos una petición ajax sobre la función añadirArticulo del 
    // fichero fcesta.php en modo síncrono pasándole como parámetro el código 
    // del artículo a añadir a la cesta de la compra
    var respuesta = xajax.request({xjxfun: "anadirArticulo"}, {mode: 'synchronous', parameters: [codigo]});

    // Devolvemos el resultado de la petición
    return respuesta;

}

/**
 * Función que nos permite mostrar la cesta de la compra
 * @returns {Boolean|xajax.request}
 */
function mostrarCesta()
{
    // Realizamos una petición ajax sobre la función mostrarCesta del 
    // fichero fcesta.php en modo síncrono
    var respuesta = xajax.request({xjxfun: "mostrarCesta"}, {mode: 'synchronous'});

    // Devolvemos el resultado de la petición
    return respuesta;
}