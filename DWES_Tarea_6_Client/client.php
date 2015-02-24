<!DOCTYPE html>
<!--
Copyright (C) 2015 PC

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
        $url = "http://localhost/dwes/ut6/client.php";
        $uri = "http://localhost/dwes/ut6";
        $cliente = new SoapClient(null, array('location' => $url, 'uri' => $uri));

        $suma = $cliente->suma(2, 3);
        $resta = $cliente->resta(2, 3);
        print("La suma es " . $suma);
        print("<br />La resta es " . $resta);
        ?>
    </body>
</html>
