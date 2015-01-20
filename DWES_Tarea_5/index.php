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
            require_once('./configuracion.inc.php');
            
            $menu[0]["url"] = "entradas.php";
            $menu[0]["titulo"] = "Entradas";
            $menu[1]["url"] = "salidas.php";
            $menu[1]["titulo"] = "Salidas";
            
            $titulo = "Gestión de documentos";
            
            $html->assign("menu", $menu);
            $html->assign("titulo", $titulo);
            $html->display("index.tpl");
            
        ?>
    </body>
</html>
