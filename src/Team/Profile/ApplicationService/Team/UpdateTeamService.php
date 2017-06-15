<?php

namespace Team\Profile\ApplicationService\Team;

use Team\Profile\DomainModel\Team\Team;
use Team\Profile\DomainModel\Team\Service\PreventDuplicateTeamService;
use Team\Profile\DomainModel\Team\Service\TeamDataValidationService;
use Team\Profile\DomainModel\Team\DataObject\TeamWriteDataObject;

use Resources\ResponseObject;

class UpdateTeamService {
    protected $repository;
    protected $talentRepository;
    protected $dataValidationService;
    protected $preventDuplicateService;
    
    /**
     * @param \Team\Profile\DomainModel\Team\ITeamRepository $teamRepository
     */
    public function __construct(
            \Team\Profile\DomainModel\Team\ITeamRepository $teamRepository,
            \Team\Profile\DomainModel\Talent\ITalentRepository $talentRepository
    ) {
        $this->repository = $teamRepository;
        $this->talentRepository = $talentRepository;
        $this->dataValidationService = new TeamDataValidationService();
        $this->preventDuplicateService = new PreventDuplicateTeamService($this->repository);
    }
    
    /**
     * @param type $talentId
     * @param TeamWriteDataObject $request
     * @return ResponseObject
     */
    function execute($talentId, TeamWriteDataObject $request){
        $response = new ResponseObject();
        $activeMembershipRdo = $this->_findActiveMembershipOrDie($talentId);
        $team = $this->_findTeamOrDie($activeMembershipRdo->teamRDO()->getId());
        
        if(true !== $msg = $this->dataValidationService->isValidToUpdate($request)){
            $response->appendErrorMessage($msg);
        }else if($request->getName() !== $team->getName() &&
                true !== $msg = $this->preventDuplicateService->isNotDuplicateNameWithinCity($request->getName(), $team->CityRDO()->getId())){
            $response->appendErrorMessage($msg);
        }else if(true !== $msg = $team->changeProfile($activeMembershipRdo->getId(), $request)){
            $response->appendErrorMessage($msg);
        }
        return $response;
    }
    
    /**
     * @param type $teamId
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
    protected function _findActiveMembershipOrDie($talentId){
        $talent = $this->talentRepository->ofId($talentId);
        if(empty($talent)){
            throw new \Resources\Exception\DoNotCatchException('talent not found');
        }
        $activeMembershipdo = $talent->anActiveMembershipRDO();
        if(empty($activeMembershipdo)){
            throw new \Resources\Exception\DoNotCatchException('active team not found');
        }
        return $activeMembershipdo;
    }
}
