<?php

namespace City\Profile\DomainModel\City;

use Superclass\DomainModel\City\CityAbstract;

class City extends CityAbstract{
    
    public function __construct($id, $name) {
        $this->id = $id;
        $this->name = $name;
    }
    
    /**
     * @param string $name
     */
    function change($name){
        $this->name = $name;
    }
    
    function remove(){
        $this->isRemoved = true;
    }
}