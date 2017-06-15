<?php

namespace Talent\Training\Infrastructure\Persistence\InMemory\Talent;

use Talent\Training\DomainModel\Talent\ITalentRepository;
use Talent\Training\DomainModel\Talent\Talent;

use Doctrine\Common\Collections\ArrayCollection;

class InMemoryTalentRepository implements ITalentRepository{
    /**
     * @var ArrayCollection
     */
    protected $talents;
    
    public function __construct() {
        $this->talents = new ArrayCollection();
    }
    
    function add(Talent $talent){
        $this->talents->set($talent->getId(), $talent);
    }

    public function ofId($id) {
        return $this->talents->get($id);
    }

    public function update() {
        
    }

}
