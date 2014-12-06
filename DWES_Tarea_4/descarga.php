<?php

// Inicializamos la sesión
session_start();

// Comprobamos si tenemos en sesión usuario y password
if (!isset($_SESSION['user']) || !isset($_SESSION['pass'])) {
    // De no ser así, volvemos a la página index.php para pedirselos al usuario
    header("location:index.php");
} else {
    // En caso contrario crearemos una conexión con la base de datos para 
    // verificar el usuario y el password
    try {

        // Creamos una conexión a la base de datos especificando el host, 
        // la base de datos, el usuario y la contraseña
        $gestion = new PDO('mysql:host=localhost;dbname=gestion', 'root', '');

        // Especificamos atributos para que en caso de error, salte una excepción
        $gestion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {

        // Si se produce una excepción almacenamos el error y el 
        // mensaje asociado
        $error = $e->getCode();
        $mensajeError = $e->getMessage();
    }
    if (!isset($mensajeError)) {

        // Realizamos una consulta a la base de datos buscando registros en la 
        // tabla de usuarios cuyo usuario y contraseña sean los mismos que los 
        // introducidos por el usuario
        $consulta = $gestion->query("select user from usuario where user='${_SESSION['user']}' and pass='${_SESSION['pass']}'");

        // Recuperamos todos los resultados forzando a traer un solo valor 
        // por registro
        $usuario = $consulta->fetchAll(PDO::FETCH_ASSOC);

        // Contamos el número de registros que contiene el array de datos traido 
        // de la base de datos
        if (count($usuario) != 1) {
            // En el caso de que devuelva cualquier valor distinto de 1, eso 
            // quiere decir que el usuario y la contraseña son erróneos, 
            // por tanto volvemos a la página index.php tras limpiar la sesión
            session_unset();

            header("location:index.php");
        }
    }
}

// Creamos un bloque try-catch para la inicialización de la base 
// de datos
try {

    // Creamos una conexión a la base de datos especificando el host, 
    // la base de datos, el usuario y la contraseña
    $gestion = new PDO('mysql:host=localhost;dbname=gestion', 'dwes', 'abc123.');
    // Especificamos atributos para que en caso de error, salte una excepción
    $gestion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Si se produce una excepción almacenamos el mensaje asociado
    $mensajeError = $e->getMessage();
}

// Comprobamos si ha ocurrido algún error en la conexión con la base de 
// datos. De no ser así, seguimos con la carga de datos de la página
if (!isset($mensajeError)) {

    // Recuperamos el id del documento a mostrar
    $id = $_GET['id'];

    // Preparamos una consulta para que la base de datos devuelva todos los 
    // datos del documento especificado
    $consulta = $gestion->query("select * from documentos where id_documento=$id");

    // Realizamos la consulta
    $fila = $consulta->fetchAll(PDO::FETCH_ASSOC);

    // Comprobamos que la consulta trae datos
    if (count($fila) == 1) {
        
        
        
        // Usamos header para asignar los valores del fichero de la base de 
        // datos correspondientes y permitir al navegador mostrar la información
        // como un fichero a descargar
        header("Content-length: ". $fila[0]['tamanyo']);
        header("Content-type: " . $fila[0]['tipo']);
        header("Content-Disposition: attachment; filename=".$fila[0]['nombre']);

        // Finalmente mostrarmos el fichero
        echo $fila[0]['documento'];
    }

    // Hacemos una llamada a JavaScript para cerrar la ventana creada
    echo "<script>window.close();</script>";
}
