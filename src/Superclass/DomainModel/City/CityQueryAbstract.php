<?php

namespace Superclass\DomainModel\City;

abstract class CityQueryAbstract {
    protected $id;
    protected $name;
    protected $isRemoved;
    
    function getId() {
        return $this->id;
    }
    function getName() {
        return $this->name;
    }
    function getIsRemoved(){
        return $this->isRemoved;
    }
}
