<?php

namespace Team\Idea\DomainModel\Superhero\DataObject;

use Resources\IReadDataObject;

class SuperheroReadDataObject implements IReadDataObject{
    protected $id;
    protected $name;
    protected $mainDuty;
    protected $specialAbility;
    protected $dailyActivity;
    protected $alternativeTechnology;
    protected $isRemoved = false;
    
    function getId() {
        return $this->id;
    }
    function getName() {
        return $this->name;
    }
    function getMainDuty() {
        return $this->mainDuty;
    }
    function getSpecialAbility() {
        return $this->specialAbility;
    }
    function getDailyActivity() {
        return $this->dailyActivity;
    }
    function getAlternativeTechnology() {
        return $this->alternativeTechnology;
    }
    function getIsRemoved() {
        return $this->isRemoved;
    }
    
    function __construct($id, $name, $mainDuty, $specialAbility, $dailyActivity, $alternativeTechnology, $isRemoved) {
        $this->id = $id;
        $this->name = $name;
        $this->mainDuty = $mainDuty;
        $this->specialAbility = $specialAbility;
        $this->dailyActivity = $dailyActivity;
        $this->alternativeTechnology = $alternativeTechnology;
        $this->isRemoved = $isRemoved;
    }

        function toArray(){
        return array(
            'id' => $this->getId(),
            'name' => $this->getName(),
            'main_duty' => $this->getMainDuty(),
            'special_ability' => $this->getSpecialAbility(),
            'daily_activity' => $this->getDailyActivity(),
            'alternative_technology' => $this->getAlternativeTechnology(),
            'is_removed' => $this->getIsRemoved()
        );
    }
}
