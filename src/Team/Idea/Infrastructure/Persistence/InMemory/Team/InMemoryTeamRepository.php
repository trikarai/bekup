<?php

namespace Team\Idea\Infrastructure\Persistence\InMemory\Team;

use Team\Idea\DomainModel\Team\ITeamRepository;
use Team\Idea\DomainModel\Team\Team;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;

class InMemoryTeamRepository implements ITeamRepository{
    /**
     * @var ArrayCollection
     */
    protected $teams;
    
    public function __construct() {
        $this->teams = new ArrayCollection();
    }
    function add(Team $team){
        $this->teams->set($team->getId(), $team);
    }

    public function update() {
        
    }

    public function ofId($teamId) {
        return $this->teams->get($teamId);
    }

}
