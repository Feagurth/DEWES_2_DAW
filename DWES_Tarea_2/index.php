<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!--
Copyright (C) 2014 Luis Cabrerizo Gómez

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
            <title>DWES_Tarea_2</title>
            <link type="text/css" rel="stylesheet" href="estilos.css" />
    </head>
    <body>
        <?php $agenda; ?>
        <table>
            <tr>
                <td>
                    <table class="borde">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Teléfono</th>                    
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (!empty($_POST['array'])) {
                                $agenda = unserialize($_POST['array']);
                            }
                            
                            if (!empty($_POST['nombre'])) {
                                $dato_nombre = $_POST['nombre'];
                                $dato_tlf = $_POST['tlf'];

                                if (!empty($agenda)) {

                                    if (!in_array($dato_nombre, $agenda)) {
                                        if ($dato_tlf != "") {
                                            $agenda[$dato_nombre] = $dato_tlf;
                                        }
                                    }
                                    else
                                    {
                                        if($dato_tlf == "")
                                        {
                                            unset($agenda[$dato_nombre]);                                        
                                        }
                                        else
                                        {
                                            $agenda[$dato_nombre] = $dato_tlf;                                            
                                        }
                                    }
                                } else {
                                    $agenda[$dato_nombre] = $dato_tlf;
                                }

                                foreach ($agenda as $nombre => $tlf) {
                                    print "<tr>";
                                    print "<td class='borde'>";
                                    print $nombre;
                                    print "</td>";
                                    print "<td class='borde'>";
                                    print $tlf;
                                    print "</td>";
                                    print "</tr>";
                                }
                            } else {

                                $agenda = array();
                            }
                            ?>        
                        </tbody>            
                    </table>
                </td>
            </tr>
            <tr>
                <td>
                    <form name="input" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                        <table>
                            <tr>
                                <td>
                                    Nombre:
                                </td>
                                <td>
                                    <input type="text" name="nombre" />
                                </td>                                
                            </tr>
                            <tr>
                                <td>
                                    Teléfono: 
                                </td>
                                <td>
                                    <input type="tel" name="tlf" />
                                </td>

                            </tr>
                            <tr>
                                <td colspan="2">
                                    <input type='hidden' name='array' value="<?php echo htmlentities(serialize($agenda)); ?>" />
                                    <input type="submit" value="Enviar" name="enviar"/>
                                </td>
                            </tr>

                        </table>                        
                    </form>
                </td>
            </tr>
        </table>
    </body>
</html>
