<?php

namespace Tests\Team\Profile\DomainModel\Team;

use Team\Profile\DomainModel\Team\Team;
use Team\Profile\DomainModel\Team\DataObject\TeamWriteDataObject;
use Team\Profile\DomainModel\Talent\Talent;
use Team\Profile\DomainModel\Membership\Membership;
use City\Profile\DomainModel\City\City;
use Superclass\DomainModel\City\CityReadDataObject;
use Track\Definition\DomainModel\Track\Track;
use Track\Definition\DomainModel\Track\DataObject\TrackWriteDataObject;
use Superclass\DomainModel\Track\TrackReadDataObject;

class TeamTest extends \PHPUnit_Framework_TestCase {

    protected $team;

    /** @var Membership */
    protected $creatorMembership;

    /** @var Membership */
    protected $adminActiveMembership;
    protected $activeTalent;

    /** @var Membership */
    protected $normalActiveMembership;
    protected $invitedTalent;

    /** @var Membership */
    protected $invitedMembership;
    protected $cityRDO;
    protected $trackRDO;
    
    protected $talentOfDiffCity;
    
    protected function setUp() {
        $request = TeamWriteDataObject::request('bara', 'bara vision', 'bara mission', 'bara culture', 'bara agreement');
        $this->cityRDO = (new City(\Ramsey\Uuid\Uuid::uuid4()->toString(), 'bandung'))->toReadDataObject();
        $this->trackRDO = (new Track(\Ramsey\Uuid\Uuid::uuid4()->toString(), TrackWriteDataObject::request('bisnis', 'bisnis desc')))->toReadDataObject();

        $this->team = new TestableTeam(\Ramsey\Uuid\Uuid::uuid4()->toString(), $request, $this->cityRDO);
        $this->_setCreatorMembership();
        $this->_setAdminActiveMembership();
        $this->_setNormalActiveMembership();
        $this->_setInvitedMembership();
        $otherCity = (new City(\Ramsey\Uuid\Uuid::uuid4()->toString(), 'bandung'))->toReadDataObject();
        $this->talentOfDiffCity = new TestableTalent("talent of diff city", $otherCity, $this->trackRDO);
    }

    protected function _setCreatorMembership() {
        $talent = new TestableTalent("creator", $this->cityRDO, $this->trackRDO);
        $this->creatorMembership = TestableMembership::asCreator('CEO', $talent, $this->team);
        $this->team->addMembershipManually($this->creatorMembership);
    }

    protected function _setAdminActiveMembership() {
        $talent = new TestableTalent("admin member", $this->cityRDO, $this->trackRDO);
        $this->adminActiveMembership = TestableMembership::asInvited(2, "CTO", $talent, $this->team, true);
        $this->adminActiveMembership->changeStatus('active');
        $this->team->addMembershipManually($this->adminActiveMembership);
    }

    protected function _setNormalActiveMembership() {
        $this->activeTalent = new TestableTalent("normal member", $this->cityRDO, $this->trackRDO);
        $this->normalActiveMembership = TestableMembership::asInvited(3, "programmer", $this->activeTalent, $this->team);
        $this->normalActiveMembership->changeStatus('active');
        $this->team->addMembershipManually($this->normalActiveMembership);
    }

    protected function _setInvitedMembership() {
        $this->invitedTalent = new TestableTalent("invited member", $this->cityRDO, $this->trackRDO);
        $this->invitedMembership = TestableMembership::asInvited(4, "marketing", $this->invitedTalent, $this->team);
        $this->team->addMembershipManually($this->invitedMembership);
    }

    function test_changeProfile_shouldChangeTeamProfilePropertiesAndReturnTrue() {
        $request = TeamWriteDataObject::request('new name', 'new vision', 'new mission', 'new culture', 'new agreement');
        $msg = $this->team->changeProfile($this->adminActiveMembership->getId(), $request);
        $this->assertTrue($msg);
        $rdo = $this->team->toReadDataObject();
        $this->assertEquals($request->getName(), $rdo->getName());
        $this->assertEquals($request->getVision(), $rdo->getVision());
        $this->assertEquals($request->getMission(), $rdo->getMission());
        $this->assertEquals($request->getCulture(), $rdo->getCulture());
        $this->assertEquals($request->getFounderAgreement(), $rdo->getFounderAgreement());
//print_r($this->team->toReadDataObject()->toArray());
    }

    function test_changeProfile_commanderNotAdmin_returnErrorMessage() {
        $request = TeamWriteDataObject::request('new name', 'new vision', 'new mission', 'new culture', 'new agreement');
        $msg = $this->team->changeProfile($this->normalActiveMembership->getId(), $request);
        $this->assertInstanceOf('\Resources\ErrorMessage', $msg);
//print_r($msg->toArray());        
    }

