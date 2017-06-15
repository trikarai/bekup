<?php

namespace Team\Idea\ApplicationService\Idea;

use Resources\ResponseObject;
use Resources\ErrorMessage;
use Resources\Exception\DoNotCatchException;

use Team\Idea\DomainModel\Idea\DataObject\IdeaWriteDataObject;
use Team\Idea\DomainModel\Team\Team;
use Team\Idea\DomainModel\Idea\Service\IdeaDataValidationService;

use Team\Profile\DomainModel\Membership\DataObject\TalentMembershipReadDataObject;

class CommandIdeaService {
    protected $repository;
    protected $activeMembershipFinder;
    
    /**
     * @param \Team\Idea\DomainModel\Team\ITeamRepository $teamRepository
     * @param \Team\Profile\ApplicationService\Talent\ActiveMembershipFinder $activeMembershipFinder
     */
    public function __construct(
            \Team\Idea\DomainModel\Team\ITeamRepository $teamRepository,
            \Team\Profile\ApplicationService\Talent\ActiveMembershipFinder $activeMembershipFinder
    ) {
        $this->repository = $teamRepository;
        $this->activeMembershipFinder = $activeMembershipFinder;
    }
    /**
     * @return IdeaDataValidationService
     */
    protected function _dataValidationService(){
        return new IdeaDataValidationService();
    }
    
    /**
     * @param type $talentId
     * @param type $ideaId
     * @param IdeaWriteDataObject $request
     * @return ResponseObject
     */
    function updateIdea($talentId, $ideaId, IdeaWriteDataObject $request){
        $response = new ResponseObject();
        $activeMembershipRdo = $this->_findActiveMembershipOrDie($talentId);
        $team = $this->_findTeamOrDie($activeMembershipRdo->teamRDO()->getId());
        
        if(true !== $msg = $this->_dataValidationService()->isValidToUpdate($request)){
            $response->appendErrorMessage($msg);
        }else if(true !== $msg = $team->updateIdea($activeMembershipRdo->getId(), $ideaId, $request)){
            $response->appendErrorMessage($msg);
        }else{
            $this->repository->update();
        }
        return $response;
    }
    
    /**
     * @param type $talentId
     * @param type $ideaId
     * @return ResponseObject
     */
    function removeIdea($talentId, $ideaId){
        $response = new ResponseObject();
        $activeMembershipRdo = $this->_findActiveMembershipOrDie($talentId);
        $team = $this->_findTeamOrDie($activeMembershipRdo->teamRDO()->getId());
        
        if(true !== $msg = $team->removeIdea($activeMembershipRdo->getId(), $ideaId)){
            $response->appendErrorMessage($msg);
        }else{
            $this->repository->update();
        }
        return $response;
    }
    
    /**
     * @param string $teamId
     * @return Team
     * @throws DoNotCatchException
     */
    protected function _findTeamOrDie($teamId){
        $team = $this->repository->ofId($teamId);
        if(empty($team)){
            throw new DoNotCatchException("team not found");
        }
        return $team;
    }
    
    /**
     * @param type $talentId
     * @return TalentMembershipReadDataObject
     * @throws DoNotCatchException
     */
    protected function _findActiveMembershipOrDie($talentId){
        $activeMembershipRdo = $this->activeMembershipFinder->findActiveMembershipRdo($talentId);
        if(empty($activeMembershipRdo)){
            throw new DoNotCatchException("active team not found");
        }
        return $activeMembershipRdo;
    }
}
