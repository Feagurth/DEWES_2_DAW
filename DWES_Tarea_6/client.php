<?php

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

require_once './db.php';

$url="http://localhost/DWES_Tarea_6/server.php";
$uri="http://localhost/DWES_Tarea_6";

$cliente = new SoapClient(null,array('location'=>$url,'uri'=>$uri));
 
$pvp = $cliente->getPVP('PS3320GB');
$stock = $cliente->getStock('PS3320GB', '1');
$familias = $cliente->getFamilias();
$productosFamilias = $cliente->getProductosFamilia('CONSOL');


//$db = new DB();
//$familias = $db->getFamilias();


print("El pvp es ".$pvp);
print("<br />El stock es ".$stock);
print("<br />Las familias son <br />");
print_r(array_values($familias));
print("<br />Los productos de la familia 'CONSOL' son <br />");
print_r(array_values($productosFamilias));


