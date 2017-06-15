<?php

namespace Superclass\ApplicationService\Talent;

use Superclass\DomainModel\Talent\IBaseTalentRepository;
use Superclass\DomainModel\Talent\TalentReadDataObject;

class BaseTalentFinder {
    /**
     * @var IBaseTalentRepository
     */
    protected $repository;
    
    public function __construct(IBaseTalentRepository $talentRepository) {
        $this->repository = $talentRepository;
    }
    
    /**
     * @param type $id
     * @return TalentReadDataObject||null
     */
    function findTalentRdoById($id){
        $talent = $this->repository->ofId($id);
        if(empty($talent)){
            return null;
        }
        return $talent->toReadDataObject();
    }
}