    function test_changeProfile_commanderAdminButNoLongerActive_returnErrorMessage() {
        $this->adminActiveMembership->changeStatus('remove');
        $this->assertEquals("remove", $this->adminActiveMembership->getStatus());
        $request = TeamWriteDataObject::request('new name', 'new vision', 'new mission', 'new culture', 'new agreement');
        $msg = $this->team->changeProfile($this->adminActiveMembership->getId(), $request);
        $this->assertInstanceOf('\Resources\ErrorMessage', $msg);
//print_r($msg->toArray());        
    }

    function test_inviteNewMember_shouldAddInvitedMemberhipToPropertyAndReturnTrue() {
        $this->assertEquals(4, $this->team->getCountOfMember());
        $invitedTalent = new TestableTalent('apur', $this->cityRDO, $this->trackRDO);
        $msg = $this->team->inviteNewMember($this->adminActiveMembership->getId(), $invitedTalent, $position = 'programmer');

        $this->assertTrue($msg);
        $this->assertEquals(5, $this->team->getCountOfMember());
        $apurRdo = $this->team->lastMembership()->toTeamMemberReadDataObject();
        $this->assertEquals(5, $apurRdo->getId());
        $this->assertEquals($position, $apurRdo->getPosition());
        $this->assertEquals('invited', $apurRdo->getStatus());
        $this->assertEquals($invitedTalent->toReadDataObject()->toArray(), $apurRdo->talentRDO()->toArray());
    }

    function test_inviteNewMember_commanderNotAdmin_returnErrormessage() {
        $this->assertEquals(4, $this->team->getCountOfMember());
        $invitedTalent = new TestableTalent('apur', $this->cityRDO, $this->trackRDO);
        $msg = $this->team->inviteNewMember($this->normalActiveMembership->getId(), $invitedTalent, $position = 'programmer');

        $this->assertEquals(4, $this->team->getCountOfMember());
        $this->assertInstanceOf('\Resources\ErrorMessage', $msg);
//print_r($msg->toArray());
    }

    function test_inviteNewMember_memberAlreadyInvited_returnErrormessage() {
        $this->assertEquals(4, $this->team->getCountOfMember());
        $msg = $this->team->inviteNewMember($this->adminActiveMembership->getId(), $this->invitedTalent, $position = 'programmer');

        $this->assertInstanceOf('\Resources\ErrorMessage', $msg);
//print_r($msg->toArray());
    }

    function test_inviteNewMember_memberAlreadyActiveTeamMemberOfThisTeam_returnErrormessage() {
        $this->assertEquals(4, $this->team->getCountOfMember());
        $msg = $this->team->inviteNewMember($this->adminActiveMembership->getId(), $this->activeTalent, $position = 'programmer');

        $this->assertInstanceOf('\Resources\ErrorMessage', $msg);
//print_r($msg->toArray());
    }
    function test_inviteNewMember_memberInDifferenctCity_returnErrormessage() {
        $this->assertEquals(4, $this->team->getCountOfMember());
        $msg = $this->team->inviteNewMember($this->adminActiveMembership->getId(), $this->talentOfDiffCity, $position = 'programmer');

        $this->assertInstanceOf('\Resources\ErrorMessage', $msg);
//print_r($msg->toArray());
    }

    function test_cancelInvitation_shouldChangeMembershipStatusFromInvitedToCancelAndReturnTrue() {
        $this->assertEquals('invited', $this->invitedMembership->getStatus());
        $msg = $this->team->cancelInvitation($this->adminActiveMembership->getId(), $this->invitedMembership->getId());
        $this->assertTrue($msg);
        $this->assertEquals('cancel', $this->invitedMembership->getStatus());
    }

    function test_cancelInvitation_commanderNotAdmin_returnErrorMessage() {
        $msg = $this->team->cancelInvitation($this->normalActiveMembership->getId(), $this->invitedMembership->getId());
        $this->assertInstanceOf('\Resources\ErrorMessage', $msg);
//print_r($msg->toArray());
    }

    function test_cancelInvitation_membershipNotFound_returnErrorMessage() {
        $msg = $this->team->cancelInvitation($this->adminActiveMembership->getId(), 312);
        $this->assertInstanceOf('\Resources\ErrorMessage', $msg);
//print_r($msg->toArray());
    }

    function test_cancelInvitation_currentStatusNotInvited_returnErrorMessage() {
        $msg = $this->team->cancelInvitation($this->adminActiveMembership->getId(), $this->normalActiveMembership->getId());
        $this->assertInstanceOf('\Resources\ErrorMessage', $msg);
//print_r($msg->toArray());
    }

