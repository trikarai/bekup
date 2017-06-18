<?php

namespace Talent\Organizational\DomainModel\Organizational;

use Talent\Entrepreneurship\DomainModel\Talent\TalentQuery;
use Talent\Organizational\DomainModel\Organizational\ValueObject\OrganizationalTime;
use Resources\IReadDataObject;

class OrganizationalRdo implements IReadDataObject{
    protected $id;
    protected $name;
    protected $position;
    protected $isRemoved;
    /**
     * @var OrganizationalTime
     */
    protected $time;
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
    function getPosition() {
        return $this->position;
    }
    function getIsRemoved() {
        return $this->isRemoved;
    }
    function getStartYear(){
        return $this->time->getStartYear();
    }
    function getEndYear(){
        return $this->time->getEndYear();
    }
    
    protected function __construct($id, $name, $position, $isRemoved, OrganizationalTime $time, TalentQuery $talentQuery) {
        $this->id = $id;
        $this->name = $name;
        $this->position = $position;
        $this->isRemoved = $isRemoved;
        $this->time = $time;
        $this->talentQuery = $talentQuery;
    }

    public function toArray() {
        return array(
            'id' => $this->getId(),
            'name' => $this->getName(),
            'position' => $this->getPosition(),
            'start_year' => $this->getStartYear(),
            'end_year' => $this->getEndYear(),
            'is_removed' => $this->getIsRemoved(),
        );
    }

}
