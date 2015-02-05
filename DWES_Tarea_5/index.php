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
        require_once './db.php';

        // Creamos un array para representar el menú desplegable
        $submenu0[0]["navegacion"] = "1";
        $submenu0[0]["titulo"] = "Nueva Entrada";
        $submenu0[1]["navegacion"] = "2";
        $submenu0[1]["titulo"] = "Ver Entradas";

        $menu[0]["titulo"] = "Entradas";
        $menu[0]["submenu"] = $submenu0;

        $submenu1[0]["navegacion"] = "3";
        $submenu1[0]["titulo"] = "Nueva Salida";
        $submenu1[1]["navegacion"] = "4";
        $submenu1[1]["titulo"] = "Ver Salidas";

        $menu[1]["titulo"] = "Salidas";
        $menu[1]["submenu"] = $submenu1;

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

                        // Recuperamos la fecha actual y la pasamos a 
                        // la asignamos
                        $html->assign("fechaahora", date('Y-m-d'));

                        break;
                    }

                // Si es dos, es el listado de entradas
                case 2: {
                        try {
                            // Realizamos una consulta a la base de datos para 
                            // recuperar las entradas
                            $datos = DB::listarEntradas();

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

                        break;
                    }
                // Si es cuatro, es el listado de salidas
                case 4: {
                        try {
                            // Realizamos una consulta a la base de datos para 
                            // recuperar las entradas
                            $datos = DB::listarSalidas();

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
