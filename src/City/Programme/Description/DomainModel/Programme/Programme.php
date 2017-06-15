<?php

namespace City\Programme\Description\DomainModel\Programme;

use Superclass\DomainModel\City\CityAbstract;
use Programme\Description\DomainModel\Programme\DataObject\ProgrammeReadDataObject as ReferenceProgrammeRdo;
use City\Programme\Description\DomainModel\City\City;

class Programme{
    protected $id;
    protected $referenceProgrammeId;
    protected $isOffline = false;
    protected $isRemoved = false;
    
    protected $city;
    
    function getId(){
        return $this->id;
    }
    function getReferenceProgrammeId() {
        return $this->referenceProgrammeId;
    }
    function getIsRemoved(){
        return $this->isRemoved;
    }
    
    /**
     * @param City $city
     * @param type $id
     * @param type $referenceProgrammeId
     * @param type $isOffline
     */
    public function __construct(City $city, $id, $referenceProgrammeId, $isOffline = false) {
        $this->id = $id;
        $this->referenceProgrammeId = $referenceProgrammeId;
        $this->isOffline = $isOffline;
        $this->city = $city;
    }
    
    function setOnline(){
        $this->isOffline = false;
    }
    function setOffline(){
        $this->isOffline = true;
    }
    function remove(){
        $this->isRemoved = true;
    }
}
