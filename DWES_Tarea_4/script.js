/* 
 * Copyright (C) 2014 Luis Cabrerizo Gómez
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
 * Método que nos permite ocultar el control para añadir ficheros a la página
 * @param {type} valor Verdadero si queremos mostrar el control y falso si 
 * queremos ocultarlo
 * @returns {undefined}
 */
function mostrarOcultar(valor)
{
    // Comprobamos el valor del parámetro
    if (valor === false)
    {
        // Si es falso, ocultamos el control
        var boton = document.getElementById("addfile");
        boton.style.visibility = "hidden";
        boton.style.display = "none";                
    }
    else
    {
        // Si es verdero lo mostramos
        var boton = document.getElementById("addfile");
        boton.style.visibility = "visible";
        boton.style.display = "";
    }
}