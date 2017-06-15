<?php

namespace Personnel\DomainModel\Personnel\Service;

//use Resources\MessageObject;
use Personnel\DomainModel\Personnel\IPersonnelRepository;
use Resources\ErrorMessage;

class PreventDuplicatePersonnelService {
    protected $repository;
    
    public function __construct(IPersonnelRepository $personnelRepository) {
        $this->repository = $personnelRepository;
    }
    
    /**
     * @param type $email
     * @return true||ErrorMessage
     */
    function isNotDuplicateEmail($email){
        $personnel = $this->repository->ofEmail($email);
        if(empty($personnel)){
            return true;
        }
        return ErrorMessage::error409_Conflict(["duplicate, 'personnel email': '$email' already registered"]);
    }
}
