<?php

// Instanciamos el fichero de la base de datos
require_once './configuracion.inc.php';
require_once './Db.php';

// Creamos una nueva instancia de la base de datos
$db = new DB();

// Preparamos una consulta para que la base de datos devuelva todos los 
// datos del documento especificado
$fila = $db->recuperarDocumento($_POST['idd']);

// Comprobamos que la consulta trae datos
if ($fila) {
    // Usamos header para asignar los valores del fichero de la base de 
    // datos correspondientes y permitir al navegador mostrar la información
    // como un fichero a descargar
    header("Content-length: " . $fila['tamanyo']);
    header("Content-type: " . $fila['tipo']);
    header("Content-Disposition: attachment; filename=" . $fila['nombre']);

    // Finalmente mostrarmos el fichero
    echo $fila['documento'];
}

// Hacemos una llamada a JavaScript para cerrar la ventana creada
echo "<script>window.close();</script>";
