<?php

namespace Tests\Team\Profile\DomainModel\Talent;

use Team\Profile\DomainModel\Talent\Talent;
use Team\Profile\DomainModel\Team\DataObject\TeamWriteDataObject;
use Team\Profile\DomainModel\Membership\Membership;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;

class TalentTest extends \PHPUnit_Framework_TestCase {

    protected $talent;
    protected $baraTeam;

    /** @var Membership */
    protected $baraMembership;
    protected $kabTeam;

    /** @var Membership */
    protected $kabMembership;

    protected function setUp() {
        $this->talent = new TestableTalent();
        $this->_setBaraMembership();
        $this->_setKabMembership();
    }

    protected function _setBaraMembership() {
        $id = 3;
        $position = "CTO";
        $this->baraTeam = new TestableTeam("bara");
        $this->baraMembership = Membership::asInvited($id, $position, $this->talent, $this->baraTeam);
        $this->talent->addMembershipManually($this->baraMembership);
    }

    protected function _setKabMembership() {
        $id = 13;
        $position = "COO";
        $this->kabTeam = new TestableTeam("kab");
        $this->kabMembership = Membership::asInvited($id, $position, $this->talent, $this->kabTeam);
        $this->talent->addMembershipManually($this->kabMembership);
    }

    protected function _createRequest() {
        return TeamWriteDataObject::request('bara', 'bara vision', 'bara mission', 'bara culture', 'bara agreement');
    }

    function test_createTeam_shouldCreateTeamAndAssignMembershipToPropertyAndReturnTrue() {
        $this->assertEquals(2, $this->talent->getCountOfTeamMembership());
        $request = $this->_createRequest();
        $position = 'position';
        $this->assertTrue($this->talent->createTeam(\Ramsey\Uuid\Uuid::uuid4()->toString(), $request, $position));

        $this->assertEquals(3, $this->talent->getCountOfTeamMembership());
        $lastMembershipRdo = $this->talent->lastTeamMembership()->toTalentMembershipReadDataObject();
        $this->assertEquals($position, $lastMembershipRdo->getPosition());
        $this->assertEquals('active', $lastMembershipRdo->getStatus());
        $this->assertTrue($lastMembershipRdo->getIsAdmin());
        $this->assertTrue($lastMembershipRdo->getIsCreator());
        $this->assertEquals(1, $lastMembershipRdo->getId());
        $teamRDO = $lastMembershipRdo->teamRDO();
        $this->assertEquals($request->getName(), $teamRDO->getName());
        $this->assertEquals($request->getVision(), $teamRDO->getVision());
        $this->assertEquals($request->getMission(), $teamRDO->getMission());
        $this->assertEquals($request->getCulture(), $teamRDO->getCulture());
        $this->assertEquals($request->getFounderAgreement(), $teamRDO->getFounderAgreement());
        print_r($lastMembershipRdo->toArray());
    }

    function test_create_alreadyActiveMemberOfOtherTeam_returnErrorMessage() {
        $this->baraMembership->changeStatus('active');
        $this->assertEquals('active', $this->baraMembership->getStatus());
        $request = $this->_createRequest();
        $position = 'position';

        $msg = $this->talent->createTeam(\Ramsey\Uuid\Uuid::uuid4()->toString(), $request, $position);
        $this->assertEquals(2, $this->talent->getCountOfTeamMembership());
        $this->assertInstanceOf('\Resources\ErrorMessage', $msg);
        //print_r($msg->toArray());
    }

    function test_acceptTeamInvitation_shouldChangeMembershipStatusFromInvitedToActiveAndReturnTrue() {
        $this->assertEquals('invited', $this->baraMembership->getStatus());
        $this->talent->acceptTeamInvitation($this->baraTeam->getId(), $this->baraMembership->getId());
        $this->assertEquals('active', $this->baraMembership->getStatus());
    }

    function test_acceptTeamInvitation_alreadyActiveTeamMember_returnErrorMessage() {
        $this->kabMembership->changeStatus("active");
        $msg = $this->talent->acceptTeamInvitation($this->baraTeam->getId(), $this->baraMembership->getId());

        $this->assertEquals('invited', $this->baraMembership->getStatus());
        $this->assertInstanceOf('\Resources\ErrorMessage', $msg);
        //print_r($msg->toArray());
    }

    function test_acceptTeamInvitation_teamMembershipNotFound_returnErrorMessage() {
        //        $msg = $this->talent->acceptTeamInvitation(\Ramsey\Uuid\Uuid::uuid4()->toString(), $this->baraMembership->getId());
        $msg = $this->talent->acceptTeamInvitation($this->baraTeam->getId(), 23123);
        $this->assertInstanceOf('\Resources\ErrorMessage', $msg);
        //print_r($msg->toArray());
    }

    function test_acceptTeamInvitation_currentStatusInNotInvited_returnErrorMessage() {
        //        $this->baraMembership->changeStatus("active");
        //        $this->baraMembership->changeStatus("cancel");
        $this->baraMembership->changeStatus("reject");
        $msg = $this->talent->acceptTeamInvitation($this->baraTeam->getId(), $this->baraMembership->getId());
        $this->assertInstanceOf('\Resources\ErrorMessage', $msg);
        //print_r($msg->toArray());
    }

