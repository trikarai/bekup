<?php

namespace Programme\Description\DomainModel\Programme\Service;

use Programme\Description\DomainModel\Programme\IProgrammeRepository;
use Resources\ErrorMessage;

class PreventDuplicateProgrammeService {
    protected $repository;
    
    public function __construct(IProgrammeRepository $programmeRepository) {
        $this->repository = $programmeRepository;
    }
    
    /**
     * @param type $name
     * @return true||ErrorMessage
     */
    function isNotDuplicateName($name){
        $programme = $this->repository->ofName($name);
        if(empty($programme)){
            return true;
        }
        return ErrorMessage::error409_Conflict(["duplicate programme, 'name': '$name' already used"]);
    }
}