    function test_removeMember_shouldChangeMembershipStatusFromActiveToRemove() {
        $this->assertEquals('active', $this->normalActiveMembership->getStatus());
        $msg = $this->team->removeMember($this->adminActiveMembership->getId(), $this->normalActiveMembership->getId());
        $this->assertTrue($msg);
        $this->assertEquals('remove', $this->normalActiveMembership->getStatus());
    }

    function test_removeMember_commanderNotAdmin_returnErrorMessage() {
        $msg = $this->team->removeMember($this->normalActiveMembership->getId(), $this->normalActiveMembership->getId());
        $this->assertInstanceOf('\Resources\ErrorMessage', $msg);
//print_r($msg->toArray());
    }

    function test_removeMember_membershipNotFound_returnErrorMessage() {
        $msg = $this->team->removeMember($this->adminActiveMembership->getId(), 2312);
        $this->assertInstanceOf('\Resources\ErrorMessage', $msg);
//print_r($msg->toArray());
    }

    function test_removeMember_currentStatusNotActive_returnErrorMessage() {
        $msg = $this->team->removeMember($this->adminActiveMembership->getId(), $this->invitedMembership->getId());
        $this->assertInstanceOf('\Resources\ErrorMessage', $msg);
//print_r($msg->toArray());
    }

    function test_removeMember_memberIsCreator_returnErrorMessage() {
        $msg = $this->team->removeMember($this->adminActiveMembership->getId(), $this->creatorMembership->getId());
        $this->assertInstanceOf('\Resources\ErrorMessage', $msg);
//print_r($msg->toArray());
    }

    function test_aMembershipRdoOfMemberId_returnMembershipRDO() {
        $rdo = $this->team->aMembershipRDO_ofMemberId($this->normalActiveMembership->getId());
        $this->assertInstanceOf('\Superclass\DomainModel\Team\TeamMemberReadDataObject', $rdo);
//print_r($rdo->toArray());
    }

    function test_aMembershipRdoOfMemberId_membershipNotFound_returnNull() {
        $rdo = $this->team->aMembershipRDO_ofMemberId(3213);
        $this->assertNull($rdo);
    }

    function test_allActiveMembershipRdo_returnArrayOfActiveMembershipRDOs() {
        $rdos = $this->team->allActiveMembershipRDO();
        $this->assertEquals(3, count($rdos));
        foreach ($rdos as $rdo) {
            $this->assertInstanceOf('\Superclass\DomainModel\Team\TeamMemberReadDataObject', $rdo);
//print_r($rdo->toArray());
        }
    }

    function test_allActiveMembershipRdo_noActiveMembership_returnEmptyArray() {
        $this->creatorMembership->changeStatus('resign');
        $this->adminActiveMembership->changeStatus('resign');
        $this->normalActiveMembership->changeStatus('resign');
        $rdos = $this->team->allActiveMembershipRDO();
        $this->assertEmpty($rdos);
    }

    function test_allInvitedMembershipRdo_returnArrayOfInvitedMembershipRDOs() {
        $invitedTalent = new TestableTalent('apur', $this->cityRDO, $this->trackRDO);
        $this->team->inviteNewMember($this->adminActiveMembership->getId(), $invitedTalent, 'Salesman');
        $rdos = $this->team->allInvitedMembershipRDO();
        $this->assertEquals(2, count($rdos));
        foreach ($rdos as $rdo) {
            $this->assertInstanceOf('\Superclass\DomainModel\Team\TeamMemberReadDataObject', $rdo);
//print_r($rdo->toArray());
        }
    }

    function test_allInvitedMembershipRdo_noInvitedMembership_returnEmptyArray() {
        $this->invitedMembership->changeStatus('reject');
        $rdos = $this->team->allInvitedMembershipRDO();
        $this->assertEmpty($rdos);
    }

}

class TestableMembership extends Membership {

    function getTalent() {
        return $this->talent;
    }

    function getTeam() {
        return $this->team;
    }

}

class TestableTalent extends Talent {

    public function __construct($name, CityReadDataObject $cityRDO, TrackReadDataObject $trackRDO) {
        $this->id = \Ramsey\Uuid\Uuid::uuid4()->toString();
        $this->name = $name;
        $this->birthDate = new \DateTime('1980-09-08');
        $this->cityRDO = $cityRDO;
        $this->trackRDO = $trackRDO;
        parent::__construct();
    }

}

class TestableTeam extends Team {

    public function __construct($id, \Team\Profile\DomainModel\Team\DataObject\TeamWriteDataObject $request, \Superclass\DomainModel\City\CityReadDataObject $cityRDO) {
        parent::__construct($id, $request, $cityRDO);
    }

    function addMembershipManually(Membership $membership) {
        $this->members->set($membership->getId(), $membership);
    }

    function getCountOfMember() {
        return $this->members->count();
    }

    /**
     * @return Membership
     */
    function lastMembership() {
        return $this->members->last();
    }

}
