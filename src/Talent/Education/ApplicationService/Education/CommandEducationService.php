<?php

namespace Talent\Education\ApplicationService\Education;

use Resources\ResponseObject;
use Talent\Education\DomainModel\Education\Service\EducationDataValidationService;
use Talent\Education\DomainModel\Education\DataObject\EducationWriteDataObject;

class CommandEducationService {
    protected $repository;
    protected $validationService;
    
    public function __construct(\Talent\Education\DomainModel\Talent\ITalentRepository $talentRepository) {
        $this->repository = $talentRepository;
        $this->validationService = new EducationDataValidationService();
    }
    
    /**
     * @param type $talentId
     * @param EducationWriteDataObject $request
     * @return ResponseObject
     */
    function add($talentId, EducationWriteDataObject $request){
        $response  = new ResponseObject();
        $talent = $this->_findTalentOrDie($talentId);
        
        if(true !== $msg = $this->validationService->isValidToAdd($request)){
            $response->appendErrorMessage($msg);
        }else if(true !== $msg = $talent->addEducation($request)){
            $response->appendErrorMessage($msg);
        }else{
            $this->repository->update();
        }
        return $response;
    }
    
    /**
     * @param type $talentId
     * @param type $educationId
     * @param EducationWriteDataObject $request
     * @return ResponseObject
     */
    function update($talentId, $educationId, EducationWriteDataObject $request){
        $response = new ResponseObject();
        $talent = $this->_findTalentOrDie($talentId);
        
        if(true !== $msg = $this->validationService->isValidToUpdate($request)){
            $response->appendErrorMessage($msg);
        }else if(true !== $msg = $talent->updateEducation($educationId, $request)){
            $response->appendErrorMessage($msg);
        }else{
            $this->repository->update();
        }
        return $response;
    }
    
    /**
     * @param type $talentId
     * @param type $educationId
     * @return ResponseObject
     */
    function remove($talentId, $educationId){
        $response = new ResponseObject();
        $talent = $this->_findTalentOrDie($talentId);
        
        if(true !== $msg = $talent->removeEducation($educationId)){
            $response->appendErrorMessage($msg);
        }else{
            $this->repository->update();
        }
        return $response;
    }
    
    /**
     * @param type $talentId
     * @return \Talent\Education\DomainModel\Talent\Talent
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
