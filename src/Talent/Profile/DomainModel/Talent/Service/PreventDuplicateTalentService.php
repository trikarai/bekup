<?php

namespace Talent\Profile\DomainModel\Talent\Service;

use Talent\Profile\DomainModel\Talent\ITalentRepository;
use Resources\ErrorMessage;

class PreventDuplicateTalentService {
    protected $repository;
    
    public function __construct(ITalentRepository $talentRepository) {
        $this->repository = $talentRepository;
    }
    
    /**
     * @param type $userName
     * @return true||ErrorMessage
     */
    function isNotDuplicateUserName($userName){
        $talent = $this->repository->ofUserName($userName);
        if(empty($talent)){
            return true;
        }
        return ErrorMessage::error409_Conflict(["duplicate, talent user name: '$userName' already registered"]);
    }
    
    /**
     * 
     * @param type $email
     * @return true||ErrorMessage
     */
    function isNotDuplicateUserEmail($email){
        $talent = $this->repository->ofEmail($email);
        if(empty($talent)){
            return true;
        }
        return ErrorMessage::error409_Conflict(["duplicate, talent email: '$email' already registered"]);
    }
    
}
