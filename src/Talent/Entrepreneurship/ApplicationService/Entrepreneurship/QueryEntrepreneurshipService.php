<?php

namespace Talent\Entrepreneurship\ApplicationService\Entrepreneurship;

use Resources\ErrorMessage;

class QueryEntrepreneurshipService {
    protected $repository;
    
    /**
     * @param \Talent\Entrepreneurship\DomainModel\Talent\ITalentQueryRepository $talentQueryRepository
     */
    public function __construct(\Talent\Entrepreneurship\DomainModel\Talent\ITalentQueryRepository $talentQueryRepository) {
        $this->repository = $talentQueryRepository;
    }
    
    /**
     * @param type $talentId
     * @param type $entrepreneurshipId
     * @return \Talent\Entrepreneurship\ApplicationService\Entrepreneurship\EntrepreneurshipQueryResponseObject
     */
    function showById($talentId, $entrepreneurshipId){
        $response = new EntrepreneurshipQueryResponseObject();
        $talentQuery = $this->_findTalentQueryOrDie($talentId);
        $rdo = $talentQuery->anEntrepreneurshipRdoOfId($entrepreneurshipId);
        if(empty($rdo)){
            $response->appendErrorMessage(ErrorMessage::error404_NotFound(['entrepreneurship not found']));
        }else{
            $response->setReadDataObject($rdo);
        }
        return $response;
    }
    
    /**
     * @param type $talentId
     * @return \Talent\Entrepreneurship\ApplicationService\Entrepreneurship\EntrepreneurshipQueryResponseObject
     */
    function showAll($talentId){
        $response = new EntrepreneurshipQueryResponseObject();
        $talentQuery = $this->_findTalentQueryOrDie($talentId);
        $rdos = $talentQuery->allEntrepreneurshipRdo();
        if(empty($rdos)){
            $response->appendErrorMessage(ErrorMessage::error404_NotFound(['not entrepreneurship data found']));
        }else{
            $response->setBulkReadDataObject($rdos);
        }
        return $response;
    }
    
    /**
     * @param type $id
     * @return Talent\Entrepreneurship\DomainModel\Talent\TalentQuery
     * @throws \Resources\Exception\DoNotCatchException
     */
    protected function _findTalentQueryOrDie($id){
        $talentQuery = $this->repository->ofId($id);
        if(empty($talentQuery)){
            throw new \Resources\Exception\DoNotCatchException('talent not found');
        }
        return $talentQuery;
    }
    
}
