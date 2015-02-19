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
    // Realizamos un post a la página descarga.php, pasando el id del documento 
    // como parámetro
    post('descarga.php', {idd: id_documento});
}

function eliminarPersona(id_persona)
{
    // Pedimos la confirmación por parte del usuario para el borrado
    if (confirm("¿Desea eleminar la persona?"))
    {
        // Hacemos uso de la funcion post y enviamos los datos 
        // necesarios para eliminar una persona
        post('index.php', {nav: 5, idp: id_persona});
    }
}

/**
 * Función para validar una cadena mediante expresiones regulares
 * @param {type} cadena Cadena a validar
 * @returns {Array} Resultado de la validación
 */
function validarCadena(cadena)
{
    // Validamos el nombre introducido usando expresiones regulares 
    // y devolvemos el resultado
    return new RegExp("^[a-zA-ZñÑáÁéÉíÍóÓúÚ ]+$").exec(cadena);
}


/**
 * Función para validar los datos de una persona antes de insertarlos en la base 
 * de datos
 * @returns {Boolean} True si son validos, False en caso contrario
 */
function validarEnvioPersona()
{
    // Creamos una variable de control y la inicializamos a verdadero
    var salida = true;

    // Verificamos que el campo no venga vacio
    if (validarCadena(document.getElementById("nombre").value))
    {
        // Si no viene vacio, verificamos el contenido
        if (!validarCadena(document.getElementById("nombre").value))
        {
            // Si no es válido, cambiamos el valor de la variable y añadimos la clase error al objeto input
            salida = false;
            document.getElementById("nombre").className = "error";
        }
        else
        {
            // Si la validación es correcta, quitamos la clase de error que 
            // hayamos podido poner anteriormente
            document.getElementById("nombre").className = "";
        }
    }
    else
    {
        // Si viene vacio, cambiamos la variable a devolver a false y le 
        // cambiamos la clase
        document.getElementById("nombre").className = "error";
        salida = false;
    }

    // Verificamos que el campo no venga vacio
    if (validarCadena(document.getElementById("apellido1").value))
    {
        // Si no viene vacio, verificamos el contenido
        if (!validarCadena(document.getElementById("apellido1").value))
        {
            // Si no es válido, cambiamos el valor de la variable y añadimos la clase error al objeto input
            salida = false;
            document.getElementById("apellido1").className = "error";
        }
        else
        {
            // Si la validación es correcta, quitamos la clase de error que 
            // hayamos podido poner anteriormente
            document.getElementById("apellido1").className = "";
        }
    }
    else
    {
        // Si viene vacio, cambiamos la variable a devolver a false y le 
        // cambiamos la clase
        document.getElementById("apellido1").className = "error";
        salida = false;
    }

    // Comprobamos que el campo de apellidos contiene datos
    if (document.getElementById("apellido2").value)
    {
        // Verificamos el segundo apellido
        if (!validarCadena(document.getElementById("apellido2").value))
        {
            // Si no es válido, cambiamos el valor de la variable y añadimos la clase error al objeto input
            salida = false;
            document.getElementById("apellido2").className = "error";
        }
        else
        {
            // Si la validación es correcta, quitamos la clase de error que 
            // hayamos podido poner anteriormente
            document.getElementById("apellido2").className = "";
        }
    }
    else
    {
        // Si el campo de segundo apellido viene vacio, es correcto, por tanto 
        // quitamos la clase de error que hayamos podido poner anteriormente
        document.getElementById("apellido2").className = "";

    }

    // Devolvemos el resultado
    return salida;
}

/**
 * Función para validar los datos de un registro antes de insertarlos en la base 
 * de datos
 * @returns {Boolean} True si son validos, False en caso contrario
 */
