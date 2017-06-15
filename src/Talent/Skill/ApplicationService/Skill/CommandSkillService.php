<?php

namespace Talent\Skill\ApplicationService\Skill;

use Resources\ResponseObject;
use Resources\ErrorMessage;
use Talent\Skill\DomainModel\Skill\Service\SkillDataValidationService;
use Talent\Skill\DomainModel\Skill\Service\SkillAuthorizationService;
use Talent\Skill\DomainModel\Skill\Service\PreventDuplicateSkillService;
use Talent\Skill\DomainModel\Skill\Skill;

use Personnel\DomainModel\Personnel\DataObject\PersonnelReadDataObject;

class CommandSkillService {
    protected $repository;
    protected $trackRdoRepository;
    protected $personnelRdoRepository;
    protected $authorizationService;
    protected $validationService;
    protected $preventDuplicateService;

    public function __construct(
            \Talent\Skill\DomainModel\Skill\ISkillRepository $skillRepository, 
            \Personnel\DomainModel\Personnel\DataObject\IPersonnelRdoRepository $personnelRdoRepository,
            \Superclass\DomainModel\Track\ITrackRdoRepository $trackRdoRepository
    ) {
        $this->repository = $skillRepository;
        $this->personnelRdoRepository = $personnelRdoRepository;
        $this->trackRdoRepository = $trackRdoRepository;
        $this->authorizationService = new SkillAuthorizationService();
        $this->validationService = new SkillDataValidationService();
        $this->preventDuplicateService = new PreventDuplicateSkillService($skillRepository);
    }

    /**
     * @param type $personnelId
     * @param type $name
     * @param type $trackId
     * @return ResponseObject
     */
    function add($personnelId, $name, $trackId){
        $response = new ResponseObject();
        $personnelRDO = $this->_findPersonnelRDOOrDie($personnelId);
        $trackRDO = $this->trackRdoRepository->ofId($trackId);

        if(empty($trackRDO)){
            $response->appendErrorMessage(ErrorMessage::error404_NotFound(['track not found']));
        }else if(true !== $msg = $this->authorizationService->isAuthorizedToAdd($personnelRDO)){
            $response->appendErrorMessage($msg);
        }else if(true !== $msg = $this->validationService->isValidToAdd($name)){
            $response->appendErrorMessage($msg);
        }else if(true !== $msg = $this->preventDuplicateService->isNotDuplicateName($name)){
            $response->appendErrorMessage($msg);
        }else{
            $skill = new Skill($this->repository->nextIdentity(), $name, $trackRDO);
            $this->repository->add($skill);
        }
        return $response;
    }

    /**
     * @param type $personnelId
     * @param type $skillId
     * @param type $name
     * @param type $trackId
     * @return ResponseObject
     */
    function update($personnelId, $skillId, $name, $trackId){
        $response = new ResponseObject();
        $personnelRDO = $this->_findPersonnelRDOOrDie($personnelId);
        $trackRDO = $this->trackRdoRepository->ofId($trackId);
        $skill = $this->_findSkill($skillId);
        
        if(empty($skill)){
            $response->appendErrorMessage(ErrorMessage::error404_NotFound(['skill not found']));
        }else if(empty($trackRDO)){
            $response->appendErrorMessage(ErrorMessage::error404_NotFound(['track not found']));
        }else if(true !== $msg = $this->authorizationService->isAuthorizedToUpdate($personnelRDO)){
            $response->appendErrorMessage($msg);
        }else if(true !== $msg = $this->validationService->isValidToUpdate($name)){
            $response->appendErrorMessage($msg);
        }else if($name !== $skill->getName() &&
                true !== $msg = $this->preventDuplicateService->isNotDuplicateName($name)
        ){
            $response->appendErrorMessage($msg);
        }
        else{
            $skill->change($name, $trackRDO);
            $this->repository->update();
        }
        return $response;
    }
    
    /**
     * @param type $personnelId
     * @return PersonnelReadDataObject
     * @throws \Resources\Exception\DoNotCatchException
     */
    protected function _findPersonnelRDOOrDie($personnelId){
        $personnelRDO = $this->personnelRdoRepository->ofId($personnelId);
        if(empty($personnelRDO)){
            throw new \Resources\Exception\DoNotCatchException('personnel not found');
        }
        return $personnelRDO;
    }
    /**
     * @param type $skillId
     * @return Skill
     */
    protected function _findSkill($skillId){
        $skill = $this->repository->ofId($skillId);
        if(empty($skill)){
            return null;
        }
        return $skill;
    }
}
