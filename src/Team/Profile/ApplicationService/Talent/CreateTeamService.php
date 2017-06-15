<?php

namespace Team\Profile\ApplicationService\Talent;

use Team\Profile\DomainModel\Talent\Talent;
use Team\Profile\DomainModel\Team\DataObject\TeamWriteDataObject;
use Team\Profile\DomainModel\Team\Service\TeamDataValidationService;
use Team\Profile\DomainModel\Team\Service\PreventDuplicateTeamService;
use Team\Profile\DomainModel\Membership\Service\MembershipDataValidationService;

use Resources\ResponseObject;

class CreateTeamService {
    protected $talentRepository;
    protected $teamRepository;
    protected $teamDataValidationService;
    protected $membershipDataValidationService;
    protected $preventDuplicateService;
    
    /**
     * @param \Team\Profile\DomainModel\Talent\ITalentRepository $talentRepository
     * @param \Team\Profile\DomainModel\Team\ITeamRepository $teamRepository
     */
    public function __construct(
            \Team\Profile\DomainModel\Talent\ITalentRepository $talentRepository, 
            \Team\Profile\DomainModel\Team\ITeamRepository $teamRepository
    ) {
        $this->talentRepository = $talentRepository;
        $this->teamRepository = $teamRepository;
        $this->teamDataValidationService = new TeamDataValidationService();
        $this->preventDuplicateService = new PreventDuplicateTeamService($this->teamRepository);
        $this->membershipDataValidationService = new MembershipDataValidationService();
    }
    
    /**
     * @param type $talentId
     * @param TeamWriteDataObject $request
     * @param type $position
     * @return ResponseObject
     */
    function execute($talentId, TeamWriteDataObject $request, $position){
        $response = new ResponseObject();
        $talent = $this->_findTalentOrDie($talentId);
        
        if(true !== $msg = $this->teamDataValidationService->isValidToCreate($request)){
            $response->appendErrorMessage($msg);
        }else if(true !== $msg = $this->membershipDataValidationService->isValidToProcees($position, true)){
            $response->appendErrorMessage($msg);
        }else if(true !== $msg = $this->preventDuplicateService->isNotDuplicateNameWithinCity($request->getName(), $talent->cityRdo()->getId())){
            $response->appendErrorMessage($msg);
        }else if(true !== $msg = $talent->createTeam($this->teamRepository->nextIdentity(), $request, $position)){
            $response->appendErrorMessage($msg);
        }else{
            $this->talentRepository->update();
        }
        return $response;
    }
    
    /**
     * @param type $id
     * @return Talent
     * @throws \Resources\Exception\DoNotCatchException
     */
    protected function _findTalentOrDie($id){
        $talent = $this->talentRepository->ofId($id);
        if(empty($talent)){
            throw new \Resources\Exception\DoNotCatchException('talent not found');
        }
        return $talent;
    }
}
