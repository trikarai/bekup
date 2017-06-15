<?php

namespace Tests\Team\Profile\ApplicationService\Team;

use Team\Profile\DomainModel\Team\Team;
use Team\Profile\DomainModel\Talent\Talent;
use Tests\Team\Profile\ApplicationService\Talent\TestableTalent;
use Tests\Team\Profile\ApplicationService\Talent\TestableMembership;
use Team\Profile\DomainModel\Membership\Membership;

class TestableTeam extends Team{
    function appendMembership(Membership $membership){
        $this->members->set($membership->getId(), $membership);
    }
    function inviteNewMemberManually($commanderId, TestableTalent $invitedTalent, $position, $isAdmin = false){
        $msg = true;
        if(true !== $msg = $this->_checkCommanderIsAdmin($commanderId)){
        }else if(true !== $msg = $this->_checkInvitedTalentNotAlreadyInActiveOrInvitedList($invitedTalent)){
        }else{
            $id = $this->members->count() + 1;
            $newMember = Membership::asInvited($id, $position, $invitedTalent, $this, $isAdmin);
            $this->members->set($id, $newMember);
$invitedTalent->appendMembership($newMember);
        }
        return $msg;
    }
    function addActiveMemberManually($commanderId, TestableTalent $activeTalent, $position, $isAdmin = false){
        $msg = true;
        if(true !== $msg = $this->_checkCommanderIsAdmin($commanderId)){
        }else if(true !== $msg = $this->_checkInvitedTalentNotAlreadyInActiveOrInvitedList($activeTalent)){
        }else{
            $id = $this->members->count() + 1;
            $newMember = Membership::asInvited($id, $position, $activeTalent, $this, $isAdmin);
            $newMember->changeStatus('active');
            $this->members->set($id, $newMember);
$activeTalent->appendMembership($newMember);
        }
        return $msg;
    }
    /*
    public $failToChangeProfile = false;
    public $failToInviteMember = false;
    public $failToCancelInvitation = false;
    public $failToRemoveMember = false;
    
    public $nullMembershipRDO = false;
    public $emptyActiveMembershipRDO = false;
    public $emptyInvitedMembershipRDO = false;
     * 
     */
    
    public function __construct($id, \Team\Profile\DomainModel\Team\DataObject\TeamWriteDataObject $request, \Superclass\DomainModel\City\CityReadDataObject $cityRDO) {
        parent::__construct($id, $request, $cityRDO);
    }
    /*
    function CityRDO() {
        return (new \City\Profile\DomainModel\City\City(\Ramsey\Uuid\Uuid::uuid4()->toString(), 'bandung'))->toReadDataObject();
    }
    
    function changeProfile($commanderId, \Team\Profile\DomainModel\Team\DataObject\TeamWriteDataObject $request) {
        if($this->failToChangeProfile){
            return \Resources\ErrorMessage::error500_InternalServerError(['Fail When Executing change profile in Team']);
        }
        return true;
    }
    function inviteNewMember($commanderId, Talent $invitedTalent, $position, $isAdmin = false) {
        if($this->failToInviteMember){
            return \Resources\ErrorMessage::error500_InternalServerError(['fail when executing INVITE NEW MEMBER in team object']);
        }
        return true;
    }
    function cancelInvitation($commanderId, $memberIdToCancel) {
        if($this->failToCancelInvitation){
            return \Resources\ErrorMessage::error500_InternalServerError(['fail when executing CANCEL INVITATION in team object']);
        }
        return true;
    }
    function removeMember($commanderId, $memberIdToRemove) {
        if($this->failToRemoveMember){
            return \Resources\ErrorMessage::error500_InternalServerError(['fail when executing REMOVE MEMBER in team object']);
        }
        return true;
    }
    function aMembershipRDO_ofMemberId($memberId) {
        if($this->nullMembershipRDO){
            return null;
        }
        return (new TestableMembership())->toTeamMemberReadDataObject();
    }
    function allActiveMembershipRDO() {
        if($this->emptyActiveMembershipRDO){
            return [];
        }
        return array(
            (new TestableMembership())->toTeamMemberReadDataObject(),
            (new TestableMembership())->toTeamMemberReadDataObject(),
        );
    }
    function allInvitedMembershipRDO() {
        if($this->emptyInvitedMembershipRDO){
            return [];
        }
        return array(
            (new TestableMembership())->toTeamMemberReadDataObject(),
            (new TestableMembership())->toTeamMemberReadDataObject(),
        );
    }
     * 
     */
}