<?php

namespace Programme\Description\DomainModel\Programme;

use Resources\IReadDataObject;

class ProgrammeRdo implements IReadDataObject{
    protected $id;
    protected $name;
    protected $registrationStartDate;
    protected $registrationEndDate;
    protected $operationStartDate;
    protected $operationEndDate;
    protected $isRemoved;
    
    function getId() {
        return $this->id;
    }
    function getName() {
        return $this->name;
    }
    function getRegistrationStartDate() {
        return $this->registrationStartDate->format('Y-m-d');
    }
    function getRegistrationEndDate() {
        return $this->registrationEndDate->format('Y-m-d');
    }
    function getOperationStartDate() {
        return $this->operationStartDate->format('Y-m-d');
    }
    function getOperationEndDate() {
        return $this->operationEndDate->format('Y-m-d');
    }
    function getIsRemoved() {
        return $this->isRemoved;
    }
    
    protected function __construct($id, $name, \DateTime $registrationStartDate, \DateTime $registrationEndDate, \DateTime $operationStartDate, \DateTime $operationEndDate, $isRemoved) {
        $this->id = $id;
        $this->name = $name;
        $this->registrationStartDate = $registrationStartDate;
        $this->registrationEndDate = $registrationEndDate;
        $this->operationStartDate = $operationStartDate;
        $this->operationEndDate = $operationEndDate;
        $this->isRemoved = $isRemoved;
    }

    public function toArray() {
        return array(
            'id' => $this->getId(),
            'name' => $this->getName(),
            'registration_start_date' => $this->getRegistrationStartDate(),
            'registration_end_date' => $this->getRegistrationEndDate(),
            'operation_start_date' => $this->getOperationStartDate(),
            'operation_end_date' => $this->getOperationEndDate(),
            'is_removed' => $this->getIsRemoved(),
        );
    }
}
