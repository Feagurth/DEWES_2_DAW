<?php

/*
 * Copyright (C) 2015 Luis Cabreizo Gómez
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

/**
 * clase para almacenar y trabajar con los registros de entrada de documentos
 *
 * @author Luis Cabrerizo Gomez
 */
class Registro {
    
    /**
     * Variable para almacenar el id del registros
     * @var Integer
     */
    private $id;
    
    /**
     * Variable para almacenar el número de registro
     * @var String
     */
    private $nreg;
    
    /**
     * Variable para almacenar el tipo de documento
     * @var String
     */
    private $tipodoc;
    
    /**
     * Variable para almacenar la fecha de entrada o salida del registro
     * @var Date YYYY-mm-dd
     */
    private $fecha;
    
    /**
     * Variable para almacenar el nombre del remitente
     * @var Cadena
     */
    private $remitente;
    
    /**
     * Variable para almacenar el nombre del destinatario
     * @var Candea
     */
    private $destinatario;
    
    /**
     * Variable para almacenar si el registro tiene un fichero escaneado asignado
     * @var Boolean
     */
    private $escaneado;
    
    /**
     * Variable para almacenar el id del fichero escaneado
     * @var type 
     */
    private $iddocumento;

    public function __construct($row) {        
        $this->id = $row['id'];
        $this->nreg = $row['nreg'];
        $this->tipodoc = $row['tipodoc'];
        $this->fecha = $row['fecha'];
        $this->remitente = $row['remit'];
        $this->destinatario = $row['dest'];
        $this->escaneado = $row['esc'];
        $this->iddocumento = $row['id_documento'];
    }    
    
    
    /**
     * Método que devuelve el identificador del registro
     * @return Integer
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Método que devuelve el número de registro
     * @return String
     */
    public function getNreg() {
        return $this->nreg;
    }

    /**
     * Método que devuelve el tipo de documento del registro
     * @return String
     */
    public function getTipodoc() {
        return $this->tipodoc;
    }

    /**
     * Método que devuelve la fecha del registro
     * @return Date
     */
    public function getFecha() {
        return $this->fecha;
    }

    /**
     * Método que devuelve el remitente del registro
     * @return String
     */
    public function getRemitente() {
        return $this->remitente;
    }

    /**
     * Método que devuelve el destinatario del registro
     * @return String
     */
    public function getDestinatario() {
        return $this->destinatario;
    }

    /**
     * Método que devuelve si registro tiene un documento escaneado
     * @return Boolean
     */
    public function getEscaneado() {
        return $this->escaneado;
    }

    /**
     * Método que devuelve el identificador del archivo asociado al registro
     * @return Integer
     */
    public function getIddocumento() {
        return $this->iddocumento;
    }

    /**
     * Método que nos permite asignar el número de registro al registro
     * @param type $nreg Número del registro
     */
    public function setNreg($nreg) {
        $this->nreg = $nreg;
    }

    /**
     * Método que nos permite asignar el tipo de documento  al registro
     * @param type $tipodoc Tipo de documento del registro
     */
    public function setTipodoc($tipodoc) {
        $this->tipodoc = $tipodoc;
    }

    /**
     * Método que nos permite asignar la fecha al registro
     * @param type $fecha La fecha del registro
     */
    public function setFecha($fecha) {
        $this->fecha = $fecha;
    }

    /**
     * Método que nos permite asignar el remitente al registro
     * @param type $remitente El remitente del registro
     */
    public function setRemitente($remitente) {
        $this->remitente = $remitente;
    }

    /**
     * Método que nos permite asignar el destinatario al registro
     * @param type $destinatario
     */
    public function setDestinatario($destinatario) {
        $this->destinatario = $destinatario;
    }

    /**
     * Método que nos permite asignar al registro si tiene un archivo asociado
     * @param type $escaneado 1 si tiene un archivo asociado, 0 si no lo tiene
     */
    public function setEscaneado($escaneado) {
        $this->escaneado = $escaneado;
    }

    /**
     * Método que nos permite asignar el identificador del fichero asociado al registro
     * @param type $iddocumento El identificador del fichero asociado
     */
    public function setIddocumento($iddocumento) {
        $this->iddocumento = $iddocumento;
    }

}
