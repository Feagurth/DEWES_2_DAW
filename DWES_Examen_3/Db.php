<?php

require_once './configuracion.inc.php';

/**
 * Clase para trabajar con la base de datos
 * 
 * @package Db
 */
class DB {

    /**
     * Objeto que almacenará la base de datos PDO
     * @var type PDO Object
     */
    private $diw;

// <editor-fold defaultstate="collapsed" desc=" Constructor ">

    /**
     * Constructor de la base de datos
     * @global string $serv Servidor donde está alojada el servidor de base de datos
     * @global string $base Nombre de la base de datos
     * @global string $usu Usuario de acceso a la base de datos
     * @global string $pas Contraseña para acceder a la base de datos
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
            $this->diw = new PDO($dsn, $usu, $pas, $opc);

            $this->diw->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (Exception $ex) {
            throw $ex;
        }
    }

// </editor-fold>
// <editor-fold defaultstate="collapsed" desc=" Funciones Generales ">
    /**
     * Método que nos permite realizar consultas a la base de datos
     * @param type $sql Sentencia sql a ejecutar
     * @return type Resultado de la consulta
     * @throws Exception Lanzamos una excepción si se produce un error
     */
    private function ejecutaConsulta($sql) {

        try {
            // Comprobamos si el objeto se ha creado correctamente
            if (isset($this->diw)) {

                // De ser así, realizamos la consulta
                $resultado = $this->diw->query($sql);

                // Devolvemos el resultado
                return $resultado;
            }
        } catch (Exception $ex) {
            // Si se produce un error, lanzamos una excepción
            throw $ex;
        }
    }

    /**
     * Función que nos permite realizar consultas a la base de datos en forma consulta preparada
     * @param type $sql Sentencia sql a ejecutar
     * @param array $datos Datos a almacenar en forma de array
     * @return string El resultado de la operación
     * @throws Exception Lanza una excepción si se produce un error
     */
    private function ejecutaConsultaPreparada($sql, array $datos) {

        try {
            // Preaparamos una sentencia para la insercción del 
            // fichero en la tabla documentos            
            $stmt = $this->diw->prepare($sql);

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

// </editor-fold>

    /**
     * Función que nos permite recuperar los datos de usuario de la base de datos
     * @return string[] Un array con los valores de usuarios
     * @throws Exception Si se produce un error se lanza una excepción
     */
    function listarUsuarios() {
        
        // Especificamos la consulta que vamos a realizar sobre la base de datos
        $sql = "SELECT * FROM usuariosapp";
        $orden = " ORDER BY id ASC";

        // Concatenamos el orden a la cadena sql
        $sql .= $orden;

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
            throw new Exception();
        }        
        
    }
    
    /**
     * Función que nos permite eliminar un usuario de la base de datos
     * @param int $id_usuario Identificador del usuario a borrar
     * @return int 0 si todo es correcto, otro número en caso contrario
     * @throws Exception Si se produce un error se lanza una excepción
     */
    public function eliminarUsuario($id_usuario) {
        // Creamos la consulta de borrado usando el identificador del grupo
        $sql = "DELETE FROM usuariosapp where id = " . $id_usuario . ";";

        // Llamamos la a la función protegida de la clase para realizar la consulta
        $resultado = self::ejecutaConsulta($sql);

        // Comprobamos el resultado
        if ($resultado) {
            // Si es correcto, devolvemos 0
            return 0;
        } else {
            // En caso contrario, lanzamos una excepción
            throw new Exception($this->diw->errorInfo()[2], $this->diw->errorInfo()[1]);
        }
    } 
    
    
    /**
     * Función que nos permite validar un usuario contra la base de datos
     * @param string $usuario Nombre del usuario
     * @param string $password Password del usuario en formato md5
     * @return bool True si está validado, False si no lo está
     * @throws Exception Si se produce un error se lanza una excepción
     */
    public function validarUsuario($usuario, $password) {

        // Especificamos la consulta que vamos a realizar sobre la base de datos        
        $sql = "select * from usuariosapp where usuario='$usuario' and password='$password'";

        // Llamamos la a la función protegida de la clase para realizar la consulta
        $resultado = $this->ejecutaConsulta($sql);

        // Comprobamos si hemos obtenido algún resultado
        if ($resultado) {

            $valores = $resultado->fetch();

            // Devolvemos el resultado pasandolo a booleano
            return $valores ? TRUE : FALSE;
        } else {
            // Si no tenemos resultados lanzamos una excepción
            throw new Exception($this->diw->errorInfo()[2], $this->diw->errorInfo()[1]);
        }
    }}
