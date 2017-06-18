<?php

namespace Talent\Organizational\DomainModel\Organizational\DataObject;

class OrganizationalWriteDataObject {
    protected $name;
    protected $position;
    protected $startYear;
    protected $endYear;
    
    function getName() {
        return $this->name;
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

    protected function __construct($name, $position, $startYear, $endYear) {
        $this->name = $name;
        $this->position = $position;
        $this->startYear = $startYear;
        $this->endYear = $endYear;
    }
    
    static function request($name, $position, $startYear, $endYear){
        return new static($name, $position, $startYear, $endYear);
    }
}
