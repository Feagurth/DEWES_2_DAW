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
        <link type="text/javascript" rel="stylesheet" href="estilos.css" />
        <?php
        // Iniciamos la sesión o recuperamos la anterior sesión existente
        session_start();

        // Inicializamos la variable que mostrará los mensajes al usuario
        $mensaje = "";

        // Comprobamos si existe información en sesion para poder recuperarla
        if (isset($_SESSION['idioma'])) {

            // Volcamos la información que queremos a variables
            $idioma = $_SESSION['idioma'];
            $perfpub = $_SESSION['perfpub'];
            $zonah = $_SESSION['zonah'];
        }

        // Comprobamos si en la información del POST de la página se ha 
        // pulsado el botón de borrar
        if (isset($_POST['borrar'])) {

            // Eliminamos los valores de las variables
            $idioma = "";
            $perfpub = "";
            $zonah = "";

            // Estalbecemos un mensaje para mostrar al usuario
            $mensaje = "Información de sesión eliminada";

            // Eliminamos la información de la sesión
            session_unset();
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
                        <?php
                        // Comprobamos si la variable de idioma contiene 
                        // información
                        if (isset($idioma)) {
                            // Dependiendo del valor de la variable mostramos 
                            // una texto u otro
                            switch ($idioma) {
                                case 'es':
                                    echo "Español";
                                    break;
                                case 'en':
                                    echo "Inglés";
                                    break;
                            }
                        }
                        ?>
                    </div>
                    <div class='campo'>
                        <label for='perfpub' >Perfil público:</label><br/>
                        <?php
                        // Comprobamos si la variable de perfil público contiene 
                        // información
                        if (isset($perfpub)) {
                            // De ser así la mostramos al usuario
                            echo $perfpub;
                        }
                        ?>
                    </div>
                    <div class='campo'>
                        <label for='zonah' >Zona horaria:</label><br/>
                        <?php
                        // Comprobamos si la variable de zona horaria contiene 
                        // información
                        if (isset($zonah)) {
                            // De ser así la mostramos al usuario
                            echo $zonah;
                        }
                        ?>
                    </div>                                
                    <div class='campo'>
                        <input type='submit' name='borrar' value='Borrar preferencias' />
                    </div>
                    <div>
                        <a id="mostrar" href="preferencias.php">Establecer preferencias</a>
                    </div>
                </fieldset>
            </form>
        </div>        
    </body>
</html>
