<?php

namespace Team\Idea\DomainModel\Superhero;

use Team\Idea\DomainModel\Superhero\DataObject\SuperheroWriteDataObject;
use Team\Idea\DomainModel\Superhero\DataObject\SuperheroReadDataObject;
use Team\Idea\DomainModel\Talent\Talent;

class Superhero {
    protected $id;
    protected $name;
    protected $mainDuty;
    protected $specialAbility;
    protected $dailyActivity;
    protected $alternativeTechnology;
    protected $isRemoved = false;

    protected $talent;
    
    function getId(){
        return $this->id;
    }
    function getName(){
        return $this->name;
    }
    function getIsRemoved(){
        return $this->isRemoved;
    }
    /**
     * @return SuperheroReadDataObject
     */
    function toReadDataObject(){
        return new SuperheroReadDataObject($this->id, $this->name, $this->mainDuty, 
                $this->specialAbility, $this->dailyActivity, $this->alternativeTechnology, $this->isRemoved);
    }

//CONSTRUCTOR
    /**
     * @param integer $id
     * @param SuperheroWriteDataObject $request
     * @param Talent $talent
     */
    public function __construct($id, SuperheroWriteDataObject $request, Talent $talent) {
        $this->id = $id;
        $this->name = $request->getName();
        $this->mainDuty = $request->getMainDuty();
        $this->specialAbility = $request->getSpecialAbility();
        $this->dailyActivity = $request->getDailyActivity();
        $this->alternativeTechnology = $request->getAlternativeTechnology();
        $this->talent = $talent;
    }

//MUTATOR
    /**
     * @param SuperheroWriteDataObject $request
     */
    function change(SuperheroWriteDataObject $request){
        $this->name = $request->getName();
        $this->mainDuty = $request->getMainDuty();
        $this->specialAbility = $request->getSpecialAbility();
        $this->dailyActivity = $request->getDailyActivity();
        $this->alternativeTechnology = $request->getAlternativeTechnology();
    }
    function remove(){
        $this->isRemoved = true;
    }
}
