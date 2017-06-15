<?php

namespace Talent\Skill\ApplicationService\Certificate;

class QueryCertificateService {
    protected $repository;
    
    /**
     * @param \Talent\Skill\DomainModel\SkillScore\ISkillScoreRepository $skillScoreRepository
     */
    public function __construct(\Talent\Skill\DomainModel\SkillScore\ISkillScoreRepository $skillScoreRepository) {
        $this->repository = $skillScoreRepository;

    }
    
    /**
     * @param type $talentId
     * @param type $skillScoreId
     * @param type $certificateId
     * @return \Talent\Skill\ApplicationService\Certificate\CertificateResponseObject
     */
    function showByid($talentId, $skillScoreId, $certificateId){
        $response = new CertificateResponseObject();
        $skillScore = $this->repository->ofId($skillScoreId, $talentId);
        if(empty($skillScore)){
            return $this->_buildSkillScoreNotFoundResponseMessage($response);
        }
        $certificateRDO = $skillScore->aCertificateReadDataObjectOfId($certificateId);
        if(empty($certificateRDO)){
            return $this->_buildCertificateNotFoundResponseMessage($response);
        }
        $response->setReadDataObject($certificateRDO);
        return $response;
    }
    
    /**
     * @param type $talentId
     * @param type $skillScoreId
     * @return \Talent\Skill\ApplicationService\Certificate\CertificateResponseObject
     */
    function showAll($talentId, $skillScoreId){
        $response = new CertificateResponseObject();
        $skillScore = $this->repository->ofId($skillScoreId, $talentId);
        if(empty($skillScore)){
            return $this->_buildSkillScoreNotFoundResponseMessage($response);
        }
        
        $certificateRDOs = $skillScore->allCertificateReadDataObject();
        if(empty($certificateRDOs)){
            return $this->_buildCertificateNotFoundResponseMessage($response);
        }
        foreach($certificateRDOs as $rdo){
            $response->setReadDataObject($rdo);
        }
        return $response;
    }
    
    protected function _buildSkillScoreNotFoundResponseMessage(\Resources\ResponseObject $response){
        $errorMessage = \Resources\ErrorMessage::error404_NotFound(['skill score not found or already removed']);
        $response->appendErrorMessage($errorMessage);
        return $response;
    }
    protected function _buildCertificateNotFoundResponseMessage(\Resources\ResponseObject $response){
        $errorMessage = \Resources\ErrorMessage::error404_NotFound(['certificate not found or already removed']);
        $response->appendErrorMessage($errorMessage);
        return $response;
    }
}
