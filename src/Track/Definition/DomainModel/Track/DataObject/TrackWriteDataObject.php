<?php

namespace Track\Definition\DomainModel\Track\DataObject;

class TrackWriteDataObject {
    protected $name;
    protected $description;
    
    function getName(){
        return $this->name;
    }
    function getDescription(){
        return $this->description;
    }
    
    protected function __construct($name, $description) {
        $this->name = $name;
        $this->description = $description;
    }
    
    static function request($name, $description){
        return new static($name, $description);
    }
}
