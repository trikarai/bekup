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
    protected $talentRepository;
    protected $activeMemberhipFinder;
    protected $dataValidationService;
    
    /**
     * @param \Team\Idea\DomainModel\Team\ITeamRepository $teamRepository
     * @param \Team\Idea\DomainModel\Talent\ITalentRepository $talentRepository
     * @param \Team\Idea\DomainModel\Team\Team\Profile\ApplicationService\Talent\ActiveMembershipFinder $activeMembershipFinder
     */
    public function __construct(
            \Team\Idea\DomainModel\Team\ITeamRepository $teamRepository,
            \Team\Idea\DomainModel\Talent\ITalentRepository $talentRepository,
            \Team\Profile\ApplicationService\Talent\ActiveMembershipFinder $activeMembershipFinder
    ) {
        $this->repository = $teamRepository;
        $this->talentRepository = $talentRepository;
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
        if(false === $superheroRdo = $this->_findSuperhero($talentId, $superheroId)){
            $response->appendErrorMessage(ErrorMessage::error404_NotFound(['superhero not found']));
        }else if(true !== $msg = $this->dataValidationService->isValidToPropose($request)){
            $response->appendErrorMessage($msg);
        }else if(true !== $msg = $team->proposeIdea($activeMemberhshipRdo->getId(), $request, $superheroRdo)){
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
    protected function _findSuperhero($talentId, $superheroId){
        if(empty($superheroId)){
            return null;
        }
        $talent = $this->talentRepository->ofId($talentId);
        if(empty($talent)){
            throw new DoNotCatchException('talent not found');
        }
        $superheroRDO = $talent->aSuperheroRdoById($superheroId);
        if(empty($superheroRDO)){
            return false;
        }
        return $superheroRDO;
    }
}
