<?php

namespace Talent\Education\DomainModel\Education\DataObject;

use Resources\IReadDataObject;

use Talent\Education\DomainModel\Education\Education;

class EducationReadDataObject implements IReadDataObject{
    protected $id;
    protected $phase;
    protected $institution;
    protected $major;
    protected $startYear;
    protected $endYear;
    protected $note;

    function getId() {
        return $this->id;
    }
    function getPhase() {
        return $this->phase;
    }
    function getInstitution() {
        return $this->institution;
    }
    function getMajor() {
        return $this->major;
    }
    function getStartYear() {
        return $this->startYear;
    }
    function getEndYear() {
        return $this->endYear;
    }
    function getNote() {
        return $this->note;
    }
    
    function __construct($id, $phase, $institution, $major, $startYear, $endYear, $note) {
        $this->id = $id;
        $this->phase = $phase;
        $this->institution = $institution;
        $this->major = $major;
        $this->startYear = $startYear;
        $this->endYear = $endYear;
        $this->note = $note;
    }

            
    public function toArray() {
        return array(
            'id' => $this->getId(),
            'phase' => $this->getPhase(),
            'institution' => $this->getInstitution(),
            'major' => $this->getMajor(),
            'start_year' => $this->getStartYear(),
            'end_year' => $this->getEndYear(),
            'note' => $this->getNote(),
        );
    }
}
