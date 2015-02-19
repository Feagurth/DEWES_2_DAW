<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
            <!-- Cargamos el fichero de funciones Javascript. Hay que cargarlo con 
            la etiqueta <script> para que no de errores -->
            <script type="text/javascript" src="scripts.js"></script>
            <title>Login</title>
    </head>
    <body>
        <?php
        
        // Iniciamos sesión
        session_start();        
        require_once './configuracion.inc.php';
        require_once './Db.php';

        $error = " ";

        if (isset($_POST['user']) && isset($_POST['pass'])) {
            // Creamos un nuevo objeto de acceso a base de datos
            $db = new DB();

            // Obtenemos el listado de todas las personas
            if ($db->validarUsuario(md5($_POST['user']), md5($_POST['pass']))) {
                // Guardamos el hash del usuario y del password en sesión
                $_SESSION['user'] = md5($_POST['user']);
                $_SESSION['pass'] = md5($_POST['pass']);
                
                unset($_POST['user']);
                unset($_POST['pass']);
                
                header("location:index.php");
            }
            else {
                $error = "Usuario o contraseña incorrectos";
            }
        }

        if (isset($_POST['error'])) {
            $error = $_POST['error'];
        }


        $html->assign('error', $error);

        // Mostramos en el motor Smarty la plantilla de la página principal
        $html->display("login.tpl");
        ?>
    </body>
</html>