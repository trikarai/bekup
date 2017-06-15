<?php

namespace Team\Programme\ApplicationService\Programme;

use Resources\ResponseObject;
use Resources\ErrorMessage;

class CommandProgrammeService {
    protected $teamRepository;
    protected $activeMembershipFinder;
    
    /**
     * @param \Team\Programme\DomainModel\Team\ITeamRepository $teamRepository
     * @param \Team\Profile\ApplicationService\Talent\ActiveMembershipFinder $activeMemberhipFinder
     */
    public function __construct(
            \Team\Programme\DomainModel\Team\ITeamRepository $teamRepository,
            \Team\Profile\ApplicationService\Talent\ActiveMembershipFinder $activeMemberhipFinder
    ) {
        $this->teamRepository = $teamRepository;
        $this->activeMembershipFinder = $activeMemberhipFinder;
    }
    
    /**
     * @param type $talentId
     * @param type $programmeId
     * @return ResponseObject
     */
    function cancelApplication($talentId, $programmeId){
        $response = new ResponseObject();
        $activeMembershipRdo = $this->_findActiveMembershipRdoOrDie($talentId);
        $team = $this->_findTeamOrDie($activeMembershipRdo->teamRDO()->getId());
        
        if(true !== $msg = $team->cancelApplication($activeMembershipRdo->getId(), $programmeId)){
            $response->appendErrorMessage($msg);
        }else{
            $this->teamRepository->update();
        }
        return $response;
    }
    
    /**
     * @param type $talentId
     * @param type $programmeId
     * @return ResponseObject
     */
    function resignProgramme($talentId, $programmeId){
        $response = new ResponseObject();
        $activeMembershipRdo = $this->_findActiveMembershipRdoOrDie($talentId);
        $team = $this->_findTeamOrDie($activeMembershipRdo->teamRDO()->getId());
        
        if(true !== $msg = $team->resignFromProgramme($activeMembershipRdo->getId(), $programmeId)){
            $response->appendErrorMessage($msg);
        }else{
            $this->teamRepository->update();
        }
        return $response;
    }
    /**
     * @param type $talentId
     * @return \Team\Profile\DomainModel\Membership\DataObject\TalentMembershipReadDataObject
     * @throws \Resources\Exception\DoNotCatchException
     */
    protected function _findActiveMembershipRdoOrDie($talentId){
        $activeMembershipRdo = $this->activeMembershipFinder->findActiveMembershipRdo($talentId);
        if(empty($activeMembershipRdo)){
            throw new \Resources\Exception\DoNotCatchException('active team not found');
        }
        return $activeMembershipRdo;
    }
    /**
     * @param type $teamId
     * @return \Team\Programme\DomainModel\Team\Team
     * @throws \Resources\Exception\DoNotCatchException
     */
    protected function _findTeamOrDie($teamId){
        $team = $this->teamRepository->ofId($teamId);
        if(empty($team)){
            throw new \Resources\Exception\DoNotCatchException('team no found');
        }
        return $team;
    }
    
    
}
