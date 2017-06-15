<?php

namespace Tests\Team\Idea\ApplicationService\Idea;

use Team\Idea\Infrastructure\Persistence\InMemory\Team\InMemoryTeamRepository;
use Doctrine\Common\Collections\ArrayCollection;

class TestableInMemoryTeamRepository extends InMemoryTeamRepository{
    protected $teams;
    public $markTalentInactive = false;
    
    public function __construct() {
        $this->teams = new ArrayCollection();
    }
    
    function addTeamManually(\Superclass\DomainModel\Team\TeamAbstract $team) {
        $this->teams->set($team->getId(), $team);
    }
    /**
     * @param type $talentId
     * @return TestableTeam
     */
    function ofTalentId($talentId) {
        if(!$this->markTalentInactive)
            return $this->teams->last();
        return null;
    }
}
