<?php

namespace Superclass\DomainModel\Track;

use Resources\IReadDataObject;

class TrackReadDataObject implements IReadDataObject{
    protected $id;
    protected $name;
    protected $description;
    protected $isRemoved;
    
    function getId() {
        return $this->id;
    }
    function getName() {
        return $this->name;
    }
    function getDescription() {
        return $this->description;
    }
    function getIsRemoved() {
        return $this->isRemoved;
    }

    function __construct($id, $name, $description, $isRemoved) {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->isRemoved = $isRemoved;
    }

    
    function toArray(){
        return array(
            'id' => $this->getId(),
            'name' => $this->getName(),
            'description' => $this->getDescription(),
            'is_removed' => $this->getIsRemoved(),
        );
    }
}
