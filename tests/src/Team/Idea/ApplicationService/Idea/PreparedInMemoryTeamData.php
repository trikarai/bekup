<?php

namespace Tests\Team\Idea\ApplicationService\Idea;

use Tests\Team\Profile\ApplicationService\Talent\PreparedInMemoryTalentData as membershipData;
use Tests\Team\Profile\ApplicationService\Talent\TestableTalent;
use Tests\Team\Idea\ApplicationService\Superhero\PreparedInMemoryTalentData as superheroData;
use Team\Idea\DomainModel\Idea\DataObject\IdeaWriteDataObject;
use Team\Idea\DomainModel\Idea\Idea;

class PreparedInMemoryTeamData {
    protected $memberData;
    protected $superheroData;
    protected $teamRepository;
    protected $teamBara;
    protected $activeMember;
    protected $invitedMember;
    protected $uninvolvedMember;
    protected $kabIdea;
    protected $formaticIdea;
    
    /** @return TestableTeamRepository */
    function getTeamRepository() {
        return $this->teamRepository;
    }
    function getActiveMembershipFinder(){
        return $this->memberData->getActiveMembershipFinder();
    }
    function getTalentRepository() {
        return $this->superheroData->repository();
    }
    /** @return TestableTeam */
    function getTeamBara() {
        return $this->teamBara;
    }
    /** @return TestableTalent */
    function getActiveMember() {
        return $this->activeMember;
    }
    /** @return TestableTalent */
    function getInvitedMember() {
        return $this->invitedMember;
    }
    /** @return TestableTalent */
    function getUninvolvedMember() {
        return $this->uninvolvedMember;
    }
    function getSuperheroGoku(){
        return $this->superheroData->goku();
    }
    /** @return Idea */
    function getKabIdea() {
        return $this->kabIdea;
    }
    /** @return Idea */
    function getFormaticIdea() {
        return $this->formaticIdea;
    }

        
    public function __construct() {
        $this->memberData = new membershipData();
        $this->activeMember = $this->memberData->getApur();
        $this->invitedMember = $this->memberData->getIgun();
        $this->uninvolvedMember = $this->memberData->getTri();
        $this->teamRepository = new TestableTeamRepository();
        $this->teamBara = new TestableTeam($this->activeMember->cityRdo());
        $this->teamRepository->add($this->teamBara);
        $this->superheroData = new superheroData($this->activeMember->getId());
        
        $this->_setMember();
        $this->_setIdea();
    }
    protected function _setTeam(){
    }
    protected function _setMember(){
        $this->teamBara->addActiveMemberManually($this->activeMember, 'ceo', true);
        $this->teamBara->addInvitedMemberManually($this->invitedMember, 'cro', false);
    }
    protected function _setIdea(){
        $request = IdeaWriteDataObject::request('kab', 'kab locale', 'kab global', 'kab applied tech', 'kab ideal final result', 'kab value contradiction', 'kab used resource');
        $superheroRDO = $this->superheroData->goku()->toReadDataObject();
        $this->teamBara->proposeIdea(1, $request, $superheroRDO);
        $this->kabIdea = $this->teamBara->lastAddedIdea();
        $request = IdeaWriteDataObject::request('formatic', 'formatic locale', 'formatic global', 'formatic applied tech', 'formatic ideal final result', 'formatic value contradiction', 'formatic used resource');
        $this->teamBara->proposeIdea(1, $request);
        $this->formaticIdea = $this->teamBara->lastAddedIdea();
    }
}

use Team\Idea\Infrastructure\Persistence\InMemory\Team\InMemoryTeamRepository;

class TestableTeamRepository extends InMemoryTeamRepository{
     
}
