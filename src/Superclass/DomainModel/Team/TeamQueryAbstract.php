<?php

namespace Superclass\DomainModel\Team;

abstract class TeamQueryAbstract {
    protected $id;
    protected $name;
    protected $vision;
    protected $mission;
    protected $culture;
    protected $founderAgreement;
    protected $cityRDO;
    protected $isRemoved;
    
    function getId() {
        return $this->id;
    }
    function getName() {
        return $this->name;
    }
    function getVision() {
        return $this->vision;
    }
    function getMission() {
        return $this->mission;
    }
    function getCulture() {
        return $this->culture;
    }
    function getIsRemoved(){
        return $this->isRemoved;
    }
    function getFounderAgreement() {
        return $this->founderAgreement;
    }
    /**
     * @return CityReadDataObject
     */
    function cityRDO() {
        return $this->cityRDO;
    }
}
