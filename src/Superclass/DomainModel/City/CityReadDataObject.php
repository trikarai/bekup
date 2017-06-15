<?php

namespace Superclass\DomainModel\City;

use Resources\IReadDataObject;

class CityReadDataObject implements IReadDataObject{
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

    function __construct($id, $name, $isRemoved) {
        $this->id = $id;
        $this->name = $name;
        $this->isRemoved = $isRemoved;
    }
    
    function toArray(){
        return array(
            'id' => $this->getId(),
            'name' => $this->getName(),
            'is_removed' => $this->getIsRemoved(),
        );
    }
}
