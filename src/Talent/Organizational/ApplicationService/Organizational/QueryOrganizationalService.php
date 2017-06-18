<?php

namespace Talent\Organizational\ApplicationService\Organizational;

use Resources\ErrorMessage;

class QueryOrganizationalService {
    protected $repository;
    
    public function __construct(\Talent\Organizational\DomainModel\Talent\ITalentQueryRepository $talentQueryRepository) {
        $this->repository = $talentQueryRepository;
    }
    
    /**
     * @param type $talentId
     * @param type $organizationalId
     * @return \Talent\Organizational\ApplicationService\Organizational\OrganizationalQueryResponseObject
     */
    function showById($talentId, $organizationalId){
        $response = new OrganizationalQueryResponseObject();
        $talentQuery = $this->_findTalentQueryOrDie($talentId);
        $rdo = $talentQuery->anOrganizationalRdoOfId($organizationalId);
        if(empty($rdo)){
            $response->appendErrorMessage(ErrorMessage::error404_NotFound(['organizational not found']));
        }else{
            $response->setReadDataObject($rdo);
        }
        return $response;
    }
    
    /**
     * @param type $talentId
     * @return \Talent\Organizational\ApplicationService\Organizational\OrganizationalQueryResponseObject
     */
    function showAll($talentId){
        $response = new OrganizationalQueryResponseObject();
        $talentQuery = $this->_findTalentQueryOrDie($talentId);
        $rdos = $talentQuery->allOrganizationalRdo();
        if(empty($rdos)){
            $response->appendErrorMessage(ErrorMessage::error404_NotFound(['no organizational data found']));
        }else{
            $response->setBulkReadDataObject($rdos);
        }
        return $response;
    }
    
    /**
     * @param type $id
     * @return Talent\Organizational\DomainModel\Talent\TalentQuery
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
