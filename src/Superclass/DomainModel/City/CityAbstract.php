<?php

namespace Superclass\DomainModel\City;

abstract class CityAbstract {
    protected $id;
    protected $name;
    protected $isRemoved = false;
    
    function getId(){
        return $this->id;
    }
    function getName() {
        return $this->name;
    }
    function getIsRemoved() {
        return $this->isRemoved;
    }

    /**
     * @return \Superclass\DomainModel\City\CityReadDataObject
     */
    function toReadDataObject(){
        return new CityReadDataObject($this->id, $this->name, $this->isRemoved);
    }
    
}
