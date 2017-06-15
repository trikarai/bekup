<?php

namespace Tests\Team\Profile\ApplicationService\Team;
use Doctrine\Common\Collections\ArrayCollection;
use Team\Profile\DomainModel\Team\Team;
use Team\Profile\DomainModel\Team\DataObject\TeamWriteDataObject;
use Tests\Team\Profile\ApplicationService\Talent\PreparedInMemoryTalentData;
use Tests\Team\Profile\ApplicationService\Talent\TestableTalent;
use Tests\Team\Profile\ApplicationService\Talent\TestableTalentRepository;

class PreparedInMemoryTeamData {
    protected $repository;
    protected $talentRepository;
    protected $teamBara;
    protected $teamPraja;
    protected $creatorTalent;
    protected $activeTalent;
    protected $activeNonAdminTalent;
    protected $invitedTalent;
    protected $availableTalent;
    protected $prajaCreator;
    
    /** @return TestableInMemoryTeamRepository */
    function getRepository() {
        return $this->repository;
    }
    /** @return TestableTalentRepository */
    function getTalentRepository() {
        return $this->talentRepository;
    }
    /** @return TestableTeam */
    function getTeamBara() {
        return $this->teamBara;
    }
    /** @return TestableTeam */
    function getTeamPraja() {
        return $this->teamPraja;
    }
    /** @return TestableTalent */
    function getCreatorTalent() {
        return $this->creatorTalent;
    }
    /** @return TestableTalent */
    function getActiveTalent() {
        return $this->activeTalent;
    }
    /** @return TestableTalent */
    function getActiveNonAdminTalent() {
        return $this->activeNonAdminTalent;
    }
    /** @return TestableTalent */
    function getInvitedTalent() {
        return $this->invitedTalent;
    }
    /** @return TestableTalent */
    function getAvailableTalent() {
        return $this->availableTalent;
    }
    function getPrajaCreator(){
        return $this->prajaCreator;
    }
        
    public function __construct() {
        $this->repository = new TestableInMemoryTeamRepository(); 
        $talentData = new PreparedInMemoryTalentData();
        $this->talentRepository = $talentData->getRepository();
        $this->creatorTalent = $talentData->getApur();
        $this->invitedTalent = $talentData->getTri();
        $this->activeTalent = $talentData->getIgun();
        $this->activeNonAdminTalent = $talentData->getAdi();
        $this->availableTalent = $talentData->getArief();
        $this->prajaCreator = $talentData->getInandar();
        
        $this->_setTeamBara();
        $this->_setTeamPraja();
        $this->_setActive();
        $this->_setActiveNonAdmin();
        $this->_setInvited();
    }
    protected function _setTeamBara(){
        $teamId = $this->repository->nextIdentity();
        $request = TeamWriteDataObject::request('bara', 'bara vision', 'bara mission', 'bara culture', 'bara founder agreement');
        $position = 'csd';
        $this->teamBara = $this->creatorTalent->createTeamManually($teamId, $request, $position);
        $this->repository->add($this->teamBara);
    }
    protected function _setTeamPraja(){
        $teamId = $this->repository->nextIdentity();
        $request = TeamWriteDataObject::request('praja', 'praja vision', 'praja mission', 'praja culture', 'praja founder agreement');
        $position = 'asdjflas';
        $this->teamPraja = $this->prajaCreator->createTeamManually($teamId, $request, $position);
        $this->repository->add($this->teamPraja);
    }
    protected function _setInvited(){
        $this->teamBara->inviteNewMemberManually(1, $this->invitedTalent, 'sdfa', false);
    }
    protected function _setActive(){
        $this->teamBara->addActiveMemberManually(1, $this->activeTalent, 'cas', true);
    }
    protected function _setActiveNonAdmin(){
        $this->teamBara->addActiveMemberManually(1, $this->activeNonAdminTalent, 'cas', false);
    }
}

use Team\Profile\Infrastructure\Persistence\InMemory\Team\InMemoryTeamRepository;
class TestableInMemoryTeamRepository extends InMemoryTeamRepository{
    function _getTeamCount(){
        return $this->teams->count();
    }
    /**
     * @return Team
     */
    function _lastAddedTeam(){
        return $this->teams->last();
    }
}
