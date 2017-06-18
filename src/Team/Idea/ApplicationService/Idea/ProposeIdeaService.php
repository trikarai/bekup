<?php

namespace Team\Idea\ApplicationService\Idea;

use Resources\ResponseObject;
use Resources\ErrorMessage;
use Resources\Exception\DoNotCatchException;

use Team\Idea\DomainModel\Idea\Service\IdeaDataValidationService;
use Team\Idea\DomainModel\Idea\DataObject\IdeaWriteDataObject;
use Team\Idea\DomainModel\Team\Team;
use Team\Idea\DomainModel\Talent\Talent;

use Team\Profile\DomainModel\Membership\DataObject\TalentMembershipReadDataObject;

class ProposeIdeaService {
    
    protected $repository;
    protected $talentQueryRepository;
    protected $activeMemberhipFinder;
    protected $dataValidationService;
    
    /**
     * @param \Team\Idea\DomainModel\Team\ITeamRepository $teamRepository
     * @param \Team\Idea\DomainModel\Talent\ITalentQueryRepository $talentQueryRepository
     * @param \Team\Profile\ApplicationService\Talent\ActiveMembershipFinder $activeMembershipFinder
     */
    public function __construct(
            \Team\Idea\DomainModel\Team\ITeamRepository $teamRepository,
            \Team\Idea\DomainModel\Talent\ITalentQueryRepository $talentQueryRepository,
            \Team\Profile\ApplicationService\Talent\ActiveMembershipFinder $activeMembershipFinder
    ) {
        $this->repository = $teamRepository;
        $this->talentQueryRepository = $talentQueryRepository;
        $this->activeMemberhipFinder = $activeMembershipFinder;
        $this->dataValidationService = new IdeaDataValidationService();
    }

    /**
     * @param type $talentId
     * @param IdeaWriteDataObject $request
     * @param type $superheroId
     * @return ResponseObject
     */
    function execute($talentId, IdeaWriteDataObject $request, $superheroId = null){
        $response = new ResponseObject();
        $activeMemberhshipRdo = $this->_findActiveMembershipOrDie($talentId);
        $team = $this->_findTeamOrDie($activeMemberhshipRdo->teamRDO()->getId());
        
        if(false === $verifiedSuperheroId = $this->_findSuperheroId($talentId, $superheroId)){
            $response->appendErrorMessage(ErrorMessage::error404_NotFound(['superhero not found']));
        }else if(true !== $msg = $this->dataValidationService->isValidToPropose($request)){
            $response->appendErrorMessage($msg);
        }else if(true !== $msg = $team->proposeIdea($activeMemberhshipRdo->getId(), $request, $verifiedSuperheroId)){
            $response->appendErrorMessage($msg);
        }else{
            $this->repository->update();
        }
        return $response;
    }
    
    /**
     * @param type $talentId
     * @return TalentMembershipReadDataObject
     * @throws DoNotCatchException
     */
    protected function _findActiveMembershipOrDie($talentId){
        $activeMembershipRdo = $this->activeMemberhipFinder->findActiveMembershipRdo($talentId);
        if(empty($activeMembershipRdo)){
            throw new DoNotCatchException('active team not found');
        }
        return $activeMembershipRdo;
    }
    /**
     * @param type $teamId
     * @return Team
     * @throws DoNotCatchException
     */
    protected function _findTeamOrDie($teamId){
        $team = $this->repository->ofId($teamId);
        if(empty($team)){
            throw new DoNotCatchException('team not found');
        }
        return $team;
    }
    /**
     * @param type $talentId
     * @param type $superheroId
     * @return null||false||string
     * @throws DoNotCatchException
     */
    protected function _findSuperheroId($talentId, $superheroId){
        if(empty($superheroId)){
            return null;
        }
        $talentQuery = $this->talentQueryRepository->ofId($talentId);
        if(empty($talentQuery)){
            throw new DoNotCatchException('talent not found');
        }
        $superheroRDO = $talentQuery->aSuperheroRdoOfId($superheroId);
        if(empty($superheroRDO)){
            return false;
        }
        return $superheroRDO->getId();
    }
}
