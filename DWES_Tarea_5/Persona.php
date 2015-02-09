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
 * Clase para contener y trabajar con los datos de personas
 *
 * @author Luis Cabrerizo Gómez
 */
class Persona {

    /**
     * Identificador de la persona
     * @var type Integer
     */
    private $id_persona;
    
    /**
     * Nombre de la persona
     * @var type String
     */
    private $nombre;
    
    /**
     * Primer Apellido de la persona
     * @var type String
     */
    private $apellido1;
    
    /**
     * Segundo Apellido de la persona
     * @var type 
     */
    private $apellido2;

    /**
     * Constructor de la clase Persona
     * @param type $row Array de valores
     */
    public function __construct($row) {
        $this->id_persona = $row['id_persona'];
        $this->nombre = $row['nombre'];
        $this->apellido1 = $row['apellido1'];
        $this->apellido2 = $row['apellido2'];
    }

    
    /**
     * Función que nos permite recuperar el valor del identificador de la persona
     * @return type Integer
     */
    public function getId_persona() {
        return $this->id_persona;
    }

    /**
     * Función que nos permite recuperar el valor del nombre de la persona
     * @return type String
     */
    public function getNombre() {
        return $this->nombre;
    }

    /**
     * Función que nos permite recuperar el valor del primer apellido de la persona
     * @return type String
     */
    public function getApellido1() {
        return $this->apellido1;
    }

    /**
     * Función que nos permite recuperar el valor del segundo apellido de la persona
     * @return type String
     */
    public function getApellido2() {
        return $this->apellido2;
    }

    /**
     * Función que nos permite asginar el valor del identificador de la persona
     * @param type $id_persona Integer
     */
    public function setId_persona($id_persona) {
        $this->id_persona = $id_persona;
    }

    /**
     * Función que nos permite asginar el valor del nombre de la persona
     * @param type $nombre String
     */
    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    /**
     * Función que nos permite asginar el valor del primer apellido de la persona
     * @param type $apellido1 String
     */
    public function setApellido1($apellido1) {
        $this->apellido1 = $apellido1;
    }

    /**
     * Función que nos permite asginar el valor del segundo apellido de la persona
     * @param type $apellido2 String
     */
    public function setApellido2($apellido2) {
        $this->apellido2 = $apellido2;
    }

}
