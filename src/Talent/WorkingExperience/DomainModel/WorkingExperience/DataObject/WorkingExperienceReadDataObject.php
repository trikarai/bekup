<?php

namespace Talent\WorkingExperience\DomainModel\WorkingExperience\DataObject;

use Resources\IReadDataObject;
use Talent\WorkingExperience\DomainModel\WorkingExperience\WorkingExperience;

class WorkingExperienceReadDataObject implements IReadDataObject{
    protected $id;
    protected $companyName;
    protected $position;
    protected $role;
    protected $startYear;
    protected $endYear;
    
    function getId() {
        return $this->id;
    }
    function getCompanyName() {
        return $this->companyName;
    }
    function getPosition() {
        return $this->position;
    }
    function getRole() {
        return $this->role;
    }
    function getStartYear() {
        return $this->startYear;
    }
    function getEndYear() {
        return $this->endYear;
    }
    
    function __construct($id, $companyName, $position, $role, $startYear, $endYear) {
        $this->id = $id;
        $this->companyName = $companyName;
        $this->position = $position;
        $this->role = $role;
        $this->startYear = $startYear;
        $this->endYear = $endYear;
    }
        
    public function toArray() {
        return array(
            'id' => $this->getId(),
            'company_name' => $this->getCompanyName(),
            'position' => $this->getPosition(),
            'role' => $this->getRole(),
            'start_year' => $this->getStartYear(),
            'end_year' => $this->getEndYear(),
        );
    }
}
