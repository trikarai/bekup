<?php

namespace Superclass\DomainModel\Team;

use Superclass\DomainModel\City\CityReadDataObject;

abstract class TeamAbstract {
    protected $id;
    protected $name;
    protected $vision;
    protected $mission;
    protected $culture;
    protected $founderAgreement;
    
    /** @var CityReadDataObject */
    protected $cityRDO;
    protected $isRemoved = false;
    
    function getId(){
        return $this->id;
    }
    function getName(){
        return $this->name;
    }
    function getIsRemoved(){
        return $this->isRemoved;
    }
    /** @return CityReadDataObject */
    function CityRDO(){
        return $this->cityRDO;
    }
    /**
     * @return \Superclass\DomainModel\Team\TeamReadDataObject
     */
    function toReadDataObject(){
        return new TeamReadDataObject($this->id, $this->name, $this->vision, 
                $this->mission, $this->culture, $this->founderAgreement, $this->cityRDO);
    }
}
