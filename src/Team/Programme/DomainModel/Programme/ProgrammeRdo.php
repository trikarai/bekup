<?php

namespace Team\Programme\DomainModel\Programme;

use Resources\IReadDataObject;
use City\Programme\Description\DomainModel\Programme\ProgrammeRdo as ReferenceCityProgrammeRdo;
use Superclass\DomainModel\Team\TeamReadDataObject;

class ProgrammeRdo implements IReadDataObject{
    protected $id;
    protected $status = 'apply';
    protected $referenceCityProgrammeRdo;
    
    protected $teamRdo;
    
    function getId() {
        return $this->id;
    }
    function getStatus() {
        return $this->status;
    }
    /**
     * @return ReferenceCityProgrammeRdo
     */
    function referenceCityProgrammeRdo() {
        return $this->referenceCityProgrammeRdo;
    }
    /**
     * @return TeamReadDataObject
     */
    function teamRdo() {
        return $this->teamRdo;
    }

        
    function __construct($id, $status, ReferenceCityProgrammeRdo $referenceCityProgrammeRdo, TeamReadDataObject $teamRdo) {
        $this->id = $id;
        $this->status = $status;
        $this->referenceCityProgrammeRdo = $referenceCityProgrammeRdo;
        $this->teamRdo = $teamRdo;
    }

    public function toArray() {
        return array(
            'id' => $this->getId(),
            'status' => $this->getStatus(),
            'reference_city_programme' => $this->referenceCityProgrammeRdo()->toArray(),
            'team' => $this->teamRdo()->toArray(),
        );
    }

}
