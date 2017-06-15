<?php

namespace Team\Profile\DomainModel\Team\DataObject;

class TeamWriteDataObject {
    protected $name;
    protected $vision;
    protected $mission;
    protected $culture;
    protected $founderAgreement;
    
    function getName(){
        return $this->name;
    }
    function getVision(){
        return $this->vision;
    }
    function getMission(){
        return $this->mission;
    }
    function getCulture(){
        return $this->culture;
    }
    function getFounderAgreement(){
        return $this->founderAgreement;
    }
    
    protected function __construct($name, $vision, $mission, $culture, $founderAgreement) {
        $this->name = $name;
        $this->vision = $vision;
        $this->mission = $mission;
        $this->culture = $culture;
        $this->founderAgreement = $founderAgreement;
    }
    
    static function request($name, $vision, $mission, $culture, $founderAgreement){
        return new static($name, $vision, $mission, $culture, $founderAgreement);
    }
}
