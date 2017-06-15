<?php

namespace Tests\Team\Profile\ApplicationService\Talent;

use Team\Profile\ApplicationService\Talent\CommandMemberService;
use Tests\Team\Profile\ApplicationService\Team\PreparedInMemoryTeamData;

class CommandMemberServiceTest extends \PHPUnit_Framework_TestCase {

    protected $service;
    protected $repository;
    protected $invitedTalent;
    protected $activeTalent;
    protected $nonInvitedTalent;
    protected $teamBara;

    protected function setUp() {
        $teamData = new PreparedInMemoryTeamData();
        $this->teamBara = $teamData->getTeamBara();
        $this->repository = $teamData->getTalentRepository();
        $this->invitedTalent = $teamData->getInvitedTalent();
        $this->activeTalent = $teamData->getActiveTalent();
        $this->nonInvitedTalent = $teamData->getAvailableTalent();
        $this->service = new CommandMemberService($this->repository);
    }

    function test_acceptInvitation_returnTrueResponse() {
        $talentId = $this->invitedTalent->getId();
        $teamId = $this->teamBara->getId();
        $memberId = $this->invitedTalent->allInvitedMembershipRDO()[0]->getId();
        $msg = $this->service->acceptInvitation($talentId, $teamId, $memberId);
        $this->assertTrue($msg->getStatus());
    }

    function test_acceptInvitation_failWhenExecutingAcceptInvitationInTalentObject_returnFalseResponse() {
        $talentId = $this->invitedTalent->getId();
        $teamId = $this->teamBara->getId();
        $memberId = 123;
        $msg = $this->service->acceptInvitation($talentId, $teamId, $memberId);
        $this->assertFalse($msg->getStatus());
print_r($msg->errorMessage()->toArray());
    }

    function test_acceptInvitation_talentNotFound_throwException() {
        $this->setExpectedException('\Resources\Exception\DoNotCatchException');

        $talentId = \Ramsey\Uuid\Uuid::uuid4()->toString();
        $teamId = $this->teamBara->getId();
        $memberId = 123;
        $msg = $this->service->acceptInvitation($talentId, $teamId, $memberId);
    }

    function test_rejectInvitation_returnTrueResponse() {
        $talentId = $this->invitedTalent->getId();
        $teamId = $this->teamBara->getId();
        $memberId = $this->invitedTalent->allInvitedMembershipRDO()[0]->getId();
        $msg = $this->service->rejectInvitation($talentId, $teamId, $memberId);
        $this->assertTrue($msg->getStatus());
    }

    function test_rejectInvitation_failWhenExecutingRejectInvitataionInTalentObject_returnFalseResponse() {
        $talentId = $this->invitedTalent->getId();
        $teamId = \Ramsey\Uuid\Uuid::uuid4()->toString();
        $memberId = $this->invitedTalent->allInvitedMembershipRDO()[0]->getId();
        $msg = $this->service->rejectInvitation($talentId, $teamId, $memberId);
        $this->assertFalse($msg->getStatus());
print_r($msg->errorMessage()->toArray());
    }

    function test_rejectInvitation_talentNotFound_throwException() {
        $this->setExpectedException('\Resources\Exception\DoNotCatchException');
        $talentId = \Ramsey\Uuid\Uuid::uuid4()->toString();
        $teamId = \Ramsey\Uuid\Uuid::uuid4()->toString();
        $memberId = $this->invitedTalent->allInvitedMembershipRDO()[0]->getId();
        $msg = $this->service->rejectInvitation($talentId, $teamId, $memberId);
    }

    function test_resign_returnTrueResponse() {
        $talentId = $this->activeTalent->getId();
        $msg = $this->service->resign($talentId);
        $this->assertTrue($msg->getStatus());
    }

    function test_resign_failWhenExecutingResignInTalentObject_returnFalseResponse() {
        $talentId = $this->invitedTalent->getId();
        $msg = $this->service->resign($talentId);
        $this->assertFalse($msg->getStatus());
print_r($msg->errorMessage()->toArray());
    }

    function test_resign_talentNotFound_throwException() {
        $this->setExpectedException('\Resources\Exception\DoNotCatchException');
        $talentId = \Ramsey\Uuid\Uuid::uuid4()->toString();
        $msg = $this->service->resign($talentId);
    }
}
