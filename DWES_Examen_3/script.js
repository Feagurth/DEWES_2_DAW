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
$('document').ready(inicio);

/**
 * Función que nos permite asignar eventos a la página en su primera ejecución
 * @returns {undefined}
 */
function inicio() {

    // Asignamos una función al evento click del botón de cancelar
    $("#tabla").off("click", "a").on("click", "a", eliminarUsuario);
}


/**
 * Función que nos permite eliminar un usuario de la base de datos mediante una petición AJAX
 * @returns {Boolean}
 */
function eliminarUsuario()
{
    // Recuperamos el usuario
    id_usuario = this.id;

    // Pedimos confirmación
    if (confirm("¿Desea borrar el registro?"))
    {

        // Si lo es, hacemos una petición AJAX a la página de mensajes de email detalle
        $.ajax({
            // La hacemos por post
            type: "GET",
            // sin cache
            cache: false,
            // Especificamos la url donde se dirigirá la petición
            url: "index_msg.php",
            // Especificamos los datos que pasaremos como parámetros en el post
            data: " id=" + id_usuario
                    + "&modo=E",
            // Definimos el tipo de datos que se nos va a devolver
            dataType: "json",
            // Definimos que hacer en caso de petición exitosa
            success: function (data) {

                // Si tenemos éxito con la petición, buscamos el cuerpo de la tabla
                var tabla = document.getElementById('tabla').getElementsByTagName('tbody')[0];

                // Iteramos por todos los hijos que hay en el cuerpo de la tabla
                while (tabla.hasChildNodes())
                {
                    // Eliminamos el primer hijo a cada iteración
                    tabla.removeChild(tabla.firstChild);
                }

                
                // Una vez está limpio el cuerpo de la tabla iteramos 
                // por los datos recuperados
                for (fila in data)
                {
                    // Creamos una nueva fila a insertar
                    var row = tabla.insertRow(0);

                    // Definimos sus columnas
                    var celda1 = row.insertCell(0);
                    var celda2 = row.insertCell(1);
                    var celda3 = row.insertCell(2);
                    var celda4 = row.insertCell(3);
                    var celda5 = row.insertCell(4);
                    var celda6 = row.insertCell(5);
                    var celda7 = row.insertCell(6);
                    var celda8 = row.insertCell(7);

                    // Llenamos las celdas con contenido
                    celda1.innerHTML = data[fila].id;
                    celda2.innerHTML = data[fila].usuario;
                    celda3.innerHTML = data[fila].password;
                    celda4.innerHTML = data[fila].nombre;
                    celda5.innerHTML = data[fila].ap1;
                    celda6.innerHTML = data[fila].ap2;
                    celda7.innerHTML = data[fila].tfno;
                    celda8.innerHTML = "<a id='" + data[fila].id +"' href='index.php?id=" + data[fila].id + "&modo=e'>Borrar</a>";
                }
            },
            // Definimos que hacer en caso de error
            error: function (jqXHR, textStatus, errorThrown) {

                // Creamos una cadena con el mensaje de respuesta
                var cadena = "<p>" + jqXHR.responseText + "</p>";

                // Lo ponemos en el div para mensajes de error
                $(".error p").replaceWith(cadena);
            }
        });
    }

    // Devolvemos false siempre, para que no se carge ninguna página
    return false;
}