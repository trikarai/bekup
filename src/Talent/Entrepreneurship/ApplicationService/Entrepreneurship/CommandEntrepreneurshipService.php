<?php

namespace Talent\Entrepreneurship\ApplicationService\Entrepreneurship;

use Resources\ResponseObject;
use Talent\Entrepreneurship\DomainModel\Entrepreneurship\Service\EntrepreneurshipDataValidationService;
use Talent\Entrepreneurship\DomainModel\Entrepreneurship\DataObject\EntrepreneurshipWriteDataObject;

class CommandEntrepreneurshipService {
    protected $repository;
    
    /**
     * @param \Talent\Entrepreneurship\DomainModel\Talent\ITalentRepository $talentRepository
     */
    public function __construct(\Talent\Entrepreneurship\DomainModel\Talent\ITalentRepository $talentRepository) {
        $this->repository = $talentRepository;
    }
    
    protected function _validationService(){
        return new EntrepreneurshipDataValidationService();
    }
    
    /**
     * @param type $talentId
     * @param EntrepreneurshipWriteDataObject $request
     * @return ResponseObject
     */
    function add($talentId, EntrepreneurshipWriteDataObject $request){
        $response = new ResponseObject();
        $talent = $this->_findTalentOrDie($talentId);
        
        if(true !== $msg = $this->_validationService()->isValidToAdd($request)){
            $response->appendErrorMessage($msg);
        }else if(true !== $msg = $talent->addEntrepreneushipExperience($request)){
            $response->appendErrorMessage($msg);
        }else{
            $this->repository->update();
        }
        return $response;
    }
    
    /**
     * @param type $talentId
     * @param type $entrepreneurshipId
     * @param EntrepreneurshipWriteDataObject $request
     * @return ResponseObject
     */
    function update($talentId, $entrepreneurshipId, EntrepreneurshipWriteDataObject $request){
        $response = new ResponseObject();
        $talent = $this->_findTalentOrDie($talentId);
        if(true !== $msg = $this->_validationService()->isValidToUpdate($request) ){
            $response->appendErrorMessage($msg);
        }else if(true !== $msg = $talent->updateEntrepreneushipExperience($entrepreneurshipId, $request)){
            $response->appendErrorMessage($msg);
        }else{
            $this->repository->update();
        }
        return $response;
    }

    /**
     * @param type $talentId
     * @param type $entrepreneurshipId
     * @return ResponseObject
     */
    function remove($talentId, $entrepreneurshipId){
        $response = new ResponseObject();
        $talent = $this->_findTalentOrDie($talentId);
        if(true !== $msg = $talent->removeEntrepreneushipExperience($entrepreneurshipId)){
            $response->appendErrorMessage($msg);
        }else{
            $this->repository->update();
        }
        return $response;
    }
    
    /**
     * @param type $id
     * @return \Talent\Entrepreneurship\DomainModel\Talent\Talent
     * @throws \Resources\Exception\DoNotCatchException
     */
    protected function _findTalentOrDie($id){
        $talent = $this->repository->OfId($id);
        if(empty($talent)){
            throw new \Resources\Exception\DoNotCatchException('talent not found');
        }
        return $talent;
    }
}