function validarEnvioRegistro()
{
    // Creamos una variable de control y la inicializamos a verdadero
    var salida = true;

    // Validamos si el desplegable de remitente tiene un valor seleccionado
    if (!document.getElementById("remit").value)
    {
        // Si no se ha selecionado ninguno, marcamos la variable de salida 
        // como falsa y añadimos la clase error a los objetos        
        salida = false;
        document.getElementById("remit").className = "error";
    }
    else
    {
        // Si la validación es correcta, quitamos la clase de error que 
        // hayamos podido poner anteriormente            
        document.getElementById("remit").className = "";
    }

    // Validamos si el desplegable de destinatario tiene un valor seleccionado
    if (!document.getElementById("dest").value)
    {
        // Si no se ha selecionado ninguno, marcamos la variable de salida 
        // como falsa y añadimos la clase error a los objetos        
        salida = false;
        document.getElementById("dest").className = "error";
    }
    else
    {
        // Si la validación es correcta, quitamos la clase de error que 
        // hayamos podido poner anteriormente            
        document.getElementById("dest").className = "";
    }

    // Verificamos que el campo no venga vacio
    if (document.getElementById("tipodoc").value)
    {
        // Si contiene texto, verificamos que el texto no contenga caracteres inválidos
        if (!validarCadena(document.getElementById("tipodoc").value))
        {
            // Si no es válido, cambiamos el valor de la variable y añadimos la clase error al objeto input
            salida = false;
            document.getElementById("tipodoc").className = "error";
        }
        else
        {
            // Si la validación es correcta, quitamos la clase de error que 
            // hayamos podido poner anteriormente
            document.getElementById("tipodoc").className = "";
        }
    }
    else
    {
        // Si viene vacio, cambiamos la variable a devolver a false y le 
        // cambiamos la clase
        salida = false;
        document.getElementById("tipodoc").className = "error";
    }

    // Comprobamos si se ha marcado el checkbox para insertar ficheros
    if (document.getElementById("esc").checked === true)
    {
        // Si se ha marcado, comprobamos que se ha seleccionado alguno
        if (!document.getElementById("addfile").value)
        {
            // Si no se ha selecionado ninguno, marcamos la variable de salida 
            // como falsa y añadimos la clase error a los objetos
            salida = false;
            document.getElementById("addfile").className = "error";
        }
        else
        {
            // Si la validación es correcta, quitamos la clase de error que 
            // hayamos podido poner anteriormente            
            document.getElementById("addfile").className = "";
        }
    }

    // Devolvemos el resultado
    return salida;
}


/**
 * Función que nos permite validar los datos introducidos por el usuario para 
 * hacer login y enviar los datos para validar
 * @returns {undefined} 
 */
function validarLogin()
{
    
    // Recuperamos el botón de envio de datos
    var boton = document.getElementById('submit');
    
    // Lo deshabilitamos
    boton.disabled = true;
    
    // Le cambiamos el texto
    boton.value = 'Enviado...';
    
    // Iniciamos una variable para controlar la validación de los datos
    var validado = true;
    
    // Validamos el usuario
    if(!validarUsuario(document.getElementById('user').value))
    {
        // Si no es correcto, cambiamos el valor de la variable de validación
        validado = false;
    }
    
    // Validamos el password
    if(!validarPassword(document.getElementById('pass').value))
    {
        // Si no es correcto, cambiamos el valor de la variable de validación
        validado = false;
    }    
    
    // Verificamos que la validación sea correcta
    if(validado)
    {
        // Si es correcta, hacemos un post con la información de usuario y del password
        post('login.php', {user: document.getElementById('user').value, pass: document.getElementById('pass').value} , 'post');
    }
    else
    {
        // Si no es correcta, hacemos un post enviando información de error
        post('login.php', {error: 1} , 'post');
    }

}

/**
 * Función que nos permite validar una cadena de texto que representa un usuario 
 * para que solo contenga carácteres válidos
 * @param {type} valor Cadena a validar
 * @returns {Array} True si la validación es correcta, False en caso contrario
 */
function validarUsuario(valor)
{
    // Validamos que solo puedan introducirse letras, en mayuscula o minúscula, 
    // con y sin acentos y espacios en blanco
    expresion = /^[a-zA-ZñÑ0-9_]+$/;

    return expresion.exec(valor);
}

/**
 * Función que nos permite validar una cadena de texto que representa un usuario 
 * para que solo contenga carácteres válidos
 * @param {type} valor Cadena a validar
 * @returns {Array} True si la validación es correcta, False en caso contrario
 */
function validarPassword(valor)
{
    // Validamos que solo puedan introducirse letras, en mayuscula o minúscula, 
    // con y sin acentos y espacios en blanco
    expresion = /^[a-zA-ZñÑ0-9_!¡?¿#~.]+$/;

    return expresion.exec(valor);
}

function logout()
{    
    alert('Pendiente codificación');
}