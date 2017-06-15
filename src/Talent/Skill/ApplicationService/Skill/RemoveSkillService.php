<?php

namespace Talent\Skill\ApplicationService\Skill;

use Resources\ResponseObject;
use Resources\ErrorMessage;
use Talent\Skill\DomainModel\Skill\Service\SkillAuthorizationService;

class RemoveSkillService {
    protected $repository;
    protected $personnelRdoRepository;
    protected $authorizationService;
    
    /**
     * @param \Talent\Skill\DomainModel\Skill\ISkillRepository $skillRepository
     * @param \Personnel\ApplicationService\Personnel\PersonnelFinder $personnelFinder
     */
    public function __construct(
            \Talent\Skill\DomainModel\Skill\ISkillRepository $skillRepository,
            \Personnel\DomainModel\Personnel\DataObject\IPersonnelRdoRepository $personnelRdoRepository
    ) {
        $this->repository = $skillRepository;
        $this->personnelRdoRepository = $personnelRdoRepository;
        $this->authorizationService = new SkillAuthorizationService();
    }
    
    /**
     * @param type $personnelId
     * @param type $skillId
     * @return MessageObject
     */
    function execute($personnelId, $skillId){
        $response  = new ResponseObject();
        $personnelRDO = $this->_findPersonnelRDOOrDie($personnelId);
        $skill = $this->_findSkill($skillId);
        
        if(true !== $msg = $this->authorizationService->isAuthorizedToRemove($personnelRDO)){
            $response->appendErrorMessage($msg);
        }else if(empty($skill)){
            $response->appendErrorMessage(ErrorMessage::error404_NotFound(['skill not found']));
        }else{
            $skill->remove();
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
