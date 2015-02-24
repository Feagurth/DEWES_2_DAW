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

function getPVP($codProducto)
{
    $db = new DB();        
    
    return $db->getPVP($codProducto);
}

function getStock($codProducto, $codTienda)
{
    $db = new DB();        
        
    return $db->getStock($codProducto, $codTienda);
}

function getFamilias() {
    $db = new DB();        
        
    return $db->getFamilias();    
}

function getProductosFamilia($codFamilia){
    $db = new DB();        
        
    return $db->getProductosFamilia($codFamilia);
}


$uri="http://localhost/DWES_Tarea_6";
$server = new SoapServer(null,array('uri'=>$uri));

$server->addFunction("getPVP");
$server->addFunction("getStock");
$server->addFunction("getFamilias");
$server->addFunction("getProductosFamilia");

$server->handle();
