<?php

namespace Team\Profile\ApplicationService\Team;

use Team\Profile\DomainModel\Team\Team;
use Resources\ResponseObject;

class CommandTeamMemberService {
    protected $teamRepository;
    protected $talentRepository;
    
    /**
     * @param \Team\Profile\DomainModel\Team\ITeamRepository $teamRepository
     * @param \Team\Profile\DomainModel\Talent\ITalentRepository $talentRepository
     */
    public function __construct(
            \Team\Profile\DomainModel\Team\ITeamRepository $teamRepository,
            \Team\Profile\DomainModel\Talent\ITalentRepository $talentRepository
    ) {
        $this->teamRepository = $teamRepository;
        $this->talentRepository = $talentRepository;
    }
    
    /**
     * @param type $commanderId
     * @param type $memberId
     * @return ResponseObject
     */
    function cancelInvitation($commanderId, $memberId){
        $response = new ResponseObject();
        $activeMembershipRdo = $this->_findCommanderActiveMembershipOrDie($commanderId);
        $team = $this->_findTeamOrDie($activeMembershipRdo->teamRDO()->getId());
        
        if(true !== $msg = $team->cancelInvitation($activeMembershipRdo->getId(), $memberId)){
            $response->appendErrorMessage($msg);
        }else{
            $this->teamRepository->update();
        }
        return $response;
    }
    
    /**
     * @param type $commanderId
     * @param type $memberId
     * @return ResponseObject
     */
    function removeMember($commanderId, $memberId){
        $response = new ResponseObject();
        $activeMembershipRdo = $this->_findCommanderActiveMembershipOrDie($commanderId);
        $team = $this->_findTeamOrDie($activeMembershipRdo->teamRDO()->getId());
        
        if(true !== $msg = $team->removeMember($activeMembershipRdo->getId(), $memberId)){
            $response->appendErrorMessage($msg);
        }else{
            $this->teamRepository->update();
        }
        return $response;
    }
    
    protected function _findCommanderActiveMembershipOrDie($commanderId){
        $commander = $this->talentRepository->ofId($commanderId);
        if(empty($commander)){
            throw new \Resources\Exception\DoNotCatchException('talent not found');
        }
        $activeMembershipRdo = $commander->anActiveMembershipRDO();
        if(empty($activeMembershipRdo)){
            throw new \Resources\Exception\DoNotCatchException('active team not found');
        }
        return $activeMembershipRdo;
    }
    protected function _findTeamOrDie($teamId){
        $team = $this->teamRepository->ofId($teamId);
        if(empty($team)){
            throw new \Resources\Exception\DoNotCatchException('team not found');
        }
        return $team;
    }
}
