<?php

namespace Tests\Team\Idea\DomainModel\Team;

use Team\Idea\DomainModel\Team\Team;
use Superclass\DomainModel\Team\TeamMemberReadDataObject;
use Team\Idea\DomainModel\Idea\Idea;
use Doctrine\Common\Collections\Criteria;

class TestableTeam extends Team{
    public function __construct() {
        parent::__construct();
    }
    
    function addMembership(TeamMemberReadDataObject $membershipRDO){
        $this->teamMemberRdos->set($membershipRDO->getId(), $membershipRDO);
    }
    function addIdeaManually(Idea $idea){
        $this->ideas->set($idea->getId(), $idea);
    }
    
    /**
     * @return Idea
     */
    function lastIdea(){
        return $this->ideas->last();
    }
    
    function getCountOfIdea(){
        $criteria = Criteria::create()
                ->where(Criteria::expr()->eq('isRemoved', false));
        return $this->ideas->matching($criteria)->count();
    }
    function toReadDataObject() {
        return new TestableTeamReadDataObject();
    }
}

use Superclass\DomainModel\Team\TeamReadDataObject;
class TestableTeamReadDataObject extends TeamReadDataObject{
    public function __construct() {
        ;
    }
}
