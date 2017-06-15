<?php

namespace Personnel\ApplicationService\Personnel;

use Resources\Exception\DoNotCatchException;
use Resources\ResponseObject;
use Resources\ErrorMessage;

use Personnel\DomainModel\Personnel\IPersonnelRepository;
use Personnel\DomainModel\Personnel\Personnel;
use Personnel\DomainModel\Personnel\ValueObject\PersonnelPassword;
use Personnel\DomainModel\Personnel\DataObject\PersonnelWriteDataObject;
use Personnel\DomainModel\Personnel\Service\PersonnelDataValidationService;
use Personnel\DomainModel\Personnel\Service\PersonnelAuthorizationService;
use Personnel\DomainModel\Personnel\Service\PreventDuplicatePersonnelService;

abstract class AddPersonnelServiceAbstract {
    /** @var IPersonnelRepository */
    protected $repository;
    protected $validationService;
    protected $authorizationService;
    protected $preventDuplicateService;
    
    public function __construct(IPersonnelRepository $personnelRepository) {
        $this->repository = $personnelRepository;
        $this->validationService = new PersonnelDataValidationService();
//        $this->validationService = new PersonnelValidationService();
        $this->authorizationService = new PersonnelAuthorizationService();
        $this->preventDuplicateService = new PreventDuplicatePersonnelService($personnelRepository);
    }
    
    /**
     * @param type $commanderId
     * @param PersonnelWriteDataObject $request
     * @return ResponseObject
     */
    function execute($commanderId, PersonnelWriteDataObject $request){
        $response = new ResponseObject();
        $commander = $this->_findPersonnelOrDie($commanderId);
        
        if(true !== $msg = $this->authorizationService->isAuthorizedToAdd($commander->toReadDataObject())){
            $response->appendErrorMessage($msg);
        }else if(true !== $msg = $this->validationService->isValidToAdd($request)){
            $response->appendErrorMessage($msg);
        }else if(true !== $msg = $this->preventDuplicateService->isNotDuplicateEmail($request->getEmail())){
            $response->appendErrorMessage($msg);
//        }else if(true !== $msg = $this->_isResourceAvailable($request)){
//            $response->appendErrorMessage($msg);
        }else if(true !== $msg = $this->_addPersonnelToRepository($request)){
            $response->appendErrorMessage($msg);
//            $personnel = $this->_createPersonnel($request);
//            $this->repository->add($personnel);
        }
        return $response;
    }
    
    /**
     * @param type $password
     * @return PersonnelPassword
     */
//    protected function _createPersonnelPassword($password){
//        return PersonnelPassword::fromNative($password);
//    }


    /**
     * @param string $personnelId
     * @return Personnel
     * @throws DoNotCatchException
     */
    protected function _findPersonnelOrDie($personnelId){
        $personnel = $this->repository->ofId($personnelId);
        if(empty($personnel)){
            throw new DoNotCatchException('personnel not found');
        }
        return $personnel;
    }
    
    /**
     * @param PersonnelWriteDataObject $request
     * @return Personnel
     */
//    abstract protected function _createPersonnel(PersonnelWriteDataObject $request);
    
    /**
     * @param PersonnelWriteDataObject $request
     * @return true||ErrorMessage
     */
//    abstract protected function _isResourceAvailable(PersonnelWriteDataObject $request);
    
    /**
     * @param PersonnelWriteDataObject $request
     * @return true||ErrorMessage
     */
    abstract protected function _addPersonnelToRepository(PersonnelWriteDataObject $request);
    
}
