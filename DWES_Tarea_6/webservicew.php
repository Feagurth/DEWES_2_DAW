<?php

/**
 * webservice class
 * 
 * Clase que contendra la funcionalidad del servicio web 
 * 
 * @author    {author}
 * @copyright {copyright}
 * @package   {package}
 */
class webservice extends SoapClient {

  private static $classmap = array(
                                   );

  public function webservice($wsdl = "http://localhost/DWES_Tarea_6/serviciow.php?wsdl", $options = array()) {
    foreach(self::$classmap as $key => $value) {
      if(!isset($options['classmap'][$key])) {
        $options['classmap'][$key] = $value;
      }
    }
    parent::__construct($wsdl, $options);
  }

  /**
   * Funcion que devuelve el PVP de un producto 
   *
   * @param string $codProducto
   * @return float
   */
  public function getPVP($codProducto) {
    return $this->__soapCall('getPVP', array($codProducto),       array(
            'uri' => '',
            'soapaction' => ''
           )
      );
  }

  /**
   * Funcion que devuelve el stock de un producto especifico en una tienda especifica 
   *
   * @param string $codProducto
   * @param int $codTienda
   * @return int
   */
  public function getStock($codProducto, $codTienda) {
    return $this->__soapCall('getStock', array($codProducto, $codTienda),       array(
            'uri' => '',
            'soapaction' => ''
           )
      );
  }

  /**
   * Funcion que devuelve los codigos de las familias 
   *
   * @param  
   * @return UNKNOWN
   */
  public function getFamilias() {
    return $this->__soapCall('getFamilias', array(),       array(
            'uri' => '',
            'soapaction' => ''
           )
      );
  }

  /**
   * Funcion que nos permite devolver los productos correspondientes a una familia 
   *
   * @param string $codFamilia
   * @return UNKNOWN
   */
  public function getProductosFamilia($codFamilia) {
    return $this->__soapCall('getProductosFamilia', array($codFamilia),       array(
            'uri' => '',
            'soapaction' => ''
           )
      );
  }

}

?>
