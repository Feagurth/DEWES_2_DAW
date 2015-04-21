<?php

/**
 * Clase para trabajar con la cesta de la compra
 */
class CestaCompra {

    /**
     * Array que contiene los productos de la cesta
     * @var Producto
     */
    protected $productos = array();

    /**
     * Introduce un nuevo artículo en la cesta de la compra
     * @param String $codigo Código del artículo a añadir a la cesta
     */
    public function nuevo_articulo($codigo) {
        $producto = DB::obtieneProducto($codigo);
        $this->productos[] = $producto;
    }

    /**
     * Obtiene los artículos en la cesta
     * @return array Los productos que tiene la cesta
     */
    public function get_productos() {
        return $this->productos;
    }

    /**
     * Obtiene el coste total de los artículos en la cesta
     * @return double El coste total de los artículos de la cesta
     */
    public function get_coste() {
        $coste = 0;
        foreach ($this->productos as $p) {
            $coste += $p->getPVP();
        }
        return $coste;
    }

    /**
     * Comprueba si la cesta está vacía
     * @return boolean True si está vacia, false si tiene algún artículo
     */
    public function vacia() {
        if (count($this->productos) == 0) {
            return true;
        }
        return false;
    }

    /**
     * Guarda la cesta de la compra en la sesión del usuario
     */
    public function guarda_cesta() {
        $_SESSION['cesta'] = $this;
    }

    /**
     * Recupera la cesta de la compra almacenada en la sesión del usuario
     * @return \CestaCompra La cesta de la compra actual o una nueva
     */
    public static function carga_cesta() {
        if (!isset($_SESSION['cesta'])) {
            return new CestaCompra();
        } else {
            return ($_SESSION['cesta']);
        }
    }

    /**
     * Muestra el HTML de la cesta de la compra, con todos los productos
     * @return String Cadena HTML con el contenido de la Cesta de la compra actual
     */
    public function muestra() {

        // Creamos una variable para almacenar la salida
        $salida = "";

        // Si la cesta está vacía, concatenamos un mensaje a la variable de salida
        if (count($this->productos) == 0) {
            $salida = "<p>Cesta vacía</p>";
        }
        //  y si no está vacía, concatenamos su contenido en la variable de salida
        else {
            foreach ($this->productos as $producto) {
                $salida .= $producto->muestra();
            }
        }

        // Devolvemos la cadena con el resultado
        return $salida;
    }
}