<?php

namespace Tests\Team\Idea\ApplicationService\Idea;

use Team\Profile\DomainModel\Membership\Membership;
use Tests\Team\Profile\ApplicationService\Talent\TestableTalent;
use Superclass\DomainModel\City\CityReadDataObject;
use Team\Idea\DomainModel\Idea\Idea;

use Team\Idea\DomainModel\Team\Team;
use Doctrine\Common\Collections\Criteria;

class TestableTeam extends Team{
    function addInvitedMemberManually(TestableTalent $invitedTalent, $position, $isAdmin = false){
        $id = $this->teamMemberRdos->count() + 1;
        $newMember = Membership::asInvited($id, $position, $invitedTalent, $this, $isAdmin);
        $memberRdo = $newMember->toTeamMemberReadDataObject();
        $this->teamMemberRdos->set($memberRdo->getId(), $memberRdo);
$invitedTalent->appendMembership($newMember);
    }
    function addActiveMemberManually(TestableTalent $activeTalent, $position, $isAdmin = false){
        $id = $this->teamMemberRdos->count() + 1;
        $newMember = Membership::asInvited($id, $position, $activeTalent, $this, $isAdmin);
        $newMember->changeStatus('active');
        $memberRdo = $newMember->toTeamMemberReadDataObject();
        $this->teamMemberRdos->set($id, $memberRdo);
$activeTalent->appendMembership($newMember);
    }
    /**
     * @return Idea
     */
    function lastAddedIdea(){
        return $this->ideas->last();
    }
    function getCountOfIdea(){
        $criteria = Criteria::create()
                ->where(Criteria::expr()->eq('isRemoved', false));
        return $this->ideas->matching($criteria)->count();
    }
    
    public function __construct(CityReadDataObject $cityRdo) {
        $this->cityRDO = $cityRdo;
        parent::__construct();
    }
}