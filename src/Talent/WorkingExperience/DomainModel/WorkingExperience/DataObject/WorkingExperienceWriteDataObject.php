<?php

namespace Talent\WorkingExperience\DomainModel\WorkingExperience\DataObject;

class WorkingExperienceWriteDataObject {
    protected $companyName;
    protected $position;
    protected $role;
    protected $startYear;
    protected $endYear;
    
    function getCompanyName(){
        return $this->companyName;
    }
    function getPosition(){
        return $this->position;
    }
    function getRole(){
        return $this->role;
    }
    function getStartYear(){
        return $this->startYear;
    }
    function getEndYear(){
        return $this->endYear;
    }
    
    protected function __construct($companyName, $position, $role, $startYear, $endYear = null) {
        $this->companyName = $companyName;
        $this->position = $position;
        $this->role = $role;
        $this->startYear = $startYear;
        $this->endYear = $endYear;
    }
    static function request($companyName, $position, $role, $startYear, $endYear = null){
        return new static($companyName, $position, $role, $startYear, $endYear);
    }
}
