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

// Comprobamos si se introducido un usuario 
if (!isset($_SERVER['PHP_AUTH_USER'])) {
    
    // Pedimos usuario y contraseña
    header('WWW-Authenticate: Basic realm="Mi aplicación"');
    header('HTTP/1.0 401 Unauthorized');
    
    // Si el usuario pulsa cancelar, mostramos un mensaje y cerramos la aplicación
    echo 'Debe hacer login para poder acceder a las aplicación';
    exit;
} else {
    
    // Creamos una nueva instancia de la base de datos
    $db = new DB();
    
    // Validamos el usuario introducido contra la base de datos
    if ($db->validarUsuario($_SERVER['PHP_AUTH_USER'], md5($_SERVER['PHP_AUTH_PW']))) {

        // Comprobamos si hay valores de visitas anteriores en las cookies
        if (isset($_COOKIE['visitas'])) {
            
            // Si las hay recuperamos los valroes de visitas y le añadimos 1
            $visitas = $_COOKIE['visitas'] +1 ;            
            
            // Almacenamos el nuevo valor en la cookie
            setcookie('visitas', $visitas);
            
            // Almacenamos la fecha actual en la cookie         
            setcookie('ultimavisita', date("d/m/Y"));
            
        } else {
            // Si no tenemos datos de visita anteriores grabamos en la cookie 
            // un 1 para la primera visita y un mensaje
            setcookie('visitas', "1");
            setcookie('ultimavisita', "Bienvenido!");
        }

        // Pasamos a index.php con header
        header("location:index.php");
    } else {
        
        // Pedimos usuario y contraseña
        header('WWW-Authenticate: Basic realm="My Realm"');
        header('HTTP/1.0 401 Unauthorized');
        
        // Si el usuario pulsa cancelar, mostramos un mensaje y cerramos la aplicación
        echo 'Debe hacer login para poder acceder a las aplicación';
        exit;
    }
}
