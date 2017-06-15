<?php

namespace Team\Profile\ApplicationService\Talent;

use Team\Profile\DomainModel\Membership\DataObject\TalentMembershipReadDataObject;

class ActiveMembershipFinder {
    protected $repository;
    
    public function __construct(\Team\Profile\DomainModel\Talent\ITalentRepository $talentRepository) {
        $this->repository = $talentRepository;
    }
    
    /**
     * @param type $talentId
     * @return TalentMembershipReadDataObject||null
     */
    function findActiveMembershipRdo($talentId){
        $talent = $this->repository->ofId($talentId);
        if(empty($talent)){
            return null;
        }
        $activeMembershipRdo = $talent->anActiveMembershipRDO();
        if(empty($activeMembershipRdo)){
            return null;
        }
        return $activeMembershipRdo;
    }
}
