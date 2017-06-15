<?php

namespace Talent\Skill\DomainModel\Skill\Service;

use Talent\Skill\DomainModel\Skill\ISkillRepository;
use Resources\ErrorMessage;

class PreventDuplicateSkillService {
    protected $repository;
    
    public function __construct(ISkillRepository $skillRepository) {
        $this->repository = $skillRepository;
    }
    
    /**
     * @param type $name
     * @return true||ErrorMessage
     */
    function isNotDuplicateName($name){
        $skill = $this->repository->ofName($name);
        if(empty($skill)){
            return true;
        }
        return ErrorMessage::error409_Conflict(["duplicate, skill name: '$name' already used"]);
    }
}
