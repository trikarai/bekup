<?php

namespace Team\Profile\Infrastructure\Persistence\InMemory\Talent;

use Team\Profile\DomainModel\Talent\ITalentRepository;
use Team\Profile\DomainModel\Talent\Talent;
use Team\Profile\DomainModel\Team\Team;

class InMemoryTalentRepository implements ITalentRepository{
    protected $talents;
    
    public function __construct() {
        $this->talents = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    function add(Talent $talent){
        $this->talents->set($talent->getId(), $talent);
    }
    
    
    public function ofId($id) {
        return $this->talents->get($id);
    }

    public function update() {
        
    }

    public function availableTalentToInvite(\Superclass\DomainModel\Team\TeamReadDataObject $teamRdo, $offset, $limit) {
        
    }

}
