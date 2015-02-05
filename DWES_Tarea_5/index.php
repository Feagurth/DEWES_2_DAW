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
        <title></title>
    </head>
    <body>
        <?php
        require_once './configuracion.inc.php';
        require_once './db.php';

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

        $html->assign("menu", $menu);

        $titulo = "Gestión de documentos";

        $html->assign("titulo", $titulo);

        if (isset($_GET["nav"])) {

            $html->assign("navegacion", $_GET["nav"]);

            switch ($_GET["nav"]) {
                case 1: {
                        break;
                    }
                case 2: {

                        try {
                            $datos = DB::listarEntradas();

                            $html->assign("entradas", $datos);
                        } catch (Exception $ex) {
                            unset($datos);
                        }

                        break;
                    }
                case 3: {

                        break;
                    }
                case 4: {
                        try {
                            $datos = DB::listarSalidas();

                            $html->assign("salidas", $datos);
                        } catch (Exception $ex) {
                            unset($datos);
                        }

                        break;
                    }
            }
        } else {
            $html->assign("navegacion", 0);
        }

        $html->display("index.tpl");
        ?>
    </body>
</html>
