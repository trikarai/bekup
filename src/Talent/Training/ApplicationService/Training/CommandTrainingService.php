<?php

namespace Talent\Training\ApplicationService\Training;

use Resources\ResponseObject;
use Talent\Training\DomainModel\Training\Service\TrainingDataValidationService;
use Talent\Training\DomainModel\Training\DataObject\TrainingWriteDataObject;

class CommandTrainingService {
    protected $repository;
    protected $validationService;
    
    public function __construct(\Talent\Training\DomainModel\Talent\ITalentRepository $talentRepository) {
        $this->repository = $talentRepository;
        $this->validationService = new TrainingDataValidationService();
    }
    
    /**
     * @param type $talentId
     * @param TrainingWriteDataObject $request
     * @return ResponseObject
     */
    function add($talentId, TrainingWriteDataObject $request){
        $response = new ResponseObject();
        $talent = $this->_findTalentOrDie($talentId);
        
        if(true !== $msg = $this->validationService->isValidToAdd($request)){
            $response->appendErrorMessage($msg);
        }else if(true !== $msg = $talent->addTraining($request)){
            $response->appendErrorMessage($msg);
        }else{
            $this->repository->update();
        }
        return $response;
    }
    
    /**
     * @param type $talentId
     * @param type $trainingId
     * @param TrainingWriteDataObject $request
     * @return ResponseObject
     */
    function update($talentId, $trainingId, TrainingWriteDataObject $request){
        $response = new ResponseObject();
        $talent = $this->_findTalentOrDie($talentId);
        
        if(true !== $msg = $this->validationService->isValidToUpdate($request)){
            $response->appendErrorMessage($msg);
        }else if(true !== $msg = $talent->updateTraining($trainingId, $request)){
            $response->appendErrorMessage($msg);
        }else{
            $this->repository->update();
        }
        return $response;
    }
    
    /**
     * @param type $talentId
     * @param type $trainingId
     * @return MessageObject
     */
    function remove($talentId, $trainingId){
        $response = new ResponseObject();
        $talent = $this->_findTalentOrDie($talentId);
        
        if(true !== $msg = $talent->removeTraining($trainingId)){
            $response->appendErrorMessage($msg);
        }else{
            $this->repository->update();
        }
        return $response;
    }
    
    /**
     * @param type $talentId
     * @return \Talent\Training\DomainModel\Talent\Talent
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
