<?php

namespace Programme\Description\ApplicationService\Programme;

use Resources\ResponseObject;
use Resources\ErrorMessage;

use Personnel\ApplicationService\Personnel\PersonnelFinder;
use Programme\Description\DomainModel\Programme\Programme;
use Programme\Description\DomainModel\Programme\Service\ProgrammeAuthorizationService;
use Programme\Description\DomainModel\Programme\Service\ProgrammeDataValidationService;
use Programme\Description\DomainModel\Programme\Service\PreventDuplicateProgrammeService;
use Programme\Description\DomainModel\Programme\DataObject\ProgrammeWriteDataObject;

class AddProgrammeService {
    protected $repository;
    protected $personnelRdoRepository;
    protected $personnelFinder;
    protected $authorizationService;
    protected $validationService;
    protected $preventDuplicateService;
    
    /**
     * @param \Programme\Description\DomainModel\Programme\IProgrammeRepository $programmeRepository
     * @param PersonnelFinder $personnelFinder
     */
    public function __construct(
            \Programme\Description\DomainModel\Programme\IProgrammeRepository $programmeRepository,
            \Personnel\DomainModel\Personnel\DataObject\IPersonnelRdoRepository $personnelRdoRepository
    ) {
        $this->repository = $programmeRepository;
        $this->personnelRdoRepository = $personnelRdoRepository;
        $this->authorizationService = new ProgrammeAuthorizationService();
        $this->validationService = new ProgrammeDataValidationService();
        $this->preventDuplicateService = new PreventDuplicateProgrammeService($programmeRepository);
    }
    
    /**
     * @param type $personnelId
     * @param ProgrammeWriteDataObject $request
     * @return ResponseObject
     */
    function execute($personnelId, ProgrammeWriteDataObject $request){
        $response = new ResponseObject();
        $personnelRDO = $this->_findPersonnelOrDie($personnelId);
        
        if(true !== $msg = $this->authorizationService->isAuthorizedToAdd($personnelRDO)){
            $response->appendErrorMessage($msg);
        }else if(true !== $msg = $this->validationService->isValidToAdd($request)){
            $response->appendErrorMessage($msg);
        }else if(true !== $msg = $this->preventDuplicateService->isNotDuplicateName($request->getName())){
            $response->appendErrorMessage($msg);
        }else{
            try{
                $programme = new Programme($this->repository->nextIdentity(), $request);
                $this->repository->add($programme);
            }catch(\Resources\Exception\CatchableException $ex){
                $response->appendErrorMessage(ErrorMessage::error400_BadRequest([$ex->getMessage()]));
            }
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
}