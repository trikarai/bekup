<?php

namespace Superclass\DomainModel\Track;

abstract class TrackAbstract {
    protected $id;
    protected $name;
    protected $description;
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
     * @return \Superclass\DomainModel\Track\TrackReadDataObject
     */
    function toReadDataObject(){
        return new TrackReadDataObject($this->id, $this->name, $this->description, $this->isRemoved);
    }
    
}
