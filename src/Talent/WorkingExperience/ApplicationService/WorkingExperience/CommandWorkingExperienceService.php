<?php

namespace Talent\WorkingExperience\ApplicationService\WorkingExperience;

use Resources\ResponseObject;

use Talent\WorkingExperience\DomainModel\WorkingExperience\DataObject\WorkingExperienceWriteDataObject;
use Talent\WorkingExperience\DomainModel\WorkingExperience\Service\WorkingExperienceDataValidationService;
use Talent\WorkingExperience\DomainModel\Talent\Talent;

class CommandWorkingExperienceService {
    protected $repository;
    protected $validationService;

    /**
     * @param \Talent\WorkingExperience\DomainModel\Talent\ITalentRepository $talentRepository
     */
    public function __construct(\Talent\WorkingExperience\DomainModel\Talent\ITalentRepository $talentRepository) {
        $this->repository = $talentRepository;
        $this->validationService = new WorkingExperienceDataValidationService();
    }
    
    /**
     * @param type $talentId
     * @param WorkingExperienceWriteDataObject $request
     * @return \Talent\WorkingExperience\ApplicationService\WorkingExperience\MessageObject|ResponseObject
     */
    function add($talentId, WorkingExperienceWriteDataObject $request){
        $response = new ResponseObject();
        $talent = $this->_findTalentOrDie($talentId);
        
        if(true !== $msg = $this->validationService->isValidToAdd($request)){
            $response->appendErrorMessage($msg);
        }else if(true !== $msg = $talent->addWorkingExperience($request)){
            $response->appendErrorMessage($msg);
        } else{
            $this->repository->update();
        }
        return $response;
    }
    
    /**
     * @param type $talentId
     * @param type $workingExperienceId
     * @param WorkingExperienceWriteDataObject $request
     * @return ResponseObject
     */
    function update($talentId, $workingExperienceId, WorkingExperienceWriteDataObject $request){
        $response = new ResponseObject();
        $talent = $this->_findTalentOrDie($talentId);
        if(true !== $msg = $this->validationService->isValidToUpdate($request)){
            $response->appendErrorMessage($msg);
        }else if(true !== $msg = $talent->updateWorkingExperience($workingExperienceId, $request)){
            $response->appendErrorMessage($msg);
        }else{
            $this->repository->update();
        }
        return $response;
    }
    
    /**
     * @param type $talentId
     * @param type $workingExperienceId
     * @return MessageObject
     */
    function remove($talentId, $workingExperienceId){
        $response = new ResponseObject();
        $talent = $this->_findTalentOrDie($talentId);
        
        if(true !== $msg = $talent->removeWorkingExperience($workingExperienceId)){
            $response->appendErrorMessage($msg);
        }else{
            $this->repository->update();
        }
        return $response;
    }
    
    /**
     * @param type $id
     * @return Talent;
     * @throws \Resources\Exception\DoNotCatchException
     */
    protected function _findTalentOrDie($id){
        $talent = $this->repository->ofId($id);
        if(empty($talent)){
            throw new \Resources\Exception\DoNotCatchException('talent not found');
        }
        return $talent;
    }
}
