<?php

namespace Team\Profile\ApplicationService\Talent;

use Team\Profile\DomainModel\Talent\Talent;

class TalentFinder {
    protected $repository;
    
    public function __construct(\Team\Profile\DomainModel\Talent\ITalentRepository $talentRepository) {
        $this->repository = $talentRepository;
    }
    
    /**
     * @param type $id
     * @return null||Talent
     */
    function findTalentOfId($id){
        $talent = $this->repository->ofId($id);
        if(empty($talent)){
            return null;
        }
        return $talent;
    }
}
