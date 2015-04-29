<?php

/**
 * Desarrollo Web en Entorno Servidor
 * Tema 8 : Aplicaciones web híbridas
 * Ejemplo Rutas de reparto: ajaxmaps.php
 */
// Incluimos la lilbrería Xajax
require_once 'libs/xajax_core/xajax.inc.php';

// Creamos el objeto xajax
$xajax = new xajax();

// Y registramos la función que vamos a llamar desde JavaScript
$xajax->register(XAJAX_FUNCTION, "obtenerCoordenadas");
$xajax->register(XAJAX_FUNCTION, "ordenarReparto");

// El método processRequest procesa las peticiones que llegan a la página
// Debe ser llamado antes del código HTML
$xajax->processRequest();

function ordenarReparto($coordenadasPuntosIntermedios) {
    // Indicamos las coordenadas del almacén de donde sale la mercancía
    // Se podría añadir código para permitir al usuario indicarlas
    //  o incluso coger por defecto la ubicación actual del usuario
    $coordenadasOrigen = "42.402497,-8.812001";

    // Se comienza y finaliza la ruta de reparto en el almacén
    $url = 'http://maps.google.es/maps/api/directions/json?origin=' . $coordenadasOrigen;
    // Para obtener el resultado en XML en lugar de JSON, podríamos hacer:
    // $url = 'http://maps.google.es/maps/api/directions/xml?origin='.$coordenadasOrigen;
    $url .= '&destination=' . $coordenadasOrigen;

    // Y se añaden los puntos de envío, indicando que optimice el recorrido
    $url .= '&waypoints=optimize:true|';
    $url .= $coordenadasPuntosIntermedios;
    $url .= '&sensor=false';

    // Como el resultado es JSON, lo procesamos de la siguiente forma
    $json = file_get_contents($url);
    $respuesta = json_decode($json);
    $orden = $respuesta->routes[0]->waypoint_order;

    // Si obtuviéramos un resultado en XML, habría que procesarlo de la siguiente forma
    /*
      $xml = simplexml_load_file($url);
      // Guardamos el recorrido óptimo calculado en un array
      foreach($xml->route[0]->waypoint_index as $parada) {
      $orden[] = (integer) $parada;
      }
     */

    // Y devolvemos el array obtenido
    $respuesta = new xajaxResponse();
    $respuesta->setReturnValue($orden);
    return $respuesta;
}

function obtenerCoordenadas($parametros) {

    // Creamos una respuesta
    $respuesta = new xajaxResponse();

    // Y guardamos en una cadena la url REST que necesitamos para procesar nuestra petición
    $search = 'http://maps.google.com/maps/api/geocode/xml?address=' . $parametros['direccion'] . '&sensor=false&appid=z9hiLa3e';

    // Cargamos el resultado en un objeto xml
    $xml = simplexml_load_file($search);

    // Almacenamos la latitud y la longitud 
    $lat = $xml->result[0]->geometry->location->lat;
    $lng = $xml->result[0]->geometry->location->lng;

    // Las asginamos a la respuesta
    $respuesta->assign("latitud", "value", (string) $lat);
    $respuesta->assign("longitud", "value", (string) $lng);

    // Creamos otra nueva url REST para hacer una petición a Google Elevation 
    // usando como parámetros la latitud y la longitud recuperadas anteriormente
    $search = 'http://maps.googleapis.com/maps/api/elevation/xml?locations=' . $lat . ',' . $lng;

    // Cargamos el resultado en un objeto xml
    $xml = simplexml_load_file($search);

    // Asignamos a la respuesta el valor de la altitud
    $respuesta->assign("altitud", "value", (string) $xml->result[0]->elevation);

    // Asignamos como respuesta el cambio de valor del texto del botón y lo 
    // volvemos a habilitar
    $respuesta->assign("obtenerCoordenadas", "value", "Obtener coordenadas");
    $respuesta->assign("obtenerCoordenadas", "disabled", false);

    //Devolvemos la respuesta de la petición AJAX
    return $respuesta;
}
