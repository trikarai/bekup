<?php

namespace Talent\Profile\ApplicationService\Talent;

use Resources\ResponseObject;

use Talent\Profile\DomainModel\Talent\Talent;
use Talent\Profile\DomainModel\Talent\DataObject\TalentWriteDataObject;
use Talent\Profile\DomainModel\Talent\Service\TalentDataValidationService;
use Talent\Profile\DomainModel\Talent\Service\PreventDuplicateTalentService;

class SignUpTalentService {
    protected $repository;
    protected $cityRdoRepository;
    protected $trackRdoRepository;
    protected $validationService;
    protected $preventDuplicateService;
    
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
    
    /**
     * @param TalentWriteDataObject $request
     * @param type $cityId
     * @param type $trackId
     * @return ResponseObject|\Talent\Profile\ApplicationService\Talent\MessageObject
     */
    function execute(TalentWriteDataObject $request){
        $response = new ResponseObject();
        $cityRDO = $this->cityRdoRepository->ofId($request->getCityId());
        $trackRDO = $this->trackRdoRepository->ofId($request->getTrackId());
        
        if(empty($cityRDO)){
            $response->appendErrorMessage(\Resources\ErrorMessage::error404_NotFound(['city reference not found']));
        }else if(empty($trackRDO)){
            $response->appendErrorMessage(\Resources\ErrorMessage::error404_NotFound(['track reference not found']));
        }else if(true !== $msg = $this->validationService->isValidToSignUp($request)){
            $response->appendErrorMessage($msg);
        }else if(true !== $msg = $this->preventDuplicateService->isNotDuplicateUserName($request->getUserName())){
            $response->appendErrorMessage($msg);
        }else if(true !== $msg = $this->preventDuplicateService->isNotDuplicateUserEmail($request->getEmail())){
            $response->appendErrorMessage($msg);
        }else{
            $talent = new Talent($this->repository->nextIdentity(), $request, $cityRDO, $trackRDO);
            $this->repository->add($talent);
        }
        return $response;
    }
}