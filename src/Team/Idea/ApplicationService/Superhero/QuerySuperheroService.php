<?php

namespace Team\Idea\ApplicationService\Superhero;

use Resources\ErrorMessage;
use Resources\Exception\DoNotCatchException;

class QuerySuperheroService {
    protected $repository;
    
    /**
     * @param \Team\Idea\DomainModel\Talent\ITalentQueryRepository $talentQueryRepository
     */
    public function __construct(\Team\Idea\DomainModel\Talent\ITalentQueryRepository $talentQueryRepository) {
        $this->repository = $talentQueryRepository;
    }
    
    /**
     * @param type $talentId
     * @return \Team\Idea\ApplicationService\Superhero\SuperheroQueryResponseObject
     */
    function showAll($talentId){
        $response = new SuperheroQueryResponseObject();
        
        $talentQuery = $this->_findTalentQueryOrDie($talentId);
        
        $rdos = $talentQuery->allSuperheroRdos();
        if(empty($rdos)){
            $response->appendErrorMessage(ErrorMessage::error404_NotFound(['no superhero found']));
        }else{
            $response->setBulkReadDataObject($rdos);
        }
        return $response;
    }
    /**
     * 
     * @param type $talentId
     * @param type $superheroId
     * @return \Team\Idea\ApplicationService\Superhero\SuperheroQueryResponseObject
     */
    function showById($talentId, $superheroId){
        $response = new SuperheroQueryResponseObject();
        $talentQuery = $this->_findTalentQueryOrDie($talentId);
        $rdo = $talentQuery->aSuperheroRdoOfId($superheroId);
        
        if(empty($rdo)){
            $response->appendErrorMessage(ErrorMessage::error404_NotFound(['superhero not found']));
        }else{
            $response->setReadDataObject($rdo);
        }
        return $response;
    }
    
    /**
     * @param type $id
     * @return \Team\Idea\DomainModel\Talent\TalentQuery
     * @throws DoNotCatchException
     */
    protected function _findTalentQueryOrDie($id){
        $talentQuery = $this->repository->ofId($id);
        if(empty($talentQuery)){
            throw new DoNotCatchException("Talent not found");
        }
        return $talentQuery;
    }
}
