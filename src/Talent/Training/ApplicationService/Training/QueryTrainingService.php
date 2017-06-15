<?php

namespace Talent\Training\ApplicationService\Training;

use Talent\Training\DomainModel\Talent\Talent;
use Resources\ErrorMessage;

class QueryTrainingService {
    protected $repository;
    
    public function __construct(\Talent\Training\DomainModel\Talent\ITalentRepository $talentRepository) {
        $this->repository = $talentRepository;
    }
    
    /**
     * @param type $talentId
     * @param type $trainingId
     * @return \Talent\Training\ApplicationService\Training\TrainingQueryResponseObject
     */
    function showById($talentId, $trainingId){
        $response = new TrainingQueryResponseObject();
        $talent = $this->_findTalentOrDie($talentId);
        $rdo = $talent->aTrainingReadDataObjectOfId($trainingId);
        
        if(empty($rdo)){
            $response->appendErrorMessage(ErrorMessage::error404_NotFound(["training not found"]));
        }else{
            $response->setReadDataObject($rdo);
        }
        return $response;
    }
    
    /**
     * @param type $talentId
     * @return \Talent\Training\ApplicationService\Training\TrainingQueryResponseObject
     */
    function showAll($talentId){
        $response = new TrainingQueryResponseObject();
        $talent = $this->_findTalentOrDie($talentId);
        $rdos = $talent->allTrainingReadDataObject();
        if(empty($rdos)){
            $response->appendErrorMessage(ErrorMessage::error404_NotFound(["no training found"]));
        }else{
            foreach($rdos as $rdo){
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