    function test_rejectTeamInvitation_shouldChangeMembershipStatusFromInvitedToRejectAndReturnTrue() {
        $this->assertEquals('invited', $this->baraMembership->getStatus());
        $this->talent->rejectTeamInvitation($this->baraTeam->getId(), $this->baraMembership->getId());
        $this->assertEquals('reject', $this->baraMembership->getStatus());
    }

    function test_rejectTeamInvitation_membershipNotFound_returnErrorMessage() {
        //        $msg = $this->talent->rejectTeamInvitation(\Ramsey\Uuid\Uuid::uuid4()->toString(), $this->baraMembership->getId());
        $msg = $this->talent->rejectTeamInvitation($this->baraTeam->getId(), 4123);
        $this->assertInstanceOf('\Resources\ErrorMessage', $msg);
        //print_r($msg->toArray());
    }

    function test_rejectTeamInvitation_currentStatusNotInvited_returnErrorMessage() {
        //        $this->baraMembership->changeStatus("active");
        //        $this->baraMembership->changeStatus("cancel");
        $this->baraMembership->changeStatus("reject");
        $msg = $this->talent->rejectTeamInvitation($this->baraTeam->getId(), $this->baraMembership->getId());
        $this->assertInstanceOf('\Resources\ErrorMessage', $msg);
        //print_r($msg->toArray());
    }

    function test_resign_shouldChangeStatusFromActiveToResignAndReturnTrue() {
        $this->baraMembership->changeStatus("active");
        $this->assertEquals('active', $this->baraMembership->getStatus());
        $this->assertTrue($this->talent->resign());
        $this->assertEquals('resign', $this->baraMembership->getStatus());
    }

    function test_resign_noActiveMembership_returnErrorMessage() {
        $msg = $this->talent->resign();
        $this->assertInstanceOf('\Resources\ErrorMessage', $msg);
        //print_r($msg->toArray());
    }

    function test_anActiveTeamMembershipRDO_returnTeamMembershipRDO() {
        $this->baraMembership->changeStatus('active');
        $rdo = $this->talent->anActiveMembershipRDO();
        $this->assertInstanceOf('\Team\Profile\DomainModel\Membership\DataObject\TalentMembershipReadDataObject', $rdo);
        //print_r($rdo->toArray());
    }

    function test_anActiveTeamMembershipRDO_noActiveTeam_returnNull() {
        $rdo = $this->talent->anActiveMembershipRDO();
        $this->assertNull($rdo);
    }

    function test_aTeamMembershipRdoOfTeamIdAndMemberhipId_returnTeamMembershipRDO() {
        $rdo = $this->talent->aMembershipRDO_ofTeamIdAndMembershipId($this->baraTeam->getId(), $this->baraMembership->getId());
        $this->assertInstanceOf('\Team\Profile\DomainModel\Membership\DataObject\TalentMembershipReadDataObject', $rdo);
        //print_r($rdo->toArray());
    }

    function test_aTeamMembershipRdoOfTeamIdAndMemberhipId_teamMembershipNotFound_returnNull() {
        //        $rdo = $this->talent->aTeamMembershipRDO_ofTeamIdAndMembershipId(\Ramsey\Uuid\Uuid::uuid4()->toString(), $this->baraMembership->getId());
        $rdo = $this->talent->aMembershipRDO_ofTeamIdAndMembershipId($this->baraTeam->getId(), 1231);
        $this->assertNull($rdo);
    }

    function test_allInvitedTeamMembershipRDO_returnArrayOfInvitedTeamMembershipRDOs() {
        $rdos = $this->talent->allInvitedMembershipRDO();
        $this->assertEquals(2, count($rdos));
        foreach ($rdos as $rdo) {
            $this->assertInstanceOf('\Team\Profile\DomainModel\Membership\DataObject\TalentMembershipReadDataObject', $rdo);
            print_r($rdo->toArray());
        }
    }

    function test_allInvitedTeamMembershipRDO_noInvitationMembership_returnEmptyArray() {
        $this->baraMembership->changeStatus('cancel');
        $this->kabMembership->changeStatus('cancel');
        $rdos = $this->talent->allInvitedMembershipRDO();
        $this->assertEmpty($rdos);
    }

}

use Team\Profile\DomainModel\Team\Team;
use Track\Definition\DomainModel\Track\Track;
use Track\Definition\DomainModel\Track\DataObject\TrackWriteDataObject;
use City\Profile\DomainModel\City\City;

class TestableTeam extends Team {

    public function __construct($name) {
        $this->id = \Ramsey\Uuid\Uuid::uuid4()->toString();
        $this->cityRDO = (new City(\Ramsey\Uuid\Uuid::uuid4()->toString(), 'bandung'))->toReadDataObject();
        $this->name = $name;
    }

}

class TestableTalent extends Talent {

    public function __construct() {
        $this->birthDate = new \DateTime('1980-09-08');
        $this->trackRDO = (new Track(\Ramsey\Uuid\Uuid::uuid4()->toString(), TrackWriteDataObject::request('teknis', 'deskripsi teknis')))->toReadDataObject();
        $this->cityRDO = (new City(\Ramsey\Uuid\Uuid::uuid4()->toString(), 'bandung'))->toReadDataObject();
        parent::__construct();
    }

    function addMembershipManually(Membership $membership) {
        $this->teamMemberships->add($membership);
    }

    /**
     * @return Membership
     */
    function lastTeamMembership() {
        return $this->teamMemberships->last();
    }

    function getCountOfTeamMembership() {
        return $this->teamMemberships->count();
    }

}
