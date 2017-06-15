<?php

namespace Programme\Description\ApplicationService\Programme;

use Resources\ResponseObject;
use Resources\ErrorMessage;
use Programme\Description\DomainModel\Programme\Programme;
use Programme\Description\DomainModel\Programme\DataObject\ProgrammeWriteDataObject;
use Programme\Description\DomainModel\Programme\Service\ProgrammeAuthorizationService;
use Programme\Description\DomainModel\Programme\Service\ProgrammeDataValidationService;
use Programme\Description\DomainModel\Programme\Service\PreventDuplicateProgrammeService;
use Personnel\DomainModel\Personnel\DataObject\PersonnelReadDataObject;

class CommandProgrammeService {
    protected $repository;
    protected $personnelRdoRepository;
    protected $authorizationService;


    /**
     * @param \Programme\Description\DomainModel\Programme\IProgrammeRepository $programmeRepository
     */
    public function __construct(
            \Programme\Description\DomainModel\Programme\IProgrammeRepository $programmeRepository,
            \Personnel\DomainModel\Personnel\DataObject\IPersonnelRdoRepository $personnelRdoRepository
    ) {
        $this->repository = $programmeRepository;
        $this->personnelRdoRepository = $personnelRdoRepository;
        $this->authorizationService = new ProgrammeAuthorizationService();
    }
    
    protected function _validationService(){
        return new ProgrammeDataValidationService();
    }
    protected function _preventDuplicateService(){
        return new PreventDuplicateProgrammeService($this->repository);
    }

    /**
     * @param type $personnelId
     * @param type $programmeId
     * @param ProgrammeWriteDataObject $request
     * @return ResponseObject
     */
    function update($personnelId, $programmeId, ProgrammeWriteDataObject $request){
        $response = new ResponseObject();
        $personnelRDO = $this->_findPersonnelOrDie($personnelId);
        $programme = $this->_findProgramme($programmeId);
        
        if(empty($programme)){
            $response->appendErrorMessage(ErrorMessage::error404_NotFound(['programme not found']));
        }else if(true !== $msg = $this->authorizationService->isAuthorizedToUpdate($personnelRDO)){
            $response->appendErrorMessage($msg);
        }else if(true !== $msg = $this->_validationService()->isValidToUpdate($request)){
            $response->appendErrorMessage($msg);
        }else if($programme->getName () !== $request->getName () &&
                true !== $msg = $this->_preventDuplicateService()->isNotDuplicateName($request->getName())){
            $response->appendErrorMessage($msg);
        }else if(true !== $msg = $programme->change($request)){
            $response->appendErrorMessage($msg);
        }else{
            $this->repository->update();
        }
        return $response;
    }
    
    /**
     * @param type $personnelId
     * @param type $programmeId
     * @return ResponseObject
     */
    function remove($personnelId, $programmeId){
        $response = new ResponseObject();
        $personnelRDO = $this->_findPersonnelOrDie($personnelId);
        $programme = $this->_findProgramme($programmeId);
        
        if(empty($programme)){
            $response->appendErrorMessage(ErrorMessage::error404_NotFound(['programme not found']));
        }else if(true !== $msg = $this->authorizationService->isAuthorizedToRemove($personnelRDO)){
            $response->appendErrorMessage($msg);
        }else{
            $programme->remove();
            $this->repository->update();
        }
        return $response;
    }
    
    /**
     * @param type $id
     * @return PersonnelReadDataObject
     * @throws \Resources\Exception\DoNotCatchException
     */
    protected function _findPersonnelOrDie($id){
        $personnelRDO = $this->personnelRdoRepository->ofId($id);
        if(empty($personnelRDO)){
            throw new \Resources\Exception\DoNotCatchException('personnel not found');
        }
        return $personnelRDO;
    }
    /**
     * @param type $programmeId
     * @return Programme
     */
    protected function _findProgramme($programmeId){
        $programme = $this->repository->ofId($programmeId);
        if(empty($programme)){
            return null;
        }
        return $programme;
    }
}