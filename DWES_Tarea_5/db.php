<?php

require_once './registro.php';

//include './configuracion.inc.php';

class DB {

    /**
     * Método que nos permite realizar consultas a la base de datos
     * @global type $serv Servidor de base de datos donde está situada la base  
     * de datos
     * @global type $base Nombre de la base de datos a conectar
     * @global type $usu Nombre de usuario para la conexión a la base de datos
     * @global type $pas Password para la conexión a la base de datos
     * @param type $sql Sentencia SQL a realizar sobre la base de datos
     * @return type Devuelve el resultado de una consulta con base de datos
     */
    protected static function ejecutaConsulta($sql) {

        // Recuperamos las variables globales que contienen la configuración 
        // de conxión a la base de datos
        global $serv;
        global $base;
        global $usu;
        global $pas;

        // Creamos un array de configuración para la conexion PDO a la base de 
        // datos
        $opc = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8");

        // Creamos la cadena de conexión con la base de datos
        $dsn = "mysql:host=$serv;dbname=$base";

        // Finalmente creamos el objeto PDO para la base de datos
        $dwes = new PDO($dsn, $usu, $pas, $opc);
        $resultado = null;

        // Comprobamos si el objeto se ha creado correctamente
        if (isset($dwes)) {

            // De ser así, realizamos la consulta
            $resultado = $dwes->query($sql);

            // Devolvemos el resultado
            return $resultado;
        }
    }

    /**
     * Método que nos permite listar los registros de entrada de la base de datos
     * @return \Registro Devuelve un array de objetos Registro
     * @throws Exception Se lanza una excepción si se ha producido algún error
     */
    public static function listarEntradas() {

        // Especificamos la consulta que vamos a realizar sobre la base de datos
        $sql = "SELECT id_entrada as id, nreg, tipodoc, fentrada as fecha, remit, dest, esc, id_documento FROM entradas;";

        // Llamamos la a la función protegida de la clase para realizar la consulta
        $resultado = self::ejecutaConsulta($sql);

        // Comprobamos si hemos obtenido algún resultado
        if ($resultado) {

            // Definimos un nuevo array para almacenar el resultado
            $datos = array();

            // Añadimos un elemento por cada registro de entrada obtenido
            $row = $resultado->fetch();

            // Iteramos por los resultados obtenidos
            while ($row != null) {

                // Creamos un nuevo registro usando el constructo de la clase y 
                // lo asginamos al array de resultados
                $datos[] = new Registro($row);

                // Recuperamos una nueva fila
                $row = $resultado->fetch();
            }

            // Devolvemos el resultado
            return $datos;
        } else {
            // Si no tenemos resultados lanzamos una excepción
            throw new Exception;
        }
    }

    /**
     * Método que nos permite listar los registros de salida de la base de datos
     * @return \Registro Devuelve un array de objetos Registro
     * @throws Exception Se lanza una excepción si se ha producido algún error
     */
    public static function listarSalidas() {

        // Especificamos la consulta que vamos a realizar sobre la base de datos
        $sql = "SELECT id_salida as id, nreg, tipodoc, fsalida as fecha, remit, dest, esc, id_documento FROM salidas;";

        // Llamamos la a la función protegida de la clase para realizar la consulta
        $resultado = self::ejecutaConsulta($sql);

        // Comprobamos si hemos obtenido algún resultado
        if ($resultado) {

            // Definimos un nuevo array para almacenar el resultado
            $datos = array();

            // Añadimos un elemento por cada registro de entrada obtenido
            $row = $resultado->fetch();

            // Iteramos por los resultados obtenidos
            while ($row != null) {

                // Creamos un nuevo registro usando el constructo de la clase y 
                // lo asginamos al array de resultados
                $datos[] = new Registro($row);

                // Recuperamos una nueva fila
                $row = $resultado->fetch();
            }

            // Devolvemos el resultado
            return $datos;
        } else {
            // Si no tenemos resultados lanzamos una excepción
            throw new Exception;
        }
    }

}
