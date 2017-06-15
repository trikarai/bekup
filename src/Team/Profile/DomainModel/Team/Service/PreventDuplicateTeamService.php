<?php

namespace Team\Profile\DomainModel\Team\Service;

use Team\Profile\DomainModel\Team\ITeamRepository;
use Resources\ErrorMessage;

class PreventDuplicateTeamService {
    protected $repository;
    
    public function __construct(ITeamRepository $teamRepository) {
        $this->repository = $teamRepository;
    }
    
    /**
     * 
     * @param type $name
     * @param type $cityId
     * @return true||ErrorMessage
     */
    function isNotDuplicateNameWithinCity($name, $cityId){
        $team = $this->repository->ofNameWithinCityId($name, $cityId);
        if(empty($team)){
            return true;
        }
        return ErrorMessage::error409_Conflict(["team name: '$name' already used in city"]);
    }
}
