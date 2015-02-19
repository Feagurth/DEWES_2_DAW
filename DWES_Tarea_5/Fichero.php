<?php

/*
 * Copyright (C) 2015 Luis Cabrerizo Gómez
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
 * Clase para almacenar los ficheros incluidos en la base de datos
 *
 * @author Luis Cabrerizo Gómez
 */
class Fichero {

    /**
     * Identificador del fichero
     * @var type Integer
     */
    private $id_documento;

    /**
     * Tamaño del fichero
     * @var type Integer
     */
    private $tamanyo;

    /**
     * Tipo de fichero expresado en código MIME
     * @var type String
     */
    private $tipo;

    /**
     * Nombre del fichero
     * @var type String
     */
    private $nombre;

    /**
     * Fichero en binario
     * @var type Stream
     */
    private $documento;

    /**
     * Método que nos permite recuperar el Id del documento
     * @return type Integer
     */
    public function getId_documento() {
        return $this->id_documento;
    }

    /**
     * Método que nos permite recuperar el tamaño del documento
     * @return type Integer
     */
    public function getTamanyo() {
        return $this->tamanyo;
    }

    /**
     * Método que nos permite recuperar el tipo del documento en formato MIME
     * @return type String
     */
    public function getTipo() {
        return $this->tipo;
    }

    /**
     * Método que nos permite recuperar el nombre del documento
     * @return type String
     */
    public function getNombre() {
        return $this->nombre;
    }

    /**
     * Método que nos permite recuperar el documento
     * @return type Stream
     */
    public function getDocumento() {
        return $this->documento;
    }

    /**
     * Método que nos permite asignar el Id del documento
     * @param type $id_documento Integer
     */
    public function setId_documento($id_documento) {
        $this->id_documento = $id_documento;
    }

    /**
     * Método que nos permite asignar el tamaño del documento
     * @param type $tamanyo Integer
     */
    public function setTamanyo($tamanyo) {
        $this->tamanyo = $tamanyo;
    }

    /**
     * Método que nos permite asignar el tipo del documento
     * @param type $tipo String
     */
    public function setTipo($tipo) {
        $this->tipo = $tipo;
    }

    /**
     * Método que nos permite asignar el nombre del documento
     * @param type $nombre String
     */
    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    /**
     * Método que nos permite asignar el documento
     * @param type $documento Stream
     */
    public function setDocumento($documento) {
        $this->documento = $documento;
    }

}
