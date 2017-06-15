<?php

namespace Talent\Skill\Infrastructure\Persistence\InMemory\Talent;

use Talent\Skill\DomainModel\Talent\Talent;
use Talent\Skill\DomainModel\Talent\ITalentRepository;
use Doctrine\Common\Collections\ArrayCollection;

class InMemoryTalentRepository implements ITalentRepository{
    protected $talents;
    
    public function __construct() {
        $this->talents = new ArrayCollection();
    }
    
    function add(Talent $talent){
        $this->talents->set($talent->getId(), $talent);
    }

    /**
     * @param type $id
     * @return Talent
     */
    public function ofId($id) {
        return $this->talents->get($id);
    }

    public function update() {
        
    }
}
