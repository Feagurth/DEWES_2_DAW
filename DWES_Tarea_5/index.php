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

            $submenu0[0]["url"] ="nuevaentrada.php";
            $submenu0[0]["titulo"] ="Nueva Entrada";            
            $submenu0[1]["url"] ="verentradas.php";
            $submenu0[1]["titulo"] ="Ver Entradas";            
                        
            $menu[0]["titulo"] = "Entradas";
            $menu[0]["submenu"] = $submenu0;
            
            $submenu1[0]["url"] ="nuevasalida.php";
            $submenu1[0]["titulo"] ="Nueva Salida";            
            $submenu1[1]["url"] ="versalidas.php";
            $submenu1[1]["titulo"] ="Ver Salidas";

            $menu[1]["titulo"] = "Salidas";
            $menu[1]["submenu"] = $submenu1;
            
            $entradas[0]["id"] = "1";
            $entradas[0]["nregistro"] = "2014/2015-001";
            $entradas[0]["tipodoc"] = "uiuiui";
            $entradas[0]["fentrada"] = "06/12/2014";
            $entradas[0]["remitente"] = "uuuu";
            $entradas[0]["destinatario"] = "uuu";
            $entradas[0]["escaneado"] = "1";
            
            $entradas[1]["id"] = "2";
            $entradas[1]["nregistro"] = "2014/2015-002";
            $entradas[1]["tipodoc"] = "fsdfsd";
            $entradas[1]["fentrada"] = "07/12/2014";
            $entradas[1]["remitente"] = "gter";
            $entradas[1]["destinatario"] = "32ffwe";
            $entradas[1]["escaneado"] = "0";


            
            $titulo = "Gestión de documentos";
            
            $html->assign("entradas", $entradas);
            
            $html->assign("menu", $menu);
            $html->assign("titulo", $titulo);
            $html->display("index.tpl");
            
        ?>
    </body>
</html>
