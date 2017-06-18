<?php

namespace Team\Idea\DomainModel\Superhero;

use Resources\IReadDataObject;
use Superclass\DomainModel\Talent\TalentReadDataObject;
use Team\Idea\DomainModel\Talent\TalentQuery;

class SuperheroRdo implements IReadDataObject{
    protected $id;
    protected $name;
    protected $mainDuty;
    protected $specialAbility;
    protected $dailyActivity;
    protected $alternativeTechnology;
    protected $isRemoved = false;
    /**
     * @var TalentQuery
     */
    protected $talentQuery;
    
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
    /**
     * @return TalentQuery
     */
    function talentQuery() {
        return $this->talentQuery;
    }
    
    protected function __construct($id, $name, $mainDuty, $specialAbility, $dailyActivity, $alternativeTechnology, $isRemoved, TalentQuery $talentQuery) {
        $this->id = $id;
        $this->name = $name;
        $this->mainDuty = $mainDuty;
        $this->specialAbility = $specialAbility;
        $this->dailyActivity = $dailyActivity;
        $this->alternativeTechnology = $alternativeTechnology;
        $this->isRemoved = $isRemoved;
        $this->talentQuery = $talentQuery;
    }

    public function toArray() {
        return array(
            'id' => $this->getId(),
            'name' => $this->getName(),
            'main_duty' => $this->getMainDuty(),
            'special_ability' => $this->getSpecialAbility(),
            'daily_activity' => $this->getDailyActivity(),
            'alternative_technology' => $this->getAlternativeTechnology(),
            'talent' => $this->talentQuery->toArray(), 
            'is_removed' => $this->getIsRemoved(),
        );
    }

}
