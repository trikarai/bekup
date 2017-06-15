<?php

namespace City\Profile\DomainModel\City\Service;

use City\Profile\DomainModel\City\ICityRepository;
use Resources\ErrorMessage;

class PreventDuplicateCityService {
    protected $repository;
    
    public function __construct(ICityRepository $cityRepository) {
        $this->repository = $cityRepository;
    }
    
    /**
     * @param type $name
     * @return boolean
     */
    function isNotDuplicateName($name){
        $city = $this->repository->ofName($name);
        if(empty($city)){
            return true;
        }
        return ErrorMessage::error409_Conflict(["duplicate, city name: '$name' already used"]);
    }
}
