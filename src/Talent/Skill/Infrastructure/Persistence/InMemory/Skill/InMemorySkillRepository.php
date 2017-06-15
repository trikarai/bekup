<?php

namespace Talent\Skill\Infrastructure\Persistence\InMemory\Skill;

use Talent\Skill\DomainModel\Skill\ISkillRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;

class InMemorySkillRepository implements ISkillRepository{
    /**
     * @var ArrayCollection
     */
    protected $skills;
    
    public function __construct() {
        $this->skills = new ArrayCollection();
    }

    public function add(\Talent\Skill\DomainModel\Skill\Skill $skill) {
        $this->skills->set($skill->getId(), $skill);
    }

    public function all() {
        $criteria = Criteria::create()
                ->where(Criteria::expr()->eq('isRemoved', false));
        return $this->skills->matching($criteria)->toArray();
    }

    public function nextIdentity() {
        return \Ramsey\Uuid\Uuid::uuid4()->toString();
    }

    public function ofId($id) {
        $criteria = Criteria::create()
                ->where(Criteria::expr()->andX(
                        Criteria::expr()->eq('id', $id),
                        Criteria::expr()->eq('isRemoved', false)
                ));
        return $this->skills->matching($criteria)->first();
    }

    public function ofName($name) {
        $criteria = Criteria::create()
                ->where(Criteria::expr()->andX(
                        Criteria::expr()->eq('isRemoved', false),
                        Criteria::expr()->eq('name', $name)
                ));
        $skill = $this->skills->matching($criteria)->first();
        if(empty($skill)){
            return null;
        }
        return $skill;
    }

    public function update() {
        
    }

}
