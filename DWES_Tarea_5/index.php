<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!--
Copyright (C) 2015 Luis Cabrerizo Gómez

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.
-->
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <!-- Cargamos el fichero de funciones Javascript. Hay que cargarlo con 
        la etiqueta <script> para que no de errores -->
        <script type="text/javascript" src="scripts.js"></script>

        <title></title>
    </head>
    <body>
        <?php
        // Instanciamos los ficheros de configuración y de objetos necesarios
        require_once './configuracion.inc.php';
        require_once './Db.php';
        require_once './Fichero.php';
        require_once './funciones.php';
        require_once './Registro.php';

        // Creamos el menú y lo asociamos a una variable
        $menu = crearMenu();

        // Asignamos el menú a la página
        $html->assign("menu", $menu);

        // Creamos una variable para almacenar el título de la página
        $titulo = "Gestión de documentos";

        // Asginamos el título a la página
        $html->assign("titulo", $titulo);

        // Verificamos el valor de navegación que obtenemos por GET
        if (isset($_POST["nav"])) {

            // Asignamos el valor de navegación a la página para que la 
            // plantilla pueda usarlo para mostrar u ocultar las subplantillas 
            // del diseño
            $html->assign("nav", $_POST["nav"]);

            // Verificamos el valor de navegación
            switch ($_POST["nav"]) {

                // Si es 1 es añadir una entrada
                case 1: {
                        try {
                            // Creamos un nuevo objeto de acceso a base de datos
                            $db = new DB();

                            // Obtenemos el listado de todas las personas
                            $personas = $db->listarPersonas();

                            // Las asignamos al html para poder pasarlas a la plantilla
                            $html->assign("personas", $personas);

                            // Comprobamos si en la información del POST de la página hay 
                            // información de algún destinatario y un remitente. De no ser 
                            // así, es la primera carga de la página. En caso contrario, 
                            // la carga es para validar e insertar un registro.                        
                            if (!empty($_POST['remit']) && !empty($_POST['dest'])) {
                                // Definimos un array para almacenar los ficheros subidos
                                $ficheros = array();

                                // Creamos una variable para almacenar el objeto registro
                                $registro;

                                // Creamos el objeto Registro y el array de objetos 
                                // Fichero necesarios para la insercción. Para esto, 
                                // usamos una función creada para tal fin, pasándole 
                                // estas variables y el literal S para especificar 
                                // un registros de salida
                                crearObjetosInserccionRegistro($registro, $ficheros, 'E');

                                // Verificamos si el registro tiene documentos asociados
                                if ($registro->getEscaneado() === 0) {
                                    // De no ser así, hacemos una inserción simple
                                    $result = $db->insertarRegistro($registro);
                                } else {
                                    // En caso contrario hacemos una insercción con fichero
                                    $result = $db->insertarRegistroFichero($registro, $ficheros);
                                }
                            }

                            // Para finalizar asignamos la fecha actual 
                            $html->assign("fechaahora", date('Y-m-d'));

                            // Calculamos el número de registro correspondiente 
                            // para la próxima entrada
                            $html->assign("nreg", calcularNreg("E"));
                        } catch (Exception $ex) {
                            
                        } finally {
                            unset($db);
                        }
                        break;
                    }

                // Si es dos, es el listado de entradas
                case 2: {
                        try {

                            $db = new DB();
                            // Realizamos una consulta a la base de datos para 
                            // recuperar las entradas
                            $datos = $db->listarEntradas();

                            // Comprobamos si en la información del POST hay 
                            // información de algún Identificador de registros, 
                            // lo que implicaría que alguien ha pulsado la lupa 
                            // para listarlos
                            if (isset($_POST['idr'])) {
                                // Listamos los documentos relacionados y los 
                                // almacenamos en una variable
                                $docs = $db->listarDocumentos($_POST['idr']);

                                // Los asignamos al html para que se use en la 
                                // subplantilla correspondiente
                                $html->assign("docs", $docs);
                            }

                            // Comprobamos si el POST trae información de 
                            // número de documento
                            if (isset($_POST['idd'])) {

                                // Recuperamos los datos relativos al fichero
                                $file = $db->recuperarDocumento($_POST['idd']);

                                // Verificamos si el fichero recuperado es un pdf, 
                                // que necesitará un tratamiento distinto
                                if (substr($file['tipo'], -3) === 'pdf') {
                                    // Creamos un fichero con nombre generico, 
                                    // pues al solo mostrarse un pdf a la vez, 
                                    // el fichero generado será machacado
                                    $filename = "dummy.pdf";

                                    //Grabamos el fichero
                                    if (grabarFichero($filename, $file['documento'])) {
                                        // Si se ha escrito correctamente 
                                        // asignamos el nombre del fichero 
                                        // al html para pasarlo a la plantilla
                                        $html->assign("filename", $filename);
                                    }
                                }

                                // Asignamos el contenido del fichero al 
                                // html para pasarlo a la plantilla
                                $html->assign("file", $file);
                            }

                            // Asignamos el resultado al html para que se use 
                            // en la subplantilla adecuada
                            $html->assign("entradas", $datos);
                        } catch (Exception $ex) {

                            // Limpiamos datos
                            unset($datos);
                        } finally {
                            // Limpiamos el objeto de base de datos
                            unset($db);
                        }

                        break;
                    }
                // Si es 3 es añadir una salida
                case 3: {
                        try {
                            
                            // Creamos un nuevo objeto de acceso a base de datos
                            $db = new DB();

                            // Obtenemos el listado de todas las personas
                            $personas = $db->listarPersonas();

                            // Las asignamos al html para poder pasarlas a la plantilla
                            $html->assign("personas", $personas);                            
                            
                            // Comprobamos si en la información del POST de la página hay 
                            // información de algún destinatario y un remitente. De no ser así, 
                            // es la primera carga de la página. En caso contrario, la 
                            // carga es para validar e insertar un registro.                        
                            if (!empty($_POST['remit']) && !empty($_POST['dest'])) {
                                // Definimos un array para almacenar los ficheros subidos
                                $ficheros = array();

                                // Creamos una variable para almacenar el objeto registro
                                $registro;

                                // Creamos el objeto Registro y el array de objetos 
                                // Fichero necesarios para la insercción. Para esto, 
                                // usamos una función creada para tal fin, pasándole 
                                // estas variables y el literal S para especificar 
                                // un registros de salida
                                crearObjetosInserccionRegistro($registro, $ficheros, 'S');


                                // Verificamos si el registro tiene documentos asociados
                                if ($registro->getEscaneado() === 0) {

                                    // De no ser así, hacemos una inserción simple
                                    $result = $db->insertarRegistro($registro);
                                } else {
                                    // En caso contrario hacemos una insercción con fichero
                                    $result = $db->insertarRegistroFichero($registro, $ficheros);
                                }
                            }

                            // Para finalizar asignamos la fecha actual 
                            $html->assign("fechaahora", date('Y-m-d'));

                            // Calculamos el número de registro correspondiente 
                            // para la próxima entrada
                            $html->assign("nreg", calcularNreg("S"));
                            
                        } catch (Exception $ex) {

                        } finally {
                            unset($db);
                        }
                        break;
                    }
                // Si es cuatro, es el listado de salidas
                case 4: {
                        try {

                            $db = new DB();
                            // Realizamos una consulta a la base de datos para 
                            // recuperar las salidas
                            $datos = $db->listarSalidas();

                            // Comprobamos si en la información del POST hay 
                            // información de algún Identificador de registros, 
                            // lo que implicaría que alguien ha pulsado la lupa 
                            // para listarlos
                            if (isset($_POST['idr'])) {
                                // Listamos los documentos relacionados y los 
                                // almacenamos en una variable
                                $docs = $db->listarDocumentos($_POST['idr']);

                                // Los asignamos al html para que se use en la 
                                // subplantilla correspondiente
                                $html->assign("docs", $docs);
                            }

                            // Comprobamos si el POST trae información de 
                            // número de documento
                            if (isset($_POST['idd'])) {

                                // Recuperamos los datos relativos al fichero
                                $file = $db->recuperarDocumento($_POST['idd']);

                                // Verificamos si el fichero recuperado es un pdf, 
                                // que necesitará un tratamiento distinto
                                if (substr($file['tipo'], -3) === 'pdf') {
                                    // Creamos un fichero con nombre generico, 
                                    // pues al solo mostrarse un pdf a la vez, 
                                    // el fichero generado será machacado
                                    $filename = "dummy.pdf";

                                    //Grabamos el fichero
                                    if (grabarFichero($filename, $file['documento'])) {
                                        // Si se ha escrito correctamente 
                                        // asignamos el nombre del fichero 
                                        // al html para pasarlo a la plantilla
                                        $html->assign("filename", $filename);
                                    }
                                }

                                // Asignamos el contenido del fichero al 
                                // html para pasarlo a la plantilla
                                $html->assign("file", $file);
                            }

                            // Asignamos el resultado al html para que se use 
                            // en la subplantilla adecuada
                            $html->assign("salidas", $datos);
                        } catch (Exception $ex) {

                            // Limpiamos datos
                            unset($datos);
                        } finally {
                            // Limpiamos el objeto de base de datos
                            unset($db);
                        }

                        break;
                    }
                // Si es cinco, es listado de personas
                case 5: {
                        try {
                            // Creamos un objeto de base de datos
                            $db = new DB();

                            // Verificamos si los datos de POST contienen nombre, 
                            // lo que indicaría una insercción
                            if (isset($_POST['nombre'])) {
                                // Creamos un objeto persona usando la función 
                                // auxiliar creada para tal fin
                                $persona = crearObjetosInserccionPersona();

                                // Insertamos los datos en la base de datos
                                $db->insertarPersona($persona);
                            }

                            // Verificamos si los datos de POST contienen un 
                            // identificador de persona. De ser así, indicaría un 
                            // borrado
                            if (isset($_POST['idp'])) {
                                // Eliminamos la información de la persona de la base de datos
                                $db->eliminarPersona($_POST['idp']);
                            }

                            // Realizamos una consulta a la base de datos para 
                            // recuperar las personas
                            $datos = $db->listarPersonas();

                            // Asignamos el resultado al html para que se use 
                            // en la subplantilla adecuada                            
                            $html->assign("personas", $datos);
                        } catch (Exception $ex) {
                            unset($datos);
                        } finally {
                            unset($db);
                        }

                        break;
                    }
            }
        } else {
            // En caso de que no haya valor de navegación, asignamos un 0
            $html->assign("nav", 0);
        }        
        
        // Comprobamos si tenemos asignada la variable que contiene las excepciónes 
        // producidas en la aplicación
        if(isset($ex))
        {
            // Si la variable contiene algún valor, la asignamos al motor Smarty
            $html->assign("error", $ex);
            $html->assign("emailadmin", $emailAdmin);
        }

        // Mostramos en el motor Smarty la plantilla de la página principal
        $html->display("index.tpl");
        ?>
    </body>
</html>
