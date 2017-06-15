<?php

namespace Track\Definition\DomainModel\Track\Service;

use Track\Definition\DomainModel\Track\ITrackRepository;
use Resources\ErrorMessage;

class PreventDuplicateTrackService {
    protected $repository;
    
    public function __construct(ITrackRepository $trackRepository) {
        $this->repository = $trackRepository;
    }
    
    /**
     * @param type $name
     * @return true||ErrorMessage
     */
    function isNotDuplicateName($name){
        $track = $this->repository->ofName($name);
        if(empty($track)){
            return true;
        }
        return ErrorMessage::error409_Conflict(["duplicate, track name: '$name' is already used"]);
    }
}
