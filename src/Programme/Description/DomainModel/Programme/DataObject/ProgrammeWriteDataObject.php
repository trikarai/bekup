<?php

namespace Programme\Description\DomainModel\Programme\DataObject;

class ProgrammeWriteDataObject {
    protected $name;
    protected $description;
    protected $registrationStartDate;
    protected $registrationEndDate;
    protected $operationStartDate;
    protected $operationEndDate;
    
    function getName() {
        return $this->name;
    }
    function getDescription() {
        return $this->description;
    }
    function getRegistrationStartDate() {
        return $this->registrationStartDate;
    }
    function getRegistrationEndDate() {
        return $this->registrationEndDate;
    }
    function getOperationStartDate() {
        return $this->operationStartDate;
    }
    function getOperationEndDate() {
        return $this->operationEndDate;
    }
    
    protected function __construct($name, $description, $registrationStartDate, $registrationEndDate, $operationStartDate, $operationEndDate) {
        $this->name = $name;
        $this->description = $description;
        $this->registrationStartDate = $registrationStartDate;
        $this->registrationEndDate = $registrationEndDate;
        $this->operationStartDate = $operationStartDate;
        $this->operationEndDate = $operationEndDate;
    }
    
    static function request($name, $description, $registrationStartDate, $registrationEndDate, $operationStartDate, $operationEndDate){
        return new static($name, $description, $registrationStartDate, $registrationEndDate, $operationStartDate, $operationEndDate);
    }
}
