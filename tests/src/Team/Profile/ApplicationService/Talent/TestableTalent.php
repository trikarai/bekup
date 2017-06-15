<?php

namespace Tests\Team\Profile\ApplicationService\Talent;

use Team\Profile\DomainModel\Talent\Talent;
use Team\Profile\DomainModel\Team\DataObject\TeamWriteDataObject;
use Team\Profile\DomainModel\Membership\Membership;
use Tests\Team\Profile\ApplicationService\Team\TestableTeam;
use Superclass\DomainModel\City\CityReadDataObject;

class TestableTalent extends Talent{
    function appendMembership(Membership $membership){
        $this->teamMemberships->add($membership);
    }
    function createTeamManually($teamId, TeamWriteDataObject $request, $position){
        if(true !== $msg = $this->_checkHasNoActiveTeamMember()){
            return $msg;
        }
        $team = new TestableTeam($teamId, $request, $this->cityRDO);
        $membership = Membership::asCreator($position, $this, $team);
        $this->teamMemberships->add($membership);
$team->appendMembership($membership);
return $team;
//        return true;
    }

/*
    public $failWhenCreateTeam = false;
    public $failWhenAcceptInvitation = false;
    public $failWhenRejectInvitation = false;
    public $failWhenResign = false;
    
    public $nullWhenQueryMembershipRDO = false;
    public $nullWhenQueryActiveMembershipRDO = false;
    public $emptyWhenQueryInvitedMembershipRDO = false;
 * 
 */
    

    public function __construct(CityReadDataObject $cityRdo) {
        $this->id = \Ramsey\Uuid\Uuid::uuid4()->toString();
        $this->cityRDO = $cityRdo;
        $this->birthDate = new \DateTime('1980-08-09');
        $request = \Track\Definition\DomainModel\Track\DataObject\TrackWriteDataObject::request('track name', 'track definition');
        $track = new \Track\Definition\DomainModel\Track\Track(\Ramsey\Uuid\Uuid::uuid4()->toString(), $request);
        $this->trackRDO = $track->toReadDataObject();
        parent::__construct();
    }
    
    /*
    function cityRdo() {
        return new \City\Profile\DomainModel\City\City(\Ramsey\Uuid\Uuid::uuid4()->toString(), 'bandung');
    }
    
    public function createTeam($teamId, TeamWriteDataObject $request, $position) {
        if($this->failWhenCreateTeam){
            return \Resources\ErrorMessage::error500_InternalServerError(['Some Error Within Talent Proccessing Object']);
        }
        return true;
    }
    function acceptTeamInvitation($teamId, $membershipId) {
        if($this->failWhenAcceptInvitation){
            return \Resources\ErrorMessage::error500_InternalServerError(['Fail executing ACCEPT INVITATION in talent object']);
        }
        return true;
    }
    function rejectTeamInvitation($teamId, $membershipId) {
        if($this->failWhenRejectInvitation){
            return \Resources\ErrorMessage::error500_InternalServerError(['Fail executing REJECT INVITATION in talent object']);
        }
        return true;
    }
    function resign() {
        if($this->failWhenResign){
            return \Resources\ErrorMessage::error500_InternalServerError(['Fail executing RESIGN in talent object']);
        }
        return true;
    }
    
    function aMembershipRDO_ofTeamIdAndMembershipId($teamId, $membershipId) {
        if($this->nullWhenQueryMembershipRDO){
            return null;
        }
        return (new TestableMembership())->toTalentMembershipReadDataObject();
    }
    function anActiveMembershipRDO() {
        if($this->nullWhenQueryActiveMembershipRDO){
            return null;
        }
        return (new TestableMembership())->toTalentMembershipReadDataObject();
    }
    function allInvitedMembershipRDO() {
        if($this->emptyWhenQueryInvitedMembershipRDO){
            return [];
        }
        return array(
            (new TestableMembership())->toTalentMembershipReadDataObject(),
            (new TestableMembership())->toTalentMembershipReadDataObject(),
        );
    }
    function toReadDataObject() {
        return new TestableTalentReadDataObject();
    }
     * 
     */
}
/*
use Superclass\DomainModel\Talent\TalentReadDataObject;
class TestableTalentReadDataObject extends TalentReadDataObject{
    public function __construct() {
        ;
    }
}
 * 
 */