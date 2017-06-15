<?php

namespace Talent\Skill\ApplicationService\SkillScore;

use Resources\ErrorMessage;
use Talent\Skill\DomainModel\Talent\Talent;

class QuerySkillScoreService {
    protected $repository;
    
    public function __construct(\Talent\Skill\DomainModel\Talent\ITalentRepository $talentRepository) {
        $this->repository = $talentRepository;
    }
    
    /**
     * @param type $talentId
     * @param type $skillScoreId
     * @return \Talent\Skill\ApplicationService\SkillScore\SkillScoreResponseObject
     */
    function showByid($talentId, $skillScoreId){
        $response = new SkillScoreResponseObject();
        $talent = $this->_findTalentOrDie($talentId);
        $skillScoreRDO = $talent->aSkillScoreReadDataObjectOfId($skillScoreId);
        
        if(empty($skillScoreRDO)){
            $response->appendErrorMessage(ErrorMessage::error404_NotFound(['skill score not found or already removed']));
        }else{
            $response->setReadDataObject($skillScoreRDO);
        }
        return $response;
    }
    
    /**
     * @param type $talentId
     * @return \Talent\Skill\ApplicationService\SkillScore\SkillScoreResponseObject
     */
    function showAll($talentId){
        $response = new SkillScoreResponseObject();
        $talent = $this->_findTalentOrDie($talentId);
        $skillScoreRDOs = $talent->allSkillScoreReadDataObject();
        
        if(empty($skillScoreRDOs)){
            $response->appendErrorMessage(ErrorMessage::error404_NotFound(['no skill score found']));
        }else{
            foreach($skillScoreRDOs as $rdo){
                $response->setReadDataObject($rdo);
            }
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
