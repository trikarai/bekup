<?php

namespace Talent\Skill\ApplicationService\SkillScore;

use Resources\ResponseObject;
use Talent\Skill\DomainModel\SkillScore\Service\SkillScoreDataValidationService;
use Talent\Skill\DomainModel\Talent\Talent;

class CommandSkillScoreService {
    protected $repository;
    
    /**
     * @param \Talent\Skill\DomainModel\Talent\ITalentRepository $talentRepository
     */
    public function __construct(\Talent\Skill\DomainModel\Talent\ITalentRepository $talentRepository) {
        $this->repository = $talentRepository;
    }
    
    /**
     * @return SkillScoreDataValidationService
     */
    protected function _dataValidationService(){
        return new SkillScoreDataValidationService();
    }
    
    /**
     * @param type $talentId
     * @param type $skillScoreId
     * @param type $scoreValue
     * @return ResponseObject
     */
    function update($talentId, $skillScoreId, $scoreValue){
        $response = new ResponseObject();
        $talent = $this->_findTalentOrDie($talentId);
        
        if(true !== $msg = $this->_dataValidationService()->isValidToUpdate($scoreValue)){
            $response->appendErrorMessage($msg);
        }else if(true !== $msg = $talent->updateSkillScore($skillScoreId, $scoreValue)){
            $response->appendErrorMessage($msg);
        }else{
            $this->repository->update();
        }
        return $response;
    }
    
    /**
     * @param type $talentId
     * @param type $skillScoreId
     * @return ResponseObject
     */
    function remove($talentId, $skillScoreId){
        $response = new ResponseObject();
        $talent = $this->_findTalentOrDie($talentId);
        if(true !== $msg = $talent->removeSkillScore($skillScoreId)){
            $response->appendErrorMessage($msg);
        }else{
            $this->repository->update();
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
