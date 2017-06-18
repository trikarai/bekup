<?php

namespace Talent\Entrepreneurship\DomainModel\Entrepreneurship\DataObject;

class EntrepreneurshipWriteDataObject {
    protected $name;
    protected $businessField;
    protected $businessCategory;
    protected $position;
    protected $startYear;
    protected $endYear;
    
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
    function getStartYear() {
        return $this->startYear;
    }
    function getEndYear() {
        return $this->endYear;
    }

    protected function __construct($name, $businessField, $businessCategory, $position, $startYear, $endYear) {
        $this->name = $name;
        $this->businessField = $businessField;
        $this->businessCategory = $businessCategory;
        $this->position = $position;
        $this->startYear = $startYear;
        $this->endYear = $endYear;
    }
    static function request($name, $businessField, $businessCategory, $position, $startYear, $endYear){
        return new static($name, $businessField, $businessCategory, $position, $startYear, $endYear);
    }
}
