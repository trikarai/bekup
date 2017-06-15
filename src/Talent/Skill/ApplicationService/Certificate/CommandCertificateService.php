<?php

namespace Talent\Skill\ApplicationService\Certificate;

use Resources\ResponseObject;
use Talent\Skill\DomainModel\Certificate\DataObject\CertificateWriteDataObject;
use Talent\Skill\DomainModel\Certificate\Service\CertificateDataValidationService;

class CommandCertificateService {
    protected $repository;
    
    /**
     * @param \Talent\Skill\DomainModel\SkillScore\ISkillScoreRepository $skillScoreRepository
     */
    public function __construct(\Talent\Skill\DomainModel\SkillScore\ISkillScoreRepository $skillScoreRepository) {
        $this->repository = $skillScoreRepository;
    }
    /**
     * @return CertificateDataValidationService
     */
    protected function _dataValidationService(){
        return new CertificateDataValidationService();
    }
    
    /**
     * @param type $talentId
     * @param type $skillScoreid
     * @param CertificateWriteDataObject $request
     * @return ResponseObject
     */
    function add($talentId, $skillScoreid, CertificateWriteDataObject $request){
        $respond = new ResponseObject();
        $skillScore = $this->repository->ofId($skillScoreid, $talentId);
        if(empty($skillScore)){
            return $this->_buildSkillScoreNotFoundErrorResponse($respond);
        }
        if(true !== $msg = $this->_dataValidationService()->isValidToAdd($request)){
            $respond->appendErrorMessage($msg);
            return $respond;
        }
        $skillScore->addCertificate($request);
        $this->repository->update();
        return $respond;
    }
    
    /**
     * @param type $talentId
     * @param type $skillScoreid
     * @param type $certificateId
     * @param CertificateWriteDataObject $request
     * @return ResponseObject
     */
    function update($talentId, $skillScoreid, $certificateId, CertificateWriteDataObject $request){
        $respond = new ResponseObject();
        $skillScore = $this->repository->ofId($skillScoreid, $talentId);
        if(empty($skillScore)){
            return $this->_buildSkillScoreNotFoundErrorResponse($respond);
        }
        if(true !== $msg = $this->_dataValidationService()->isValidToUpdate($request)){
            $respond->appendErrorMessage($msg);
            return $respond;
        }
        if(true !== $message = $skillScore->updateCertificate($certificateId, $request)){
            $respond->appendErrorMessage($message);
            return $respond;
        }
        $this->repository->update();
        return $respond;
    }
    
    /**
     * @param type $talentId
     * @param type $skillScoreid
     * @param type $certificateId
     * @return ResponseObject
     */
    function remove($talentId, $skillScoreid, $certificateId){
        $respond = new ResponseObject();
        $skillScore = $this->repository->ofId($skillScoreid, $talentId);
        if(empty($skillScore)){
            return $this->_buildSkillScoreNotFoundErrorResponse($respond);
        }
        if(true !== $msg = $skillScore->removeCertificate($certificateId)){
            $respond->appendErrorMessage($msg);
            return $respond;
        }
        $this->repository->update();
        return $respond;
    }
    
    protected function _buildSkillScoreNotFoundErrorResponse(ResponseObject $respond){
        $errorMessage = \Resources\ErrorMessage::error404_NotFound(['skill score not found or already removed']);
        $respond->appendErrorMessage($errorMessage);
        return $respond;
    }
}
