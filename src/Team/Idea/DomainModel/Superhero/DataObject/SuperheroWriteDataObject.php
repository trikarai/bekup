<?php

namespace Team\Idea\DomainModel\Superhero\DataObject;

class SuperheroWriteDataObject{
    protected $name;
    protected $mainDuty;
    protected $specialAbility;
    protected $dailyActivity;
    protected $alternativeTechnology;
    
    function getName(){
        return $this->name;
    }
    function getMainDuty(){
        return $this->mainDuty;
    }
    function getSpecialAbility(){
        return $this->specialAbility;
    }
    function getDailyActivity(){
        return $this->dailyActivity;
    }
    function getAlternativeTechnology(){
        return $this->alternativeTechnology;
    }
    
    protected function __construct($name, $mainDuty, $specialAbility, 
            $dailyActivity, $alternativeTechnology
    ) {
        $this->name = $name;
        $this->mainDuty = $mainDuty;
        $this->specialAbility = $specialAbility;
        $this->dailyActivity = $dailyActivity;
        $this->alternativeTechnology = $alternativeTechnology;
    }
    
    static function request($name, $mainDuty, $specialAbility, $dailyActivity, $alternativeTechnology){
        return new static($name, $mainDuty, $specialAbility, $dailyActivity, $alternativeTechnology);
    }
    
}
