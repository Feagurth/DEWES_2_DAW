<?php

require_once './registro.php';
include './configuracion.inc.php';

class DB {

    protected static function ejecutaConsulta($sql) {

        global $serv;
        global $base;
        global $usu;
        global $pas;

        $opc = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8");
        $dsn = "mysql:host=$serv;dbname=$base";

        $dwes = new PDO($dsn, $usu, $pas, $opc);
        $resultado = null;
        if (isset($dwes)) {
            $resultado = $dwes->query($sql);

            return $resultado;
        }
    }

    public static function listarEntradas() {
        $sql = "SELECT id_entrada as id, nreg, tipodoc, fentrada as fecha, remit, dest, esc, id_documento FROM entradas;";
        
        $resultado = self::ejecutaConsulta($sql);
        $datos = array();


        if ($resultado) {

            // Añadimos un elemento por cada registro de entrada obtenido
            $row = $resultado->fetch();

            while ($row != null) {
                $datos[] = new Registro($row);
                $row = $resultado->fetch();
            }
        }

        return $datos;
    }

}
