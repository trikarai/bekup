<?php

namespace Team\Profile\ApplicationService\Team;

use Team\Profile\DomainModel\Team\Team;
use Team\Profile\DomainModel\Membership\Service\MembershipDataValidationService;
use Team\Profile\DomainModel\Talent\Talent;
use Team\Profile\DomainModel\Membership\DataObject\TalentMembershipReadDataObject;
use Resources\ResponseObject;

class InviteTeamMemberService {
    protected $repository;
    protected $talentRepository;
//    protected $talentFinder;
    protected $dataValidationService;
    
    public function __construct(
            \Team\Profile\DomainModel\Team\ITeamRepository $teamRepository,
            \Team\Profile\DomainModel\Talent\ITalentRepository $talentRepository
//            \Team\Profile\ApplicationService\Talent\TalentFinder $talentFinder
    ) {
        $this->repository = $teamRepository;
        $this->talentRepository = $talentRepository;
//        $this->talentFinder = $talentFinder;
        $this->dataValidationService = new MembershipDataValidationService();
    }
    
    /**
     * @param type $commanderId
     * @param type $idOfTalentToInvite
     * @param string $position
     * @param boolean $isAdmin
     * @return ResponseObject
     */
    function execute($commanderId, $idOfTalentToInvite, $position, $isAdmin = false){
        $response = new ResponseObject();
        $commanderMembership = $this->_findActiveMembershipOrDie($commanderId);
        $team = $this->repository->ofId($commanderMembership->teamRDO()->getId());

        $invitedTalent = $this->_findTalent($idOfTalentToInvite);
        if(empty($invitedTalent)){
            $response->appendErrorMessage(\Resources\ErrorMessage::error404_NotFound(['talent to invite not found']));
        }else if(true !== $msg = $this->dataValidationService->isValidToProcees($position, $isAdmin)){
            $response->appendErrorMessage($msg);
        }else if(true !== $msg = $team->inviteNewMember($commanderMembership->getId(), $invitedTalent, $position, $isAdmin)){
            $response->appendErrorMessage($msg);
        }else{
            $this->repository->update();
        }
        return $response;
    }
    
    /**
     * @param type $commanderId
     * @return Team
     * @throws \Resources\Exception\DoNotCatchException
     */
    protected function _findTeamOrDie($teamId){
        $team = $this->repository->ofId($teamId);
        if(empty($team)){
            throw new \Resources\Exception\DoNotCatchException('team not found');
        }
        return $team;
    }
    
    /**
     * @param type $talentId
     * @return TalentMembershipReadDataObject[]
     * @throws \Resources\Exception\DoNotCatchException
     */
    protected function _findActiveMembershipOrDie($talentId){
        $talent = $this->_findTalent($talentId);
        if(empty($talent)){
            throw new \Resources\Exception\DoNotCatchException('talent not found');
        }
        $membershipRdo = $talent->anActiveMembershipRDO();
        if(empty($membershipRdo)){
            throw new \Resources\Exception\DoNotCatchException('active membership not found');
        }
        return $membershipRdo;
    }
    /**
     * @param type $talentId
     * @return Talent
     */
    protected function _findTalent($talentId){
        return $this->talentRepository->ofId($talentId);
    }
}
