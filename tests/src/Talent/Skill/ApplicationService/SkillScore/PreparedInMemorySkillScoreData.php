<?php

namespace Tests\Talent\Skill\ApplicationService\SkillScore;

use Tests\Talent\Skill\DomainModel\Talent\TestableTalent;
use Talent\Skill\DomainModel\SkillScore\SkillScore;
use Tests\Talent\Skill\ApplicationService\Skill\PreparedInMemorySkillData;
use Talent\Skill\Infrastructure\Persistence\InMemory\Talent\InMemoryTalentRepository;

class PreparedInMemorySkillScoreData {
    protected $repository;
    protected $talent;
    protected $phpSkillScore;
    protected $leanSkillScore;
    protected $skillData;
    
    /** @return InMemoryTalentRepository */
    function repository(){
        return $this->repository;
    }
    /** @return TestableTalent */
    function talent(){
        return $this->talent;
    }
    /** @return SkillScore */
    function phpSkillScore(){
        return $this->phpSkillScore;
    }
    /** @return SkillScore */
    function leanSkillScore(){
        return $this->leanSkillScore;
    }
    /** @return PreparedInMemorySkillData */
    function skillData(){
        return $this->skillData;
    }
    
    public function __construct() {
        $this->skillData = new PreparedInMemorySkillData();
        $this->repository = new InMemoryTalentRepository();
        $this->talent = new TestableTalent();
        $this->repository->add($this->talent);
        $this->_setPhpSkillScore();
        $this->_setLeanSkillScore();
    }
    protected function _setPhpSkillScore(){
        $this->talent->addSkillScore($this->skillData->phpSkill()->toReadDataObject(), 4);
        $this->phpSkillScore = $this->talent->lastAddedSkillScore();
    }
    protected function _setLeanSkillScore(){
        $this->talent->addSkillScore($this->skillData->leanSkill()->toReadDataObject(), 4);
        $this->leanSkillScore = $this->talent->lastAddedSkillScore();
    }
}
