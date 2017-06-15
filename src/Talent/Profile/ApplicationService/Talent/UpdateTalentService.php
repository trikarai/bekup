<?php

namespace Talent\Profile\ApplicationService\Talent;

use Resources\ResponseObject;

use Talent\Profile\DomainModel\Talent\Talent;
use Talent\Profile\DomainModel\Talent\Service\TalentDataValidationService;
use Talent\Profile\DomainModel\Talent\Service\PreventDuplicateTalentService;
use Talent\Profile\DomainModel\Talent\DataObject\TalentWriteDataObject;

class UpdateTalentService {
    protected $repository;
    protected $validationService;
    protected $preventDuplicateService;
    
    /**
     * @param \Talent\Profile\DomainModel\Talent\ITalentRepository $talentRepository
     */
    public function __construct(\Talent\Profile\DomainModel\Talent\ITalentRepository $talentRepository) {
        $this->repository = $talentRepository;
        $this->validationService = new TalentDataValidationService();
        $this->preventDuplicateService = new PreventDuplicateTalentService($talentRepository);
    }
    
    /**
     * @param type $talentId
     * @param TalentWriteDataObject $request
     * @return ResponseObject
     */
    function execute($talentId, TalentWriteDataObject $request){
        $response = new ResponseObject();
        $talent = $this->_findTalentOrDie($talentId);
        
        if(true!== $msg = $this->validationService->isValidToUpdate($request)){
            $response->appendErrorMessage($msg);
        }else if($talent->getEmail() !== $request->getEmail() &&
                true !== $msg = $this->preventDuplicateService->isNotDuplicateUserEmail($request->getEmail())
        ){
            $response->appendErrorMessage($msg);
        }else{
            $talent->change($request);
            $this->repository->update();
        }
        return $response;
    }
    
    /**
     * @param type $id
     * @return Talent
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
