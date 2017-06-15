<?php

namespace Tests\Team\Profile\ApplicationService\Talent;

use Team\Profile\ApplicationService\Talent\QueryMembershipService;
use Tests\Team\Profile\ApplicationService\Team\PreparedInMemoryTeamData;

class QueryMembershipServiceTest extends \PHPUnit_Framework_TestCase {

    protected $service;
    protected $teamBara;
    protected $invitedTalent;
    protected $activeTalent;
    protected $uninvolvedTalent;

    protected function setUp() {
        $teamData = new PreparedInMemoryTeamData();
        $this->teamBara = $teamData->getTeamBara();
        $this->invitedTalent = $teamData->getInvitedTalent();
        $this->activeTalent = $teamData->getActiveTalent();
        $this->uninvolvedTalent = $teamData->getAvailableTalent();
        $this->service = new QueryMembershipService($teamData->getTalentRepository());
    }

    function test_showByTeamId_returnTrueResponseContainOneTalentMembershipRDO() {
        $talentId = $this->invitedTalent->getId();
        $teamId = $this->teamBara->getId();
        $memberId = $this->invitedTalent->allInvitedMembershipRDO()[0]->getId();
        $msg = $this->service->showByTeamId($talentId, $teamId, $memberId);
        $this->assertTrue($msg->getStatus());
        $this->assertInstanceOf('\Team\Profile\DomainModel\Membership\DataObject\TalentMembershipReadDataObject', $msg->firstReadDataObject());
    }
    function test_showByTeamId_executingQueryMethodInTalentObjectReturnNull_returnFalseResponse() {
        $talentId = $this->invitedTalent->getId();
        $teamId = $this->teamBara->getId();
        $memberId = 123;
        $msg = $this->service->showByTeamId($talentId, $teamId, $memberId);
        $this->assertFalse($msg->getStatus());
        $this->assertEmpty($msg->firstReadDataObject());
print_r($msg->errorMessage()->toArray());
    }

    function test_showByTeamId_talentNotFound_throwException() {
        $this->setExpectedException('\Resources\Exception\DoNotCatchException');
        $talentId = \Ramsey\Uuid\Uuid::uuid4()->toString();
        $teamId = $this->teamBara->getId();
        $memberId = $this->invitedTalent->allInvitedMembershipRDO()[0]->getId();
        $msg = $this->service->showByTeamId($talentId, $teamId, $memberId);
    }

    function test_showActiveMembership_returnTrueResponseContainOneTalentMembershipRDO() {
        $talentId = $this->activeTalent->getId();
        $msg = $this->service->showActiveMembership($talentId);
        $this->assertTrue($msg->getStatus());
        $this->assertInstanceOf('\Team\Profile\DomainModel\Membership\DataObject\TalentMembershipReadDataObject', $msg->firstReadDataObject());
    }

    function test_showActiveMembership_executingQueryMethodInTalentObjectReturnNull_returnFalseResponse() {
        $talentId = $this->uninvolvedTalent->getId();
        $msg = $this->service->showActiveMembership($talentId);
        $this->assertFalse($msg->getStatus());
print_r($msg->errorMessage()->toArray());
    }

    function test_showActiveMembership_talentNotFound_throwException() {
        $this->setExpectedException('\Resources\Exception\DoNotCatchException');
        $talentId = \Ramsey\Uuid\Uuid::uuid4()->toString();
        $msg = $this->service->showActiveMembership($talentId);
    }

    function test_showInvitedMembership_returnTrueResponseContainAllInvitedTalentMembershipRDO() {
        $talentId = $this->invitedTalent->getId();
        $msg = $this->service->showInvitedMembership($talentId);
        $this->assertTrue($msg->getStatus());
        $this->assertEquals(1, count($msg->arrayOfReadDataObject()));
        foreach ($msg->arrayOfReadDataObject() as $rdo) {
            $this->assertInstanceOf('\Team\Profile\DomainModel\Membership\DataObject\TalentMembershipReadDataObject', $rdo);
        }
    }

    function test_showInvitedMembership_executingQueryMethodInTalentObjectReturnNull_returnFalseResponse() {
        $talentId = $this->activeTalent->getId();
        $msg = $this->service->showInvitedMembership($talentId);
        $this->assertFalse($msg->getStatus());
print_r($msg->errorMessage()->toArray());
    }

    function test_showInvitedMembership_talentNotFound_throwException() {
        $this->setExpectedException('\Resources\Exception\DoNotCatchException');
        $talentId = \Ramsey\Uuid\Uuid::uuid4()->toString();
        $msg = $this->service->showInvitedMembership($talentId);
    }
}
