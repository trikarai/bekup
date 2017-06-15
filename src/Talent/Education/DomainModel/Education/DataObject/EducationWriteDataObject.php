<?php

namespace Talent\Education\DomainModel\Education\DataObject;

class EducationWriteDataObject {
    protected $phase;
    protected $institution;
    protected $major;
    protected $startYear;
    protected $endYear = null;
    protected $note;
    
    function getPhase(){
        return $this->phase;
    }
    function getInstitution(){
        return $this->institution;
    }
    function getMajor(){
        return $this->major;
    }
    function getStartYear(){
        return $this->startYear;
    }
    function getEndYear(){
        return $this->endYear;
    }
    function getNote(){
        return $this->note;
    }
    
    protected function __construct($phase, $institution, $major, $note, $startYear, $endYear = null) {
        $this->phase = $phase;
        $this->institution = $institution;
        $this->major = $major;
        $this->note = $note;
        $this->startYear = $startYear;
        $this->endYear = $endYear;
    }
    
    static function addRequest($phase, $institution, $major, $note, $startYear, $endYear = null){
        return new static($phase, $institution, $major, $note, $startYear, $endYear);
    }
    static function updateRequest($institution, $major, $note, $startYear, $endYear = null){
        return new static(null, $institution, $major, $note, $startYear, $endYear);
    }
}
