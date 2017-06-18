<?php

namespace Talent\Organizational\ApplicationService\Organizational;

use Resources\ResponseObject;
use Talent\Organizational\DomainModel\Organizational\Service\OrganizationalDataValidationService;
use Talent\Organizational\DomainModel\Organizational\DataObject\OrganizationalWriteDataObject;

class CommandOrganizationalService {
    protected $repository;
    
    public function __construct(\Talent\Organizational\DomainModel\Talent\ITalentRepository $talentRepository) {
        $this->repository = $talentRepository;
    }
    
    protected function _validationService(){
        return new OrganizationalDataValidationService();
    }
    
    /**
     * @param type $talentId
     * @param OrganizationalWriteDataObject $request
     * @return ResponseObject
     */
    function add($talentId, OrganizationalWriteDataObject $request){
        $response = new ResponseObject();
        $talent = $this->_findTalentOrDie($talentId);
        
        if(true !== $msg = $this->_validationService()->isValidToAdd($request)){
            $response->appendErrorMessage($msg);
        }else if(true !== $msg = $talent->addOrganizationExperience($request)){
            $response->appendErrorMessage($msg);
        }else{
            $this->repository->update();
        }
        return $response;
    }
    
    /**
     * @param type $talentId
     * @param type $organizationalId
     * @param OrganizationalWriteDataObject $request
     * @return ResponseObject
     */
    function update($talentId, $organizationalId, OrganizationalWriteDataObject $request){
        $response = new ResponseObject();
        $talent = $this->_findTalentOrDie($talentId);
        
        if(true !== $msg = $this->_validationService()->isValidToUpdate($request)){
            $response->appendErrorMessage($msg);
        }else if(true !== $msg = $talent->updateOrganizationExperience($organizationalId, $request)){
            $response->appendErrorMessage($msg);
        }else{
            $this->repository->update();
        }
        return $response;
    }
    
    /**
     * @param type $talentId
     * @param type $organizationalId
     * @return ResponseObject
     */
    function remove($talentId, $organizationalId){
        $response = new ResponseObject();
        $talent = $this->_findTalentOrDie($talentId);
        
        if(true !== $msg = $talent->removeOrganizationExperience($organizationalId)){
            $response->appendErrorMessage($msg);
        }else{
            $this->repository->update();
        }
        return $response;
    }
    
    /**
     * @param type $id
     * @return Talent\Organizational\DomainModel\Talent\Talent
     * @throws \Resources\Exception\DoNotCatchException
     */
    protected function _findTalentOrDie($id){
        $talent = $this->repository->ofId($id);
        if(empty($talent)){
            throw new \Resources\Exception\DoNotCatchException('talent not found');
        }
        return $talent;
    }
}
