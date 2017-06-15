<?php

namespace Talent\WorkingExperience\ApplicationService\WorkingExperience;

use Talent\WorkingExperience\DomainModel\Talent\Talent;
use Resources\ErrorMessage;

class QueryWorkingExperienceService {
    protected $repository;

    public function __construct(\Talent\WorkingExperience\DomainModel\Talent\ITalentRepository $talentRepository) {
        $this->repository = $talentRepository;
    }

    /**
     * @param type $talentId
     * @param type $workingExperienceId
     * @return \Talent\WorkingExperience\ApplicationService\WorkingExperience\WorkingExperienceQueryResponseObject
     */
    function showById($talentId, $workingExperienceId){
        $response = new WorkingExperienceQueryResponseObject();
        $talent = $this->_findTalentOrDie($talentId);
        $rdo = $talent->aWorkingExperienceReadDataObjectOfId($workingExperienceId);
        if(empty($rdo)){
            $response->appendErrorMessage(ErrorMessage::error404_NotFound(['working experience not found']));
        }else{
            $response->setReadDataObject($rdo);
        }
        return $response;
    }

    /**
     * @param type $talentId
     * @return \Talent\WorkingExperience\ApplicationService\WorkingExperience\WorkingExperienceQueryResponseObject
     */
    function showAll($talentId){
        $response = new WorkingExperienceQueryResponseObject();
        $talent = $this->_findTalentOrDie($talentId);
        
        $rdos = $talent->allWorkingExperienceReadDataObject();
        if(empty($rdos)){
            $response->appendErrorMessage(ErrorMessage::error404_NotFound(['no working experience found']));
        }else{
            $response->setBulkReadDataObject($rdos);
        }
        return $response;
    }
    
    /**
     * @param type $talentId
     * @return Talent
     * @throws \Resources\Exception\DoNotCatchException
     */
    protected function _findTalentOrDie($talentId){
        $talent = $this->repository->ofId($talentId);
        if(empty($talent)){
            throw new \Resources\Exception\DoNotCatchException('talent not found');
        }
        return $talent;
    }
}
