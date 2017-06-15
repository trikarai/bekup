<?php

namespace Programme\Description\DomainModel\Programme\DataObject;

class ProgrammeWriteDataObject {
    protected $name;
    protected $registrationStartDate;
    protected $registrationEndDate;
    protected $operationStartDate;
    protected $operationEndDate;
    
    function getName() {
        return $this->name;
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
    
    protected function __construct($name, $registrationStartDate, $registrationEndDate, $operationStartDate, $operationEndDate) {
        $this->name = $name;
        $this->registrationStartDate = $registrationStartDate;
        $this->registrationEndDate = $registrationEndDate;
        $this->operationStartDate = $operationStartDate;
        $this->operationEndDate = $operationEndDate;
    }
    
    static function request($name, $registrationStartDate, $registrationEndDate, $operationStartDate, $operationEndDate){
        return new static($name, $registrationStartDate, $registrationEndDate, $operationStartDate, $operationEndDate);
    }
}
