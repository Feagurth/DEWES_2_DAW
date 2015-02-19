<?php

require_once './Registro.php';
require_once './Fichero.php';
require_once './Persona.php';

class DB {

    /**
     * Objeto que almacenará la base de datos PDO
     * @var type PDO Object
     */
    private $dwes;

    /**
     * Constructor de la base de datos
     * @global type $serv Servidor donde está alojada el servidor de base de datos
     * @global type $base Nombre de la base de datos
     * @global type $usu Usuario de acceso a la base de datos
     * @global type $pas Contraseña para acceder a la base de datos
     * @throws Exception Se lanza una excepción si se produce algún error
     */
    public function __construct() {
        try {
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
            
            $this->dwes->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
            
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    /**
     * Método que nos permite realizar consultas a la base de datos
     * @param type $sql Sentencia sql a ejecutar
     * @return type Resultado de la consulta
     * @throws Exception Lanzamos una excepción si se produce un error
     */
    private function ejecutaConsulta($sql) {

        try {
            // Comprobamos si el objeto se ha creado correctamente
            if (isset($this->dwes)) {

                // De ser así, realizamos la consulta
                $resultado = $this->dwes->query($sql);

                // Devolvemos el resultado
                return $resultado;
            }
        } catch (Exception $ex) {
            // Si se produce un error, lanzamos una excepción
            throw $ex;
        }
    }

    /**
     * Función que nos permite realizar consultas a la base de datos en forma de transacciones
     * @param type $sql Sentencia sql a ejecutar
     * @param array $datos Datos a almacenar en forma de array
     * @return type El resultado de la operación
     * @throws Exception Lanza una excepción si se produce un error
     */
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

    /**
     * Función que nos permite insertar un fichero en la base de datos
     * @param Fichero $fichero Objeto Fichero que contiene la información a almacenar
     * @param type $id_registro Id del registro al que está vinculado el fichero
     * @return type Resultado de la operación
     * @throws Exception Lanza una excepción si se produce un error
     */
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
                throw new Exception($this->dwes->errorInfo()[2], $this->dwes->errorInfo()[1]);
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
        $sql = "SELECT id AS id, nreg, tipo_reg, tipodoc, fecha, "
                . "CONCAT_WS(' ', p.nombre, p.apellido1, p.apellido2) as remit, "
                . "CONCAT_WS(' ', p2.nombre, p2.apellido1, p2.apellido2) as dest, "
                . "IF((SELECT count(*) FROM documentos d WHERE d.id_registro = r.id "
                . "AND r.tipo_reg = 'E') > 0, 1, 0) AS esc FROM registros r, personas p, "
                . "personas p2 WHERE tipo_reg ='E' AND	r.remit = p.id_persona AND "
                . "r.dest = p2.id_persona ORDER BY fecha DESC, id DESC;";

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
            throw new Exception($this->dwes->errorInfo()[2], $this->dwes->errorInfo()[1]);
        }
    }

