<?php

namespace Talent\Skill\DomainModel\Skill\DataObject;

use Resources\IReadDataObject;
use Superclass\DomainModel\Track\TrackReadDataObject;

class SkillReadDataObject implements IReadDataObject{
    protected $id;
    protected $name;
    protected $trackReadDataObject;
    protected $isRemoved = false;
    
    function getId() {
        return $this->id;
    }
    function getName() {
        return $this->name;
    }
    /**
     * @return TrackReadDataObject
     */
    function trackReadDataObject() {
        return $this->trackReadDataObject;
    }
    function getIsRemoved() {
        return $this->isRemoved;
    }
    
    function __construct($id, $name, TrackReadDataObject $trackReadDataObject, $isRemoved) {
        $this->id = $id;
        $this->name = $name;
        $this->trackReadDataObject = $trackReadDataObject;
        $this->isRemoved = $isRemoved;
    }

    
    /**
     * @return array
     */
    public function toArray() {
        return array(
            'id' => $this->getId(),
            'name' => $this->getName(),
            'track' => $this->trackReadDataObject()->toArray(),
            'is_removed' => $this->getIsRemoved(),
        );
    }
}
