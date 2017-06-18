<?php

namespace Team\Idea\ApplicationService\Superhero;

use Resources\ResponseObject;
use Team\Idea\DomainModel\Superhero\DataObject\SuperheroWriteDataObject;
use Team\Idea\DomainModel\Superhero\Service\SuperheroDataValidationService;

use Resources\Exception\DoNotCatchException;

class CommandSuperheroService {
    protected $repository;
    
    /**
     * @param \Team\Idea\DomainModel\Talent\ITalentRepository $talentRepository
     */
    public function __construct(\Team\Idea\DomainModel\Talent\ITalentRepository $talentRepository) {
        $this->repository = $talentRepository;
    }
    
    /**
     * @return SuperheroDataValidationService
     */
    protected function _validationService(){
        return new SuperheroDataValidationService();
    }
    
    /**
     * @param type $talentId
     * @param SuperheroWriteDataObject $request
     * @return ResponseObject
     */
    function add($talentId, SuperheroWriteDataObject $request){
        $response = new ResponseObject();
        $talent = $this->_findTalentOrDie($talentId);
        
        if(true !== $msg = $this->_validationService()->isValidToAdd($request)){
            $response->appendErrorMessage($msg);
        }else if(true !== $msg = $talent->addSuperhero($request)){
            $response->appendErrorMessage($msg);
        }else{
            $this->repository->update();
        }
        return $response;
    }
    
    /**
     * @param type $talentId
     * @param type $superheroId
     * @param SuperheroWriteDataObject $request
     * @return ResponseObject
     */
    function update($talentId, $superheroId, SuperheroWriteDataObject $request){
        $response = new ResponseObject();
        $talent = $this->_findTalentOrDie($talentId);
        
        if(true !== $msg = $this->_validationService()->isValidToUpdate($request)){
            $response->appendErrorMessage($msg);
        }else if(true !== $msg = $talent->updateSuperhero($superheroId, $request)){
            $response->appendErrorMessage($msg);
        }else{
            $this->repository->update();
        }
        return $response;
    }
    
    /**
     * @param type $talentId
     * @param type $superheroId
     * @return ResponseObject
     */
    function remove($talentId, $superheroId){
        $response = new ResponseObject();
        $talent = $this->_findTalentOrDie($talentId);
        
        if(true !== $msg = $talent->removeSuperhero($superheroId)){
            $response->appendErrorMessage($msg);
        }else{
            $this->repository->update();
        }
        return $response;
    }
    
    /**
     * @param string $id
     * @return \Team\Idea\DomainModel\Talent\Talent
     * @throws DoNotCatchException
     */
    protected function _findTalentOrDie($id){
        $talent = $this->repository->ofId($id);
        if(empty($talent)){
            throw new DoNotCatchException("Talent not found");
        }
        return $talent;
    }
}
