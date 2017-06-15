<?php

namespace Team\Idea\Infrastructure\Persistence\InMemory\Talent;

use Team\Idea\DomainModel\Talent\ITalentRepository;
use Team\Idea\DomainModel\Talent\Talent;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;

class InMemoryTalentRepository implements ITalentRepository{
    /**
     * @var ArrayCollection
     */
    protected $talents;
    
    public function __construct() {
        $this->talents = new ArrayCollection();
    }

    public function ofId($id) {
        return $this->talents->get($id);
    }

    public function update() {
        
    }
    
    function add(Talent $talent){
        $this->talents->set($talent->getId(), $talent);
    }

}
