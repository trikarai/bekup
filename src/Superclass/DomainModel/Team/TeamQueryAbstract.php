<?php

namespace Superclass\DomainModel\Team;

use Superclass\DomainModel\City\CityReadDataObject;

abstract class TeamQueryAbstract {
    protected $id;
    protected $name;
    protected $vision;
    protected $mission;
    protected $culture;
    protected $founderAgreement;
    /**
     * @var CityReadDataObject
     */
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
    
    protected function __construct($id, $name, $vision, $mission, $culture, $founderAgreement, CityReadDataObject $cityRDO, $isRemoved) {
        $this->id = $id;
        $this->name = $name;
        $this->vision = $vision;
        $this->mission = $mission;
        $this->culture = $culture;
        $this->founderAgreement = $founderAgreement;
        $this->cityRDO = $cityRDO;
        $this->isRemoved = $isRemoved;
    }
    
    function toArray(){
        return array(
            'id' => $this->getId(),
            'name' => $this->getName(),
            'vision' => $this->getVision(),
            'mission' => $this->getMission(),
            'culture' => $this->getCulture(),
            'founder_agreement' => $this->getFounderAgreement(),
            'city' => $this->cityRDO()->toArray(),
        );
    }

    

}
