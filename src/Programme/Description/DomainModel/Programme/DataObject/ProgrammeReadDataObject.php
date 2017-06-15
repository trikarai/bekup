<?php

namespace Programme\Description\DomainModel\Programme\DataObject;

use Resources\IReadDataObject;

class ProgrammeReadDataObject implements IReadDataObject{
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
    function getIsRemoved() {
        return $this->isRemoved;
    }

    function __construct($id, $name, $registrationStartDate, $registrationEndDate, $operationStartDate, $operationEndDate, $isRemoved) {
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
