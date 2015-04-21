<?php

/**
 * Clase para trabajar con los productos a comprar
 */
class Producto {

    protected $codigo;
    protected $nombre;
    protected $nombre_corto;
    protected $PVP;

    /**
     * Devuelve el código del producto
     * @return String El código del producto
     */
    public function getcodigo() {
        return $this->codigo;
    }

    /**
     * Devuelve el nombre del producto
     * @return String El nombre del producto
     */
    public function getnombre() {
        return $this->nombre;
    }

    /**
     * Devuelve el nombre corto del producto
     * @return String El nombre corto del producto
     */
    public function getnombrecorto() {
        return $this->nombre_corto;
    }

    /**
     * Devuelve el PVP del producto
     * @return String El pvp del producto
     */
    public function getPVP() {
        return $this->PVP;
    }

    /**
     * Devuelve un código HTML con el código del producto
     * @return String HTML con el código del producto en un párrafo
     */
    public function muestra() {
        return "<p>" . $this->codigo . "</p>";
    }

    /**
     * Constructor de la clase
     * @param String $row Array con los valores necesarios para crear un objeto
     */
    public function __construct($row) {
        $this->codigo = $row['cod'];
        $this->nombre = $row['nombre'];
        $this->nombre_corto = $row['nombre_corto'];
        $this->PVP = $row['PVP'];
    }

}