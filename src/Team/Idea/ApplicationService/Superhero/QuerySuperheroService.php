<?php

namespace Team\Idea\ApplicationService\Superhero;

use Team\Idea\ApplicationService\Superhero\SuperheroMessageObject;

use Resources\ErrorMessage;
use Resources\Exception\DoNotCatchException;

class QuerySuperheroService {
    protected $repository;
    
    /**
     * @param \Team\Idea\DomainModel\Talent\ITalentRepository $talentRepository
     */
    public function __construct(\Team\Idea\DomainModel\Talent\ITalentRepository $talentRepository) {
        $this->repository = $talentRepository;
    }
    
    /**
     * @param type $talentId
     * @return \Team\Idea\ApplicationService\Superhero\SuperheroQueryResponseObject
     */
    function showAll($talentId){
        $response = new SuperheroQueryResponseObject();
        $talent = $this->_findTalentOrDie($talentId);
        
        $rdos = $talent->allSuperheroRdos();
        if(empty($rdos)){
            $response->appendErrorMessage(ErrorMessage::error404_NotFound(['no superhero found']));
        }else{
            foreach($rdos as $rdo){
                $response->setReadDataObject($rdo);
            }
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
        $talent = $this->_findTalentOrDie($talentId);
        $rdo = $talent->aSuperheroRdoById($superheroId);
        
        if(empty($rdo)){
            $response->appendErrorMessage(ErrorMessage::error404_NotFound(['superhero not found']));
        }else{
            $response->setReadDataObject($rdo);
        }
        return $response;
    }
    
    /**
     * @param string $id
     * @return \Team\Idea\DomainModel\Talent\Talent
     */
    protected function _findTalentOrDie($id){
        $talent = $this->repository->ofId($id);
        if(empty($talent)){
            throw new DoNotCatchException("Talent not found");
        }
        return $talent;
    }
}
