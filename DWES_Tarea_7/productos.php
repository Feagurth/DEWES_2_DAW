<?php
require_once('include/DB.php');
require_once('include/CestaCompra.php');


// Instanciamos las librerias de xajax
require_once ('/include/xajax_core/xajax.inc.php');

// Creamos un nuevo objeto xajax con el que trabajar
$xajax = new xajax('include/fcesta.php');

// Registramos las funciones que usaremos para las peticiones ajax
$xajax->register(XAJAX_FUNCTION, "limpiarCesta");
$xajax->register(XAJAX_FUNCTION, "anadirArticulo");
$xajax->register(XAJAX_FUNCTION, "mostrarCesta");

// Y configuramos la ruta en que se encuentra la carpeta xajax_js
$xajax->configure('javascript URI', './include/');

// Recuperamos la información de la sesión
session_start();

// Y comprobamos que el usuario se haya autentificado
if (!isset($_SESSION['usuario'])) {
    die("Error - debe <a href='login.php'>identificarse</a>.<br />");
}

// Recuperamos la cesta de la compra
$cesta = CestaCompra::carga_cesta();

/**
 * Función que nos permite leer de la base de datos los artículos a vender y 
 * crear una presentación HTML con los mismos para generar el listado de 
 * artículos en venta
 */
function creaFormularioProductos() {

    // Recuperamos los artículos de la base de datos
    $productos = DB::obtieneProductos();

    // Iteramos por todos los artículos recuperados
    foreach ($productos as $p) {

        // Creamos la estructura HTML necesaria para mostrar la información del 
        // producto junto con un botón para poder añadirlo al carrito
        echo "<p><form id='" . $p->getcodigo() . "' onclick='anadirArticulo(this.id);'>";
        // Metemos ocultos los datos de los productos
        echo "<input type='hidden' id='cod' name='cod' value='" . $p->getcodigo() . "'/>";
        echo "<input type='button' name='enviar' value='Añadir'/>";
        echo $p->getnombrecorto() . ": ";
        echo $p->getPVP() . " euros.";
        echo "</form>";
        echo "</p>";
    }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<!-- Desarrollo Web en Entorno Servidor -->
<!-- Tema 7 : Aplicaciones web dinámicas: PHP y Javascript -->
<!-- Tarea: Cesta de la compra con Xajax: productos.php -->
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <title>Ejemplo Tema 5: Listado de Productos</title>
        <link href="tienda.css" rel="stylesheet" type="text/css">
        <!-- Imprimimos las funciones de javascript generadas por xajax -->
        <?php $xajax->printJavascript(); ?>
        <script src="include/fcesta.js"></script>
    </head>

    <!-- Cargamos la cesta mediente una petición ajax lanza desde javascript -->
    <body class="pagproductos" onload="mostrarCesta();">
        <div id="contenedor">
            <div id="encabezado">
                <h1>Listado de productos</h1>
            </div>
            <div id="cesta">
            </div>
            <div id="productos">
                <?php creaFormularioProductos(); ?>
            </div>
            <br class="divisor" />
            <div id="pie">
                <form action='logoff.php' method='post'>
                    <input type='submit' name='desconectar' value='Desconectar usuario <?php echo $_SESSION['usuario']; ?>'/>
                </form>        
            </div>
        </div>
    </body>
</html>
