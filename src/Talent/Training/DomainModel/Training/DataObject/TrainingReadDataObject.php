<?php

namespace Talent\Training\DomainModel\Training\DataObject;

use Resources\IReadDataObject;
use Talent\Training\DomainModel\Training\Training;

class TrainingReadDataObject implements IReadDataObject{
    protected $id;
    protected $name;
    protected $organizer;
    protected $year;
    
    function getId() {
        return $this->id;
    }
    function getName() {
        return $this->name;
    }
    function getOrganizer() {
        return $this->organizer;
    }
    function getYear() {
        return $this->year;
    }
    
    function __construct($id, $name, $organizer, $year) {
        $this->id = $id;
        $this->name = $name;
        $this->organizer = $organizer;
        $this->year = $year;
    }

        public function toArray() {
        return array(
            'id' => $this->getId(),
            'name' => $this->getName(),
            'organizer' => $this->getOrganizer(),
            'year' => $this->getYear(),
        );
    }

}
