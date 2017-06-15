<?php

namespace Team\Programme\DomainModel\Programme;

use City\Programme\Description\DomainModel\Programme\ProgrammeRdo as CityProgrammeRdo;
use Team\Programme\DomainModel\Team\Team;
use Resources\ErrorMessage;

class Programme {
    protected $id;
    protected $status = 'apply';
    protected $referenceCityProgrammeId;
    
    protected $team;
    
    function getId() {
        return $this->id;
    }
    function getStatus() {
        return $this->status;
    }
    function getReferenceCityProgrammeId() {
        return $this->referenceCityProgrammeId;
    }

    public function __construct($id, CityProgrammeRdo $cityProgrammeRdo, Team $team) {
        $this->id = $id;
        $this->status = 'apply';
        $this->referenceCityProgrammeId = $cityProgrammeRdo->getId();
        $this->team = $team;
        
    }
    
    /**
     * @param type $status
     * @return true||ErrorMessage
     */
    function changeStatus($status){
        $validStatusFromApply = ['active', 'cancel', 'reject'];
        $validStatusFromActive = ['remove', 'resign'];
        
        if('apply' === $this->status){
            if(!in_array($status, $validStatusFromApply)){
                return ErrorMessage::error400_BadRequest(['invalid programme participation status transition']);
            }
            $this->status = $status;
        }else if('active' === $this->status){
            if(!in_array($status, $validStatusFromActive)){
                return ErrorMessage::error400_BadRequest(['invalid programme participation status transition']);
            }
            $this->status = $status;
        }else{
            return ErrorMessage::error400_BadRequest(['invalid programme participation status transition']);
        }
        return true;
    }
}
