<?php

namespace Talent\Profile\ApplicationService\Talent;

use Resources\ResponseObject;

use Talent\Profile\DomainModel\Talent\Talent;
use Talent\Profile\DomainModel\Talent\DataObject\TalentWriteDataObject;
use Talent\Profile\DomainModel\Talent\Service\TalentDataValidationService;
use Talent\Profile\DomainModel\Talent\Service\PreventDuplicateTalentService;

class SignUpTalentDiloService {
    protected $repository;
    protected $cityRdoRepository;
    protected $trackRdoRepository;
    protected $validationService;
    protected $preventDuplicateService;
    
    protected $talent;
    
    public function __construct(
            \Talent\Profile\DomainModel\Talent\ITalentRepository $talentRepository,
            \Superclass\DomainModel\City\ICityRdoRepository $cityRdoRepository,
            \Superclass\DomainModel\Track\ITrackRdoRepository $trackRdoRepository
    ) {
        $this->repository = $talentRepository;
        $this->cityRdoRepository = $cityRdoRepository;
        $this->trackRdoRepository = $trackRdoRepository;
        $this->validationService = new TalentDataValidationService();
        $this->preventDuplicateService = new PreventDuplicateTalentService($talentRepository);
    }
    
    function prepareTalentData(TalentWriteDataObject $request){
        $response = new ResponseObject();
        $cityRDO = $this->cityRdoRepository->ofId($request->getCityId());
        
        if(empty($cityRDO)){
            $response->appendErrorMessage(\Resources\ErrorMessage::error404_NotFound(['city reference not found']));
        }else if(false === $trackRDO = $this->_findTrackRdo($request->getTrackId())){
            $response->appendErrorMessage(\Resources\ErrorMessage::error404_NotFound(['track reference not found']));
        }else if(true !== $msg = $this->validationService->isValidToSignUp($request)){
            $response->appendErrorMessage($msg);
        }else if(true !== $msg = $this->preventDuplicateService->isNotDuplicateUserName($request->getUserName())){
            $response->appendErrorMessage($msg);
        }else if(true !== $msg = $this->preventDuplicateService->isNotDuplicateUserEmail($request->getEmail())){
            $response->appendErrorMessage($msg);
        }else{
            $$this->talent = new Talent($this->repository->nextIdentity(), $request, $cityRDO, $trackRDO);
        }
        return $response;
    }
    function execute(){
        $response = new ResponseObject();
        if(empty($this->talent)){
            $response->appendErrorMessage(\Resources\ErrorMessage::error400_BadRequest(['talent data preparation failed']));
        }else{
            $this->repository->add($talent);
        }
        return $response;
    }
}
