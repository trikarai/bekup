<?php

namespace Talent\Skill\ApplicationService\SkillScore;

use Resources\ResponseObject;
use Resources\ErrorMessage;
use Talent\Skill\DomainModel\SkillScore\Service\SkillScoreDataValidationService;
use Talent\Skill\DomainModel\Talent\Talent;
use Talent\Skill\DomainModel\Skill\DataObject\SkillReadDataObject;

class AddSkillScoreService {
    protected $repository;
    protected $skillRdoRepository;
    protected $dataValidationService;
    
    public function __construct(
            \Talent\Skill\DomainModel\Talent\ITalentRepository $talentRepository,
            \Talent\Skill\DomainModel\Skill\DataObject\ISkillRdoRepository $skillRdoRepository
    ) {
        $this->repository = $talentRepository;
        $this->skillRdoRepository = $skillRdoRepository;
        $this->dataValidationService = new SkillScoreDataValidationService();
    }
    
    /**
     * @param type $talentId
     * @param type $skillId
     * @param type $scoreValue
     * @return ResponseObject
     */
    function execute($talentId, $skillId, $scoreValue){
        $response = new ResponseObject();
        $talent = $this->_findTalentOrDie($talentId);
        $skillRDO = $this->skillRdoRepository->ofId($skillId);
        
        if(empty($skillRDO)){
            $response->appendErrorMessage(ErrorMessage::error404_NotFound(['skill not found']));
        }else if(true !== $msg = $this->dataValidationService->isValidToAdd($scoreValue)){
            $response->appendErrorMessage($msg);
        }else if(true !== $msg = $talent->addSkillScore($skillRDO, $scoreValue)){
            $response->appendErrorMessage($msg);
        }else{
            $this->repository->update();
        }
        return $response;
    }
    
    /**
     * @param type $talentId
     * @return Talent
     * @throws \Resources\Exception\DoNotCatchException
     */
    protected function _findTalentOrDie($talentId){
        $talent = $this->repository->ofId($talentId);
        if(empty($talent)){
            throw new \Resources\Exception\DoNotCatchException('talent not found');
        }
        return $talent;
    }
}
