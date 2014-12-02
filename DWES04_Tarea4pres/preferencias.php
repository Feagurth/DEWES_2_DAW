<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
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
        <title>DWES04_Tarea4pres</title>
        <link type="text/css" rel="stylesheet" href="estilos.css" />
        <?php
        // Iniciamos la sesión o recuperamos la anterior sesión existente
        session_start();

        // Inicializamos la variable que mostrará los mensajes al usuario
        $mensaje = "";

        // Comprobamos si hay información en el POST de la página de preferencias
        if (isset($_POST['idioma'])) {

            // Volcamos la información del POST a sesión
            $_SESSION['idioma'] = $_POST['idioma'];
            $_SESSION['perfpub'] = $_POST['perfpub'];
            $_SESSION['zonah'] = $_POST['zonah'];

            // Asignamos un mensaje a la variable adecuada para mostrar el 
            // resultado al usuario
            $mensaje = "Información guardada en sesión";
        }

        // Comprobamos si hay información de las preferencias almacenada en 
        // sesión       
        if (isset($_SESSION['idioma'])) {

            // De ser así, la almacenamos en variables para su posterior uso
            $idioma = $_SESSION['idioma'];
            $perfpub = $_SESSION['perfpub'];
            $zonah = $_SESSION['zonah'];
        }
        ?>          
    </head>
    <body>
        <div id='preferencias'>
            <form action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?> method='post'>
                <fieldset>
                    <legend>Preferencias</legend>
                    <div><span class='mensaje'><?php echo $mensaje; ?></span></div>
                    <div class='campo'>
                        <label for='idioma' >Idioma:</label><br/>
                        <select name="idioma" id="idioma" >
                            <option value="es" <?php
                            // Comprobamos si la variable idioma contiene información
                            if (isset($idioma)) {
                                // Si contiene información y su valor es el 
                                // correspondiente al español
                                if ($idioma == 'es') {
                                    // De ser así marcamos esta opción como seleccionada
                                    echo 'selected';
                                }
                            }
                            ?>>Español</option>                            
                            <option value="en" <?php
                            // Comprobamos si la variable idioma contiene información
                            if (isset($idioma)) {
                                // Si contiene información y su valor es el 
                                // correspondiente al español
                                if ($idioma == 'en') {
                                    // De ser así marcamos esta opción como seleccionada
                                    echo 'selected';
                                }
                            }
                            ?>>Ingles</option>
                        </select>
                    </div>
                    <div class='campo'>
                        <label for='perfpub' >Perfil público:</label><br/>
                        <select name="perfpub" id="perfpub">
                            <option value="Si" <?php
                            // Comprobamos si la variable perfil público contiene 
                            // información
                            if (isset($perfpub)) {
                                // Si contiene información y su valor es el 
                                // correspondiente a Si
                                if ($perfpub == 'Si') {
                                    // De ser así marcamos esta opción como seleccionada
                                    echo 'selected';
                                }
                            }
                            ?>>Si</option>
                            <option value="No" <?php
                            // Comprobamos si la variable perfil público contiene 
                            // información
                            if (isset($perfpub)) {
                                // Si contiene información y su valor es el 
                                // correspondiente a No
                                if ($perfpub == 'No') {
                                    // De ser así marcamos esta opción como seleccionada
                                    echo 'selected';
                                }
                            }
                            ?>>No</option>
                        </select>                
                    </div>
                    <div class='campo'>
                        <label for='zonah' >Zona horaria:</label><br/>
                        <select name="zonah" id="zonah">
                            <option value="GMT-2" <?php
                            // Comprobamos si la variable zona horaria contiene 
                            // información
                            if (isset($zonah)) {
                                // Si contiene información y su valor es el 
                                // correspondiente a GMT-2
                                if ($zonah == 'GMT-2') {
                                    // De ser así marcamos esta opción como seleccionada
                                    echo 'selected';
                                }
                            }
                            ?>>GMT-2</option>
                            <option value="GMT-1" <?php
                            // Comprobamos si la variable zona horaria contiene 
                            // información
                            if (isset($zonah)) {
                                // Si contiene información y su valor es el 
                                // correspondiente a GMT-1                                
                                if ($zonah == 'GMT-1') {
                                    // De ser así marcamos esta opción como seleccionada
                                    echo 'selected';
                                }
                            }
                            ?>>GMT-1</option>
                            <option value="GMT" <?php
                            // Comprobamos si la variable zona horaria contiene 
                            // información                            
                            if (isset($zonah)) {
                                // Si contiene información y su valor es el 
                                // correspondiente a GMT                                
                                if ($zonah == 'GMT') {
                                    // De ser así marcamos esta opción como seleccionada
                                    echo 'selected';
                                }
                            }
                            ?>>GMT</option>
                            <option value="GMT+1" <?php
                            // Comprobamos si la variable zona horaria contiene 
                            // información                            
                            if (isset($zonah)) {
                                // Si contiene información y su valor es el 
                                // correspondiente a GMT+1                                
                                if ($zonah == 'GMT+1') {
                                    // De ser así marcamos esta opción como seleccionada
                                    echo 'selected';
                                }
                            }
                            ?>>GMT+1</option>
                            <option value="GMT+2" <?php
                            // Comprobamos si la variable zona horaria contiene 
                            // información                            
                            if (isset($zonah)) {
                                // Si contiene información y su valor es el 
                                // correspondiente a GMT+2                                
                                if ($zonah == 'GMT+2') {
                                    // De ser así marcamos esta opción como seleccionada
                                    echo 'selected';
                                }
                            }
                            ?>>GMT+2</option>
                        </select>
                    </div>                                
                    <div class='campo'>
                        <input type='submit' name='enviar' value='Establecer preferencias' />
                    </div>
                    <div>
                        <a id="mostrar" href="mostrar.php">Mostrar preferencias</a>
                    </div>
                </fieldset>
            </form>
        </div>
    </body>
</html>
