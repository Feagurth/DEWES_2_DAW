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

require_once './Db.php';

try {
    // Inicializamos variables
    $error = "";

    // Recuperamos los valores del modo 
    $modo = $_GET['modo'];

    // Recuperamos el id
    $id_usuario = $_GET['id'];

    // Creamos un nuevo objeto de acceso a base de datos
    $db = new DB();

    // Comprobamos el tipo de petición
    switch ($modo) {

        case "E": {
                // Eliminamos el usuario usando la función adecuada y 
                // pasándo su id como parámetro
                $db->eliminarUsuario($id_usuario);
                
                // Comentamos el brek para que tras una eliminación de usuarios 
                // se ejecute la recuperación de usuarios y sea esa información 
                // la que enviemos a procesar
                //break;
            }

        case "V": {
                $datos = $db->listarUsuarios();

                // Especificamos las cabeceras para que devuelvan en formato JSON
                header('Content-Type: application/json');

                // Devolvemos el objeto serializado y codificado en formato JSON
                echo json_encode($datos);
            }
    }
} catch (Exception $ex) {
    // Recuperamos el mensaje de error
    $error = $ex->getMessage();

    // Especificamos las cabeceras para que devuelvan en formato JSON
    header('Content-Type: application/json');

    // Devolvemos el error
    echo $error;
}
