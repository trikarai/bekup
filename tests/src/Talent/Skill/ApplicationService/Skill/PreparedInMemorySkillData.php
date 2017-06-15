<?php

namespace Tests\Talent\Skill\ApplicationService\Skill;

use Talent\Skill\DomainModel\Skill\Skill;
use Talent\Skill\Infrastructure\Persistence\InMemory\Skill\InMemorySkillRepository;
use Tests\Track\Definition\ApplicationService\Track\PreparedInMemoryTrackData;

class PreparedInMemorySkillData {
    protected $repository;
    protected $rdoRepository;
    protected $phpSkill;
    protected $leanSkill;
    protected $cssSkill;
    protected $trackData;
    
    /** @return Skill */
    function phpSkill(){
        return $this->phpSkill;
    }
    /** @return Skill */
    function leanSkill(){
        return $this->leanSkill;
    }
    /** @return Skill */
    function cssSkill(){
        return $this->cssSkill;
    }
    /** @return TestableSkillRepository */
    function repository(){
        return $this->repository;
    }
    /** @return TestableSkillRdoRepository */
    function rdoRepository(){
        return $this->rdoRepository;
    }
    /**
     * @return \Talent\Skill\ApplicationService\Skill\SkillFinder
     */
    function skillFinder(){
        return new \Talent\Skill\ApplicationService\Skill\SkillFinder($this->repository);
    }
    
    public function __construct() {
        $this->trackData = new PreparedInMemoryTrackData();
        $this->repository = new TestableSkillRepository();
        $this->_setPhpSkill();
        $this->_setLeanSkill();
        $this->_setCssSkill();
        $this->rdoRepository = new TestableSkillRdoRepository($this->repository);
    }
    protected function _setPhpSkill(){
        $id = \Ramsey\Uuid\Uuid::uuid4()->toString();
        $name = "php skill";
        $trackReadDataobject = $this->trackData->teknis()->toReadDataObject();
        $this->phpSkill = new Skill($id, $name, $trackReadDataobject);
        $this->repository->add($this->phpSkill);
    }
    protected function _setLeanSkill(){
        $id = \Ramsey\Uuid\Uuid::uuid4()->toString();
        $name = "lean skill";
        $trackReadDataobject = $this->trackData->bisnis()->toReadDataObject();
        $this->leanSkill = new Skill($id, $name, $trackReadDataobject);
        $this->repository->add($this->leanSkill);
    }
    protected function _setCssSkill(){
        $id = \Ramsey\Uuid\Uuid::uuid4()->toString();
        $name = "css skill";
        $trackReadDataobject = $this->trackData->teknis()->toReadDataObject();
        $this->cssSkill = new Skill($id, $name, $trackReadDataobject);
        $this->repository->add($this->cssSkill);
    }
}

use Doctrine\Common\Collections\Criteria;
class TestableSkillRepository extends InMemorySkillRepository{
    function getSkillCount(){
        $criteria = Criteria::create()
                ->where(Criteria::expr()->eq('isRemoved', false));
        return $this->skills->matching($criteria)->count();
    }
    function ofId($id) {
        return parent::ofId($id);
    }
    /**
     * @return Skill
     */
    function lastAddedSkill(){
        return $this->skills->last();
    }
}

use Talent\Skill\DomainModel\Skill\DataObject\ISkillRdoRepository;
class TestableSkillRdoRepository implements ISkillRdoRepository{
    protected $skillRepository;
    public function __construct(\Talent\Skill\DomainModel\Skill\ISkillRepository $skillRepository) {
        $this->skillRepository = $skillRepository;
    }
    public function all() {
        $skills = $this->skillRepository->all();
        $skillRdos = [];
        foreach($skills as $skill){
            $skillRdos[] = $skill->toReadDataObject();
        }
        return $skillRdos;
    }

    public function ofId($id) {
        $skill = $this->skillRepository->ofId($id);
        if(empty($skill)){
            return null;
        }
        return $skill->toReadDataObject();
    }

}
