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

/**
 * Método que nos permite realizar un envio de información al servidor
 * @param {type} path Ruta a donde vamos a enviar la información
 * @param {type} params Parametros a enviar
 * @param {type} method Método de envio: POST (default) o GET
 * @returns {undefined}
 */
function post(path, params, method) {
    // Definimos el método post como por defecto
    method = method || "post";

    // Creamos un elemento form en el documento y lo almacenamos en una variable
    var form = document.createElement("form");

    // Le ponemos como atributo el método y la ruta
    form.setAttribute("method", method);
    form.setAttribute("action", path);

    // Iteramos por todos los valores del array de parámetros
    for (var key in params) {

        // Comprobamos que tenga una propiedad propia
        if (params.hasOwnProperty(key)) {

            // Si es así, creamos un campo oculto y le añadimos como nombre la 
            // clave del array y como valor el contenido del mismo
            var hiddenField = document.createElement("input");
            hiddenField.setAttribute("type", "hidden");
            hiddenField.setAttribute("name", key);
            hiddenField.setAttribute("value", params[key]);

            // Finalmente lo añadimos al formulario
            form.appendChild(hiddenField);
        }
    }

    // Finalmente añadimos el formulario al cuerpo de la página web desde 
    // donde se esté llamando
    document.body.appendChild(form);

    // Y se envía
    form.submit();
}

/**
 * Método para navegar entre los distintos menús de la página
 * @param {type} valorNavegacion Valor de navegación
 * @returns {undefined}
 */
function navegar(valorNavegacion)
{
    // Hacemos uso de la funcion post y enviamos los datos 
    // necesarios para navegar
    post('index.php', {nav: valorNavegacion});
}

/**
 * Función para listar los archivos relacionados con un registro
 * @param {type} valorNavegacion Valor de navegación
 * @param {type} id_registro Id del registro con archivos
 * @returns {undefined}
 */
function listarFichero(valorNavegacion, id_registro)
{
    // Hacemos uso de la funcion post y enviamos los datos 
    // necesarios para navegar    
    post('index.php', {nav: valorNavegacion, idr: id_registro});
}

/**
 * Función para poder mostrar los ficheros almacenados en la base de datos
 * @param {type} valorNavegacion Valor de navegación
 * @param {type} id_registro Id del registro con archivos
 * @param {type} id_documento Id del documento a mostrar
 * @returns {undefined}
 */
function mostrarFichero(valorNavegacion, id_registro, id_documento)
{
    // Hacemos uso de la funcion post y enviamos los datos 
    // necesarios para navegar    
    post('index.php', {nav: valorNavegacion, idr: id_registro, idd: id_documento});
}

/**
 * Función que nos permite descargar un fichero desde la base de datos
 * @param {type} id_documento Id del documento  a descargar
 * @returns {undefined}
 */
function descargarFichero(id_documento)
{
    // Realizamos un posta la página descarga.php, pasando el id del documento 
    // como parámetro
    post('descarga.php', {idd: id_documento});    
}