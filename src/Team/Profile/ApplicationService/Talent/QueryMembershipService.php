<?php

namespace Team\Profile\ApplicationService\Talent;

use Team\Profile\DomainModel\Talent\Talent;


class QueryMembershipService {
    protected $repository;
    
    /**
     * @param \Team\Profile\DomainModel\Talent\ITalentRepository $talentRepository
     */
    public function __construct(\Team\Profile\DomainModel\Talent\ITalentRepository $talentRepository) {
        $this->repository = $talentRepository;
    }
    
    /**
     * @param type $talentId
     * @param type $teamId
     * @return \Team\Profile\ApplicationService\Talent\TalentMembershipQueryResponseObject
     */
    function showByTeamId($talentId, $teamId, $memberId){
        $response = new TalentMembershipQueryResponseObject();
        $talent = $this->_findTalentOrDie($talentId);
        $rdo = $talent->aMembershipRDO_ofTeamIdAndMembershipId($teamId, $memberId);
        
        if(empty($rdo)){
            $response->appendErrorMessage(\Resources\ErrorMessage::error404_NotFound(['membership not found']));
        }else{
            $response->setReadDataObject($rdo);
        }
        return $response;
    }
    
    /**
     * @param type $talentId
     * @return \Team\Profile\ApplicationService\Talent\TalentMembershipQueryResponseObject
     */
    function showActiveMembership($talentId){
        $response = new TalentMembershipQueryResponseObject();
        
        $talent = $this->_findTalentOrDie($talentId);
        $rdo = $talent->anActiveMembershipRDO();
        if(empty($rdo)){
            $response->appendErrorMessage(\Resources\ErrorMessage::error404_NotFound(['no active membership found']));
        }else {
            $response->setReadDataObject($rdo);
        }
        return $response;
    }
    
    /**
     * @param type $talentId
     * @return \Team\Profile\ApplicationService\Talent\TalentMembershipQueryResponseObject
     */
    function showInvitedMembership($talentId){
        $response = new TalentMembershipQueryResponseObject();
        
        $talent = $this->_findTalentOrDie($talentId);
        $rdos = $talent->allInvitedMembershipRDO();
        if(empty($rdos)){
            $response->appendErrorMessage(\Resources\ErrorMessage::error404_NotFound(['no invited membership found']));
        } else{
            foreach($rdos as $rdo){
                $response->setReadDataObject($rdo);
            }
        }
        return $response;
    }
    
    /**
     * @param type $id
     * @return Talent
     * @throws \Resources\Exception\DoNotCatchException
     */
    protected function _findTalentOrDie($id){
        $talent = $this->repository->ofId($id);
        if(empty($talent)){
            throw new \Resources\Exception\DoNotCatchException('talent not found');
        }
        return $talent;
    }
}
