<?php

namespace Talent\Entrepreneurship\DomainModel\Entrepreneurship;

use Resources\IReadDataObject;
use Talent\Entrepreneurship\DomainModel\Entrepreneurship\ValueObject\EntrepreneurshipTime;
use Talent\Entrepreneurship\DomainModel\Talent\TalentQuery;

class EntrepreneurshipRdo implements IReadDataObject{
    protected $id;
    protected $name;
    protected $businessField;
    protected $businessCategory;
    protected $position;
    protected $isRemoved;
    /**
     * @var EntrepreneurshipTime
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
    function getBusinessField() {
        return $this->businessField;
    }
    function getBusinessCategory() {
        return $this->businessCategory;
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
    
    protected function __construct($id, $name, $businessField, $businessCategory, $position, $isRemoved, EntrepreneurshipTime $time, TalentQuery $talentQuery) {
        $this->id = $id;
        $this->name = $name;
        $this->businessField = $businessField;
        $this->businessCategory = $businessCategory;
        $this->position = $position;
        $this->isRemoved = $isRemoved;
        $this->time = $time;
        $this->talentQuery = $talentQuery;
    }

    public function toArray() {
        return array(
            'id' => $this->getId(),
            'name' => $this->getName(),
            'business_field' => $this->getBusinessField(),
            'business_category' => $this->getBusinessCategory(),
            'position' => $this->getPosition(),
            'start_year' => $this->getStartYear(),
            'end_year' => $this->getEndYear(),
            'is_removed' => $this->getIsRemoved(),
        );
    }

}
