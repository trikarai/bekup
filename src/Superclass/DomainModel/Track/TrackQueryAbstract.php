<?php

namespace Superclass\DomainModel\Track;

abstract class TrackQueryAbstract {
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
}
