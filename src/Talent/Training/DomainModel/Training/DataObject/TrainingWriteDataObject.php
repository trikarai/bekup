<?php

namespace Talent\Training\DomainModel\Training\DataObject;

class TrainingWriteDataObject {
    protected $name;
    protected $organizer;
    protected $year;
    
    function getName(){
        return $this->name;
    }
    function getOrganizer(){
        return $this->organizer;
    }
    function getYear(){
        return $this->year;
    }
    
    protected function __construct($name, $organizer, $year) {
        $this->name = $name;
        $this->organizer = $organizer;
        $this->year = $year;
    }
    
    static function request($name, $organizer, $year){
        return new static($name, $organizer, $year);
    }
}