    /**
     * Método que nos permite listar los registros de salida de la base de datos
     * @return \Registro Devuelve un array de objetos Registro
     * @throws Exception Se lanza una excepción si se ha producido algún error
     */
    public function listarSalidas() {

        // Especificamos la consulta que vamos a realizar sobre la base de datos
        $sql = "SELECT id AS id, nreg, tipo_reg, tipodoc, fecha, "
                . "CONCAT_WS(' ', p.nombre, p.apellido1, p.apellido2) as remit, "
                . "CONCAT_WS(' ', p2.nombre, p2.apellido1, p2.apellido2) as dest, "
                . "IF((SELECT count(*) FROM documentos d WHERE d.id_registro = r.id "
                . "AND r.tipo_reg = 'S') > 0, 1, 0) AS esc FROM registros r, personas p, "
                . "personas p2 WHERE tipo_reg ='S' AND	r.remit = p.id_persona AND "
                . "r.dest = p2.id_persona ORDER BY fecha DESC, id DESC;";

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
            throw new Exception($this->dwes->errorInfo()[2], $this->dwes->errorInfo()[1]);
        }
    }

    /**
     * Método que nos permite listar los documentos relacionados con un registro
     * @param type $id_registro Id del registro relacionado con los documentos
     * @return type Devuelve un array con la información recuperada de la base de datos
     * @throws Exception Lanza una excepción si se produce un error
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
            throw new Exception($this->dwes->errorInfo()[2], $this->dwes->errorInfo()[1]);
        }
    }

    /**
     * Función que nos permite listar las personas almacenadas en la base de datos
     * @return \Persona Devuelve un array de objetos Persona con la información de la base de datos
     * @throws Exception Lanza una excepción si se produce un error
     */
    public function listarPersonas() {
        // Especificamos la consulta que vamos a realizar sobre la base de datos
        $sql = "SELECT * FROM personas ORDER BY nombre, apellido1, apellido2 ASC";

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
                $datos[] = new Persona($row);

                // Recuperamos una nueva fila
                $row = $resultado->fetch();
            }

            // Devolvemos el resultado
            return $datos;
        } else {
            // Si no tenemos resultados lanzamos una excepción
            throw new Exception();
        }
    }

    /**
     * Función que nos permite insertar los datos de una persona en la base de datos
     * @param Persona $persona Objeto Persona que contiene los datos a almacenar
     * @return int 0 si es correcto
     * @throws Exception Lanza una excepción si se produce un error
     */
    public function insertarPersona(Persona $persona) {

        // Creamos la consulta de insercción usando los valores del objeto 
        // Persona
        $sql = "INSERT INTO PERSONAS VALUES (0, "
                . "'" . $persona->getNombre() . "' , "
                . "'" . $persona->getApellido1() . "', "
                . "'" . $persona->getApellido2() . "');";

        // Llamamos la a la función protegida de la clase para realizar la consulta
        $resultado = self::ejecutaConsulta($sql);

        // Comprobamos el resultado
        if ($resultado) {
            // Si es correcto, devolvemos 0
            return 0;
        } else {
            // En caso contrario, lanzamos una excepción
            throw new Exception($this->dwes->errorInfo()[2], $this->dwes->errorInfo()[1]);
        }
    }

    /**
     * Función que nos permite eliminar una persona de la base de datos
     * @param type $id_persona Identificador de la persona a eliminar
     * @return int 0 si sale correcto, cualquier otro valor en caso contrario
     * @throws Exception Lanzamos una excepción si se produce un error
     */
    public function eliminarPersona($id_persona) {
        // Creamos la consulta de borrado usando el identificador de la persona
        $sql = "DELETE FROM personas where id_persona = " . $id_persona . ";";

        // Llamamos la a la función protegida de la clase para realizar la consulta
        $resultado = self::ejecutaConsulta($sql);

        // Comprobamos el resultado
        if ($resultado) {
            // Si es correcto, devolvemos 0
            return 0;
        } else {
            // En caso contrario, lanzamos una excepción
            throw new Exception($this->dwes->errorInfo()[2], $this->dwes->errorInfo()[1]);
        }
    }

    /**
     * Función que nos permite insertar los datos de un registro en la base de datos
     * @param Registro $registro Objeto Registro que contiene los datos a almacenar
     * @return int 0 si es correcto
     * @throws Exception Lanza una excepción si se produce un error
     */
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
            throw new Exception($this->dwes->errorInfo()[2], $this->dwes->errorInfo()[1]);
        }
    }

    /**
     * Función que nos permite insertar los datos de un registro con ficheros 
     * en la base de datos
     * @param Registro $registro Objeto Registro que contiene los datos a almacenar
     * @param array $ficheros Array de objeto Fichero que contiene la información 
     * de los documentos a almacenar
     * @throws Exception Lanza una excepción si se produce un error
     */
    public function insertarRegistroFichero(Registro $registro, array $ficheros) {

        try {


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
                        throw new Exception($this->dwes->errorInfo()[2], $this->dwes->errorInfo()[1]);
                    }
                }

                // Si todo es correcto, comfirmamos los cambios
                $this->dwes->commit();
            } else {

                // Si el resultado de la inserción del registro no es correcta, 
                // hacemos un rollback para invalidarlos cambios que se hayan hecho 
                // en la base de datos
                $this->dwes->rollBack();

                // Lanzamos una excepción
                throw new Exception($this->dwes->errorInfo()[2], $this->dwes->errorInfo()[1]);
            }
        } catch (Exception $ex) {

            // Si el resultado de la inserción del registro no es correcta, 
            // hacemos un rollback para invalidarlos cambios que se hayan hecho 
            // en la base de datos
            $this->dwes->rollBack();

            // Lanzamos una excepción
            throw $ex;
        }
    }

    /**
     * Función que nos permite recuperar la información de un documento de la 
     * base de datos
     * @param type $id_documento Identificador del documento a recuperar
     * @return type Devuelve el resultado de la consulta a la base de datos
     * @throws Exception Lanza una excepción si se produce un error
     */
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
            throw new Exception($this->dwes->errorInfo()[2], $this->dwes->errorInfo()[1]);
        }
    }

    /**
     * Función para recuperar el número de registro mas grande de los distintos 
     * tipos de registro
     * @param type $tipo Tipo de registro del que se quiere recuperar el número
     * @return type String Numero de registro más grande dependidendo del tipo
     * @throws Exception Lanza una excepción si se produce un error
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
            throw new Exception($this->dwes->errorInfo()[2], $this->dwes->errorInfo()[1]);
        }
    }
    
    /**
     * Función que nos permite validar un usuario contra la base de datos
     * @param type $usuario Usuario a validar
     * @param type $password Contraseña a validar
     * @return type True si es un usuario correcto, False si no lo es
     * @throws Exception Se lanza una excepción si se produce un error
     */
    public function validarUsuario($usuario, $password)
    {
        // Especificamos la consulta que vamos a realizar sobre la base de datos        
        $sql = "select * from usuario where user='$usuario' and pass='$password'";
        
        // Llamamos la a la función protegida de la clase para realizar la consulta
        $resultado = $this->ejecutaConsulta($sql);

        // Comprobamos si hemos obtenido algún resultado
        if ($resultado) {
            
            // Devolvemos el resultado pasandolo a booleano
            return $resultado->fetch() ? TRUE: FALSE;
        } else {
            // Si no tenemos resultados lanzamos una excepción
            throw new Exception($this->dwes->errorInfo()[2], $this->dwes->errorInfo()[1]);
        }        
    }

}
