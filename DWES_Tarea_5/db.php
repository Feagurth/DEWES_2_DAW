<?php

require_once './Registro.php';
require_once './Fichero.php';

class DB {

    private $dwes;

    public function __construct() {
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
        $this->dwes = new PDO($dsn, $usu, $pas, $opc);
        
        
    }

    /**
     * Método que nos permite realizar consultas a la base de datos
     * @global type $serv Servidor de base de datos donde está situada la base  
     * de datos
     * @param type $sql Sentencia SQL a realizar sobre la base de datos
     * @return type Devuelve el resultado de una consulta con base de datos
     */
    private function ejecutaConsulta($sql) {

        $resultado = null;

        // Comprobamos si el objeto se ha creado correctamente
        if (isset($this->dwes)) {

            // De ser así, realizamos la consulta
            $resultado = $this->dwes->query($sql);

            // Devolvemos el resultado
            return $resultado;
        }
    }

    /*
    private function insertarFichero(Fichero $fichero, $id_registro) {

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

            try {

                // Preparamos la base de datos para hacer uso de transacciones
                $dwes->beginTransaction();

                // Preaparamos una sentencia para la insercción del 
                // fichero en la tabla documentos            
                $stmt = $dwes->prepare("INSERT INTO DOCUMENTOS VALUES(0, ?, ?, ?, ?, ?)");

                $tam = $fichero->getTamanyo();
                $tip = $fichero->getTipo();
                $nom = $fichero->getNombre();
                $doc = $fichero->getDocumento();

                $stmt->bindParam(1, $id_registro);
                $stmt->bindParam(2, $tam);
                $stmt->bindParam(3, $tip);
                $stmt->bindParam(4, $nom);

                // Asignamos el valor del fichero, especificando 
                // que se trata de un fichero tipo BLOB, para que 
                // modifique la información guardada en formato 
                // stream en la base de datos adaptandolo en el 
                // proceso
                $stmt->bindParam(5, $doc, PDO::PARAM_LOB);

                // Ejecutamos la sentencia
                $resultado = $stmt->execute();

                // Ejecutamos la sentencia
                $dwes->commit();

                // Devolvemos el resultado
                return $resultado;
            } catch (Exception $ex) {
                // Si tenemos una excepción, hacemos un rollback
                $dwes->rollBack();

                // Y lanzamos la excepción
                throw $ex;
            }
        }
    }
*/
    /**
     * Método que nos permite listar los registros de entrada de la base de datos
     * @return \Registro Devuelve un array de objetos Registro
     * @throws Exception Se lanza una excepción si se ha producido algún error
     */
    public function listarEntradas() {

        // Especificamos la consulta que vamos a realizar sobre la base de datos
        $sql = "SELECT id as id, nreg, tipo_reg, tipodoc, fecha, remit, dest, "
                . "IF((SELECT count(*) from documentos d where "
                . "d.id_registro = r.id AND r.tipo_reg = 'E') > 0, 1, 0) as esc "
                . "from registros r where tipo_reg ='E' order by fecha desc, "
                . "id desc;";

        // Llamamos la a la función protegida de la clase para realizar la consulta
        $resultado = $this->ejecutaConsulta($sql);

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
    public function listarSalidas() {

        xdebug_break();

        // Especificamos la consulta que vamos a realizar sobre la base de datos
        $sql = "SELECT id as id, nreg, tipo_reg, tipodoc, fecha, remit, dest, "
                . "IF((SELECT count(*) from documentos d where "
                . "d.id_registro = r.id AND r.tipo_reg = 'S') > 0, 1, 0) as esc "
                . "from registros r where tipo_reg ='S' order by fecha desc, "
                . "id desc;";

        // Llamamos la a la función protegida de la clase para realizar la consulta
        $resultado = $this->ejecutaConsulta($sql);

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

    public function insertarRegistro(Registro $registro) {
        // Creamos la consulta de insercción usando los valores del objeto 
        // registro
        $sql = "INSERT INTO REGISTROS VALUES (0, '" . $registro->getNreg() . "' , "
                . "'" . $registro->getTipo_reg() . "', "
                . "'" . $registro->getTipodoc() . "', "
                . "'" . $registro->getFecha() . "', "
                . "'" . $registro->getRemitente() . "',"
                . "'" . $registro->getDestinatario() . "');";

        // Llamamos la a la función protegida de la clase para realizar la consulta
        $resultado = self::ejecutaConsulta($sql);

        // Comprobamos el resultado
        if ($resultado) {
            // Si es correcto, devolvemos 0
            return 0;
        } else {
            // En caso contrario, lanzamos una excepción
            throw new Exception;
        }
    }

    public function insertarRegistroFichero(Registro $registro, array $ficheros) {

        foreach ($ficheros as $value) {

            $this->insertarFichero($value, 2);
        }
    }

    /**
     * Función para recuperar el número de registro mas grande de los distintos 
     * tipos de registro
     * @param type $tipo Tipo de registro del que se quiere recuperar el número
     * @return type String Numero de registro más grande dependidendo del tipo
     */
    public function calcularNReg($tipo) {
        // Creamos la consulta usando el parámetro pasado a la función
        $sql = "Select max(nreg) from registros where tipo_reg = '$tipo';";

        // Llamamos la a la función protegida de la clase para realizar la consulta
        $resultado = $this->ejecutaConsulta($sql);

        // Comprobamos el resultado
        if ($resultado) {
            // Si es correcto, devolvemos el resultado
            return $resultado->fetch()[0];
        } else {
            // En caso contrario lanzamos una excepción
            throw new Exception;
        }
    }

}
