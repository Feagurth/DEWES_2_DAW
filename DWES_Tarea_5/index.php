<!DOCTYPE html>
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
        <meta charset="UTF-8">   
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

        $menu = crearMenu();
        
        // Asignamos el menú a la página
        $html->assign("menu", $menu);

        // Creamos una variable para almacenar el título de la página
        $titulo = "Gestión de documentos";

        // Asginamos el título a la página
        $html->assign("titulo", $titulo);

        // Verificamos el valor de navegación que obtenemos por GET
        if (isset($_GET["nav"])) {

            // Asignamos el valor de navegación a la página para que la 
            // plantilla pueda usarlo para mostrar u ocultar las subplantillas 
            // del diseño
            $html->assign("nav", $_GET["nav"]);

            // Verificamos el valor de navegación
            switch ($_GET["nav"]) {

                // Si es 1 es añadir una entrada
                case 1: {
                        // Comprobamos si en la información del POST de la página hay 
                        // información de algún destinatario. De no ser así, es la primera 
                        // carga de la página. En caso contrario, la carga es para validar 
                        // e insertar un registro.                        
                        if (!empty($_POST['dest'])) {
                            // Si es una insercción, volcamos los valores a insertar en 
                            // variables directamente desde el POST de la página
                            $nreg = $_POST['nreg'];
                            $tipodoc = $_POST['tipodoc'];
                            $fecha = $_POST['fentrada'];
                            $remit = $_POST['remit'];
                            $dest = $_POST['dest'];

                            // Hay que verificar si el POST trae valores para el checkbox 
                            // de escaneado, puesto que si solo aparece el valor on si el 
                            // checkbox ha sido marcado. Si no se ha marcado el checkbox, 
                            // el POST no trae información alguna. Le asignamos 1 en caso 
                            // de estar marcado y 0 si no lo está
                            $esc = (isset($_POST['esc']) ? "1" : "0");

                            // Creamos un array nuevo para almacenar posteriormente los 
                            // ficheros en objetos si es que los ubiese
                            $ficheros = array();


                            // Verificamos si está marcado el checkbox
                            if ($esc == 1 && isset($_FILES['addfile'])) {

                                // Comprobamos si hay información en los ficheros subidos al 
                                // servidor y si se ha producido algún error en la subida de 
                                // los mismos
                                if (isset($_FILES['addfile'])) {

                                    // Reordenamos los ficheros que hay en $_FILES para que 
                                    // nos sea más facil trabajar luego con ellos
                                    $archivos = ordenarFicheros($_FILES);


                                    // Recorremos todos los archivos para tratarlos
                                    foreach ($archivos as $file) {

                                        // Creamos un nuevo objeto fichero
                                        $fichero = new Fichero();

                                        // Le asignamos el nombre
                                        $fichero->setNombre($file['name']);

                                        // Le asignamos el tamaño
                                        $fichero->setTamanyo($file['size']);

                                        // Le asignamos el tipo
                                        $fichero->setTipo($file['type']);

                                        // Recuperamos la información del fichero con la función 
                                        // fopen especificando 'rb' como parámetro para que lea 
                                        // el fichero en binario, guardandolo en una variable 
                                        // tipo stream y lo asignamos al fichero
                                        $fichero->setDocumento(fopen($file['tmp_name'], 'rb'));

                                        // Almacenamos el fichero en el array
                                        $ficheros[] = $fichero;
                                    }
                                }
                            }

                            xdebug_break();

                            $registro = new Registro(array(
                                'id' => 0,
                                'nreg' => $nreg,
                                'tipo_reg' => 'E',
                                'tipodoc' => $tipodoc,
                                'fecha' => $fecha,
                                'remit' => $remit,
                                'dest' => $dest,
                                'esc' => sizeof($ficheros) > 0 ? 1 : 0
                            ));

                            $db = new DB();
                            
                            if ($registro->getEscaneado() === 0) {
                                $result = $db->insertarRegistro($registro);
                            } else {
                                
                                $result = $db->insertarRegistroFichero($registro, $ficheros);
                            }
                        }

                        // Para finalizar asignamos la fecha actual 
                        $html->assign("fechaahora", date('Y-m-d'));

                        // Calculamos el número de registro correspondiente 
                        // para la próxima entrada
                        $html->assign("nreg", calcularNreg("E"));


                        break;
                    }

                // Si es dos, es el listado de entradas
                case 2: {
                        try {
                            
                            $db = new DB();
                            // Realizamos una consulta a la base de datos para 
                            // recuperar las entradas
                            $datos = $db->listarEntradas();

                            // Asignamos el resultado al html para que se use 
                            // en la subplantilla adecuada
                            $html->assign("entradas", $datos);
                        } catch (Exception $ex) {
                            // En caso de error, limpiamos el valor de los datos
                            unset($datos);
                        }

                        break;
                    }
                // Si es 3 es añadir una salida
                case 3: {
                        // Recuperamos la fecha actual y la pasamos a 
                        // la asignamos                    
                        $html->assign("fechaahora", date('Y-m-d'));

                        // Calculamos el número de registro correspondiente 
                        // para la próxima salida
                        $html->assign("nreg", calcularNreg("S"));

                        break;
                    }
                // Si es cuatro, es el listado de salidas
                case 4: {
                        try {
                            
                            $db = new DB();
                            // Realizamos una consulta a la base de datos para 
                            // recuperar las entradas
                            $datos = $db->listarSalidas();

                            // Asignamos el resultado al html para que se use 
                            // en la subplantilla adecuada
                            $html->assign("salidas", $datos);
                        } catch (Exception $ex) {
                            // En caso de error, limpiamos el valor de los datos
                            unset($datos);
                        }

                        break;
                    }
            }
        } else {
            // En caso de que no haya valor de navegación, asignamos un 0
            $html->assign("nav", 0);
        }

        $html->display("index.tpl");
        ?>
    </body>
</html>
