<?php

namespace Talent\Education\ApplicationService\Education;

use Resources\ErrorMessage;

class QueryEducationService {
    protected $repository;
    
    public function __construct(\Talent\Education\DomainModel\Talent\ITalentRepository $talentRepository) {
        $this->repository = $talentRepository;
    }
    
    /**
     * @param type $talentId
     * @param type $educationId
     * @return \Talent\Education\ApplicationService\Education\EducationQueryResponseObject
     */
    function showById($talentId, $educationId){
        $response = new EducationQueryResponseObject();
        $talent = $this->_findTalentOrDie($talentId);
        $rdo = $talent->anEducationReadDataObjectOfId($educationId);
        if(empty($rdo)){
            $response->appendErrorMessage(ErrorMessage::error404_NotFound(['education not found']));
        }else{
            $response->setReadDataObject($rdo);
        }
        return $response;
    }
    
    /**
     * @param type $talentId
     * @return \Talent\Education\ApplicationService\Education\EducationQueryResponseObject
     */
    function showAll($talentId){
        $response = new EducationQueryResponseObject();
        $talent = $this->_findTalentOrDie($talentId);
        $rdos = $talent->allEducationReadDataobject();
        if(empty($rdos)){
            $response->appendErrorMessage(ErrorMessage::error404_NotFound(['no education found']));
        }else{
            foreach($rdos as $rdo){
                $response->setReadDataObject($rdo);
            }
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
