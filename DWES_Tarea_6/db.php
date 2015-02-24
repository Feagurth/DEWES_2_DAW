<?php

require_once './configuracion.inc.php';

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

            $this->dwes->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
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
     * Método que nos permite devolver el PVP de un producto a partir de su código
     * @param type $codProducto Código del pruducto
     * @return type double El PVP del producto
     * @throws Exception Se lanza una excepción si se produce un error
     */
    public function getPVP($codProducto) {

        // Especificamos la consulta que vamos a realizar sobre la base de datos
        $sql = "SELECT pvp FROM producto where cod = '$codProducto';";

        // Llamamos la a la función protegida de la clase para realizar la consulta
        $resultado = $this->ejecutaConsulta($sql);

        // Comprobamos si hemos obtenido algún resultado
        if ($resultado) {

            // Añadimos un elemento por cada registro de entrada obtenido
            $row = $resultado->fetch();

            // Devolvemos el resultado
            return $row[0];
        } else {
            // Si no tenemos resultados lanzamos una excepción
            throw new Exception($this->dwes->errorInfo()[2], $this->dwes->errorInfo()[1]);
        }
    }

    /**
     * Método que nos permite devolver el stock de un producto en una tienda específica
     * @param type $codProducto Codigo del producto cuyo stock queremos recuperar
     * @param type $codTienda Codigo de la tienda donde localizar el stock
     * @return type Integer Stock del artículo especificado en la tienda especificada
     * @throws Exception Se produce una escepción si hay algún error
     */
    public function getStock($codProducto, $codTienda) {

        // Especificamos la consulta que vamos a realizar sobre la base de datos
        $sql = "SELECT unidades FROM stock where producto = '$codProducto' and tienda='$codTienda';";

        // Llamamos la a la función protegida de la clase para realizar la consulta
        $resultado = $this->ejecutaConsulta($sql);

        // Comprobamos si hemos obtenido algún resultado
        if ($resultado) {

            // Añadimos un elemento por cada registro de entrada obtenido
            $row = $resultado->fetch();

            // Devolvemos el resultado
            return $row[0];
        } else {
            // Si no tenemos resultados lanzamos una excepción
            throw new Exception($this->dwes->errorInfo()[2], $this->dwes->errorInfo()[1]);
        }
    }

    /**
     * Método que nos permite recuperar los códigos de todas las familias
     * @return type Array Códigos de las familias
     * @throws Exception Se lanza una excepción si se produce un error
     */
    public function getFamilias() {

        // Especificamos la consulta que vamos a realizar sobre la base de datos
        $sql = "SELECT cod FROM familia;";

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

                // Asignamos el valor de la fila al array
                $datos[] = $row[0];

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
     * Método que nos permite recuperar todos los products de una familia específica
     * @param type $codFamilia Código de familia de los productos a listar
     * @return type Array Todos los productos que tenga el código familia introducido
     * @throws Exception Se lanza una excepción si se produce un error
     */
    public function getProductosFamilia($codFamilia) {

        // Especificamos la consulta que vamos a realizar sobre la base de datos
        $sql = "SELECT COD FROM PRODUCTO WHERE FAMILIA = '$codFamilia';";

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

                // Asignamos el valor de la fila al array
                $datos[] = $row[0];

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

}
