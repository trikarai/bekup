<?php

namespace Talent\Skill\DomainModel\Skill;

use Superclass\DomainModel\Track\TrackReadDataObject;
use Talent\Skill\DomainModel\Skill\DataObject\SkillReadDataObject;

class Skill {
    protected $id;
    protected $name;
    protected $trackReadDataObject;
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
    
    /**
     * @return SkillReadDataObject
     */
    function toReadDataObject(){
        return new SkillReadDataObject($this->id, $this->name, $this->trackReadDataObject, $this->isRemoved);
    }
    
    /**
     * @param type $id
     * @param type $name
     * @param TrackReadDataObject $trackReadDataobject
     */
    public function __construct($id, $name, TrackReadDataObject $trackReadDataobject) {
        $this->id = $id;
        $this->name = $name;
        $this->trackReadDataObject = $trackReadDataobject;
    }
    
    /**
     * @param type $name
     * @param TrackReadDataObject $trackReadDataobject
     */
    function change($name, TrackReadDataObject $trackReadDataobject){
        $this->name = $name;
        $this->trackReadDataObject = $trackReadDataobject;
    }
    
    function remove(){
        $this->isRemoved = true;
    }
}
