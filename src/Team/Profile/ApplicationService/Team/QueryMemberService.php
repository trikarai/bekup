<?php

namespace Team\Profile\ApplicationService\Team;

use Team\Profile\DomainModel\Team\Team;

class QueryMemberService {
    protected $teamRepository;
    protected $talentRepository;
    
    public function __construct(
            \Team\Profile\DomainModel\Team\ITeamRepository $teamRepository,
            \Team\Profile\DomainModel\Talent\ITalentRepository $talentRepository
    ) {
        $this->teamRepository = $teamRepository;
        $this->talentRepository = $talentRepository;
    }
    
    /**
     * @param type $talentId
     * @param type $memberId
     * @return \Team\Profile\ApplicationService\Team\TeamMemberQueryResponseObject
     */
    function showByMemberId($talentId, $memberId){
        $response = new TeamMemberQueryResponseObject();
        $activeMembershipRdo = $this->_findActiveMembershipRdoOrDie($talentId);
        $team = $this->_findTeamOrDie($activeMembershipRdo->teamRDO()->getId());
        $rdo = $team->aMembershipRDO_ofMemberId($memberId);
        
        if(empty($rdo)){
            $response->appendErrorMessage(\Resources\ErrorMessage::error404_NotFound(['member not found']));
        } else{
            $response->setReadDataObject($rdo);
        }
        return $response;
    }
    
    /**
     * @param type $talentId
     * @return \Team\Profile\ApplicationService\Team\TeamMemberQueryResponseObject
     */
    function showAllActiveMember($talentId){
        $response = new TeamMemberQueryResponseObject();
        $activeMembershipRdo = $this->_findActiveMembershipRdoOrDie($talentId);
        $team = $this->_findTeamOrDie($activeMembershipRdo->teamRDO()->getId());
        $rdos = $team->allActiveMembershipRDO();
        
        if(empty($rdos)){
            $response->appendErrorMessage(\Resources\ErrorMessage::error404_NotFound(['no Active Member found']));
        }else {
            $response->setBulkReadDataObject($rdos);
        }
        return $response;
    }
    
    /**
     * @param type $talentId
     * @return \Team\Profile\ApplicationService\Team\TeamMemberQueryResponseObject
     */
    function showAllInvitedMember($talentId){
        $response = new TeamMemberQueryResponseObject();
        $activeMembershipRdo = $this->_findActiveMembershipRdoOrDie($talentId);
        $team = $this->_findTeamOrDie($activeMembershipRdo->teamRDO()->getId());
        
        $rdos = $team->allInvitedMembershipRDO();
        if(empty($rdos)){
            $response->appendErrorMessage(\Resources\ErrorMessage::error404_NotFound(['no Invited Member found']));
        }else{
            $response->setBulkReadDataObject($rdos);
        }
        return $response;
    }
    
    /**
     * @param type $teamId
     * @return Team
     * @throws \Resources\Exception\DoNotCatchException
     */
    protected function _findTeamOrDie($teamId){
        $team = $this->teamRepository->ofId($teamId);
        if(empty($team)){
            throw new \Resources\Exception\DoNotCatchException('active team not found');
        }
        return $team;
    }
    
    protected function _findActiveMembershipRdoOrDie($talentId){
        $talent = $this->talentRepository->ofId($talentId);
        if(empty($talent)){
            throw new \Resources\Exception\DoNotCatchException('talent not found');
        }
        $activeMembershipRdo = $talent->anActiveMembershipRDO();
        if(empty($activeMembershipRdo)){
            throw new \Resources\Exception\DoNotCatchException('active team not found');
        }
        return $activeMembershipRdo;
    }
    
}
