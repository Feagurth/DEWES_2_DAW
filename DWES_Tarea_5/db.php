<?php

require_once './Registro.php';
require_once './Fichero.php';

class DB {

    /**
     * Objeto que almacenará la base de datos PDO
     * @var type PDO Object
     */
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

    private function ejecutaConsultaTransaccion($sql, array $datos) {

        try {
            // Preaparamos una sentencia para la insercción del 
            // fichero en la tabla documentos            
            $stmt = $this->dwes->prepare($sql);

            // Creamos un contador para ir asignando valores a la sentencia
            $cont = 1;

            // Iteramos por el array
            foreach ($datos as $key) {

                // Verificamos si el valor es un recurso y si este recurso 
                // es de tipo stream, el cual habra que pasarlo como un campo 
                // BLOB. Despues vamos asignando los valores del array a cada 
                // posición de la sentencia. 
                if (gettype($key) === "resource" && get_resource_type($key) === "stream") {

                    // Asignamos el valor del fichero, especificando 
                    // que se trata de un fichero tipo BLOB, para que 
                    // modifique la información guardada en formato 
                    // stream en la base de datos adaptandolo en el 
                    // proceso
                    $stmt->bindValue($cont, $key, PDO::PARAM_LOB);
                } else {

                    // Si no es un recurso el valor, lo asignamos sin parámetros
                    $stmt->bindValue($cont, $key);
                }

                // Aumentamos el contador
                $cont++;
            }

            // Devolvemos el resultado
            return $stmt->execute();
        } catch (Exception $ex) {
            // Si se produce una excepción la lanzamos para que se ocupe de ella 
            // la función que haya invocado a esta
            throw $ex;
        }
    }

    private function insertarFichero(Fichero $fichero, $id_registro) {

        try {
            // Especificamos la sentencia SQL que insertará los valores del 
            // fichero en la base de datos
            $sql = "INSERT INTO DOCUMENTOS VALUES(?, ?, ?, ?, ?, ?)";

            // Pasamos el objeto a un array
            $datos = (array) $fichero;

            // Insertamos el valor del registro relaccionado con el fichero en 
            // el array
            array_splice($datos, 1, 0, $id_registro);

            // Realizamos la consulta haciendo uso de la función privada diseñada 
            // para tal fin y almacenamos el resultado de la misma
            $resultado = $this->ejecutaConsultaTransaccion($sql, $datos);

            // Verificamos el resultado de la operación
            if (!$resultado) {
                // Si el resultado no es correcto, hacemos un rollback
                $this->dwes->rollBack();

                // Y lanzamos una excepción
                throw new Exception;
            } else {
                // Si el resultado es correcto, lo devolvemos
                return $resultado;
            }
        } catch (Exception $ex) {

            // Si se produce una excepción, hacemos un rollback
            $this->dwes->rollBack();

            // Y lanzamos la excepción
            throw $ex;
        }
    }

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

    /**
     * Método que nos permite listar los documentos relacionados con un registro
     * @param type $id_registro Id del registro relacionado con los documentos
     * @return \Registro
     * @throws Exception
     */
    public function listarDocumentos($id_registro) {

        // Especificamos la consulta que vamos a realizar sobre la base de datos
        $sql = "SELECT id_documento, id_registro, nombre, tipo FROM documentos WHERE "
                . "id_registro = $id_registro;";

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

                // Asignamos el resultado al array de resultados                
                $datos[] = $row;

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
        $sql = "INSERT INTO REGISTROS VALUES (0, "
                . "'" . $registro->getNreg() . "' , "
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

        // Iniciamos una transacción
        $this->dwes->beginTransaction();

        // Especificamos la sentencia SQL que insertará los valores en la base 
        // de datos
        $sql = "INSERT INTO REGISTROS VALUES(?, ?, ?, ?, ?, ?, ?)";

        // Pasamos el objeto a un array
        $datos = (array) $registro;

        // Quitamos la última posición del array, correspondiente a si hay 
        // ficheros insertados, pues esta información no se almacenará en 
        // la base de datos
        array_pop($datos);

        // Ejecutamos la consulta haciendo uso de la función privada diseñada 
        // para este fin y almacenamos el resultado
        $resultado = $this->ejecutaConsultaTransaccion($sql, $datos);

        // Verificamos el resultado de la operación
        if ($resultado) {

            // Si es correcto, recuperamos el último Id insertado en la base de 
            // datos, que corresponderá con el identificador del registro 
            // recién insertado
            $lastid = $this->dwes->lastInsertId();

            // Iteramos por el array de ficheros para procesarlos
            foreach ($ficheros as $value) {

                // Insertamos cada fichero haciendo uso de la función privada 
                // diseñada para este fin y almacenamos el resultado
                $resultado = $this->insertarFichero($value, $lastid);

                // Si el resultado no es correcto para todas las iteraciones de 
                // los ficheros
                if (!$resultado) {

                    // Hacemos un rollback para anular las insercciones
                    $this->dwes->rollBack();

                    // Lanzamos una excepción
                    throw new Exception;
                }
            }

            // Si todo es correcto, comfirmamos los cambios
            $this->dwes->commit();
        } else {

            // Si el resultado de la inserción del registro no es correcta, 
            // hacemos un rollback para invalidarlos cambios que se hayan hecho 
            // en la base de datos
            $this->dwes->rollBack();

            // Y lanzamos una excepción
            throw new Exception;
        }
    }

    public function recuperarDocumento($id_documento) {

        // Especificamos la consulta que vamos a realizar sobre la base de datos
        $sql = "select * from documentos where id_documento=$id_documento";

        // Llamamos la a la función protegida de la clase para realizar la consulta
        $resultado = $this->ejecutaConsulta($sql);

        // Comprobamos si hemos obtenido algún resultado
        if ($resultado) {
            // Devolvemos el resultado
            return $resultado->fetch();
        } else {
            // Si no tenemos resultados lanzamos una excepción
            throw new Exception;
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
