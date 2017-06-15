<?php

namespace Talent\Skill\ApplicationService\Skill;

use Resources\ErrorMessage;

class QuerySkillService {
    protected $repository;
    
    /**
     * @param \Talent\Skill\DomainModel\Skill\ISkillRepository $skillRepository
     */
    public function __construct(\Talent\Skill\DomainModel\Skill\DataObject\ISkillRdoRepository $skillRdoRepository) {
        $this->repository = $skillRdoRepository;
    }
    
    /**
     * @param type $skillId
     * @return \Talent\Skill\ApplicationService\Skill\SkillQueryResponseObject
     */
    function showById($skillId){
        $response = new SkillQueryResponseObject();
        $skillRdo = $this->repository->ofId($skillId);
        if(empty($skillRdo)){
            $response->appendErrorMessage(ErrorMessage::error404_NotFound(['skill not found']));
        }else{
            $response->setReadDataObject($skillRdo);
        }
        return $response;
    }
    
    /**
     * @return \Talent\Skill\ApplicationService\Skill\SkillQueryResponseObject
     */
    function showAll(){
        $response = new SkillQueryResponseObject();
        $skillRdos = $this->repository->all();
        
        if(empty($skillRdos)){
            $response->appendErrorMessage(ErrorMessage::error404_NotFound(['no skill data found']));
        }else{
            $response->setBulkReadDataObject($skillRdos);
        }
        return $response;
    }
    
}
