<html id="login">
    <head>
        <title>Login</title>
        <link type = "text/css" rel = "stylesheet" href = "./estilos.css"/>
    </head>
    <body>
        <div id="divlogin">
            <h3>Acceso de usuario</h3>
            <div>
                <input type="text" id="user" name="user" maxlength="16" placeholder="Introduzca el usuario" onkeypress="pulsadoIntro();"/>
            </div>
            <div>
                <input type="password" id="pass" name="pass" maxlength="16" placeholder="Introduzca la contraseña" onkeypress="pulsadoIntro();"/>
            </div>
            <div>
                <input type="button" id="submit" name="submit" value="Enviar" onclick="validarLogin();"/>
            </div>
            <div id="error">
                <p>{$error}</p>
            </div>                               
        </div>
    </body>        
</html>