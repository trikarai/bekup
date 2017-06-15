<?php

namespace Tests\Team\Profile\ApplicationService\Team;

use Team\Profile\ApplicationService\Team\CommandTeamMemberService;

class CommandTeamMemberServiceTest extends \PHPUnit_Framework_TestCase {

    protected $service;
    protected $creatorTalent;
    protected $activeTalent;
    protected $invitedTalent;
    protected $uninvolvedTalent;
    protected $teamBara;

    protected function setUp() {
        $teamData = new PreparedInMemoryTeamData();
        $this->teamBara = $teamData->getTeamBara();
        $this->creatorTalent = $teamData->getCreatorTalent();
        $this->activeTalent = $teamData->getActiveTalent();
        $this->invitedTalent = $teamData->getInvitedTalent();
        $this->uninvolvedTalent = $teamData->getAvailableTalent();
        $this->service = new CommandTeamMemberService($teamData->getRepository(), $teamData->getTalentRepository());
    }

    function test_cancelInvitation_returnTrueResponse() {
        $commanderId = $this->activeTalent->getId();
        $memberId = $this->invitedTalent->allInvitedMembershipRDO()[0]->getId();
        $msg = $this->service->cancelInvitation($commanderId, $memberId);
        $this->assertTrue($msg->getStatus());
        $this->assertEquals('cancel', $this->invitedTalent->aMembershipRDO_ofTeamIdAndMembershipId($this->teamBara->getId(), $memberId)->getStatus());
    }
    function test_cancelInvitation_failToExecuteCancelInvitationInTeamObject_returnFalseResponse() {
        $commanderId = $this->activeTalent->getId();
        $memberId = 123;
        $msg = $this->service->cancelInvitation($commanderId, $memberId);
        $this->assertFalse($msg->getStatus());
print_r($msg->errorMessage()->toArray());
    }

    function test_cancelInvitation_talentNotFound_throwException() {
        $this->setExpectedException('\Resources\Exception\DoNotCatchException', 'talent not found');
        $commanderId = \Ramsey\Uuid\Uuid::uuid4()->toString();
        $memberId = $this->invitedTalent->allInvitedMembershipRDO()[0]->getId();
        $msg = $this->service->cancelInvitation($commanderId, $memberId);
        $this->assertTrue($msg->getStatus());
    }
    function test_cancelInvitation_activeMEmbershipNotFound_throwException() {
        $this->setExpectedException('\Resources\Exception\DoNotCatchException', 'active team not found');
        $commanderId = $this->uninvolvedTalent->getId();
        $memberId = $this->invitedTalent->allInvitedMembershipRDO()[0]->getId();
        $msg = $this->service->cancelInvitation($commanderId, $memberId);
        $this->assertTrue($msg->getStatus());
    }

    function test_removeMember_returnTrueResponse() {
        $commanderId = $this->creatorTalent->getId();
        $memberId = $this->activeTalent->anActiveMembershipRDO()->getId();
        $msg = $this->service->removeMember($commanderId, $memberId);
        $this->assertTrue($msg->getStatus());
        $this->assertEquals('remove', $this->activeTalent->aMembershipRDO_ofTeamIdAndMembershipId($this->teamBara->getId(), $memberId)->getStatus());
    }

    function test_removeMember_failToExecuteRemoveMemberInTeamObject_returnFalseResponse() {
        $commanderId = $this->creatorTalent->getId();
        $memberId = $this->invitedTalent->allInvitedMembershipRDO()[0]->getId();
        $msg = $this->service->removeMember($commanderId, $memberId);
        $this->assertFalse($msg->getStatus());
print_r($msg->errorMessage()->toArray());
    }

    function test_removeMember_talentNotFound_throwException() {
        $this->setExpectedException('\Resources\Exception\DoNotCatchException', 'talent not found');
        $commanderId = \Ramsey\Uuid\Uuid::uuid4()->toString();
        $memberId = $this->activeTalent->anActiveMembershipRDO()->getId();
        $msg = $this->service->removeMember($commanderId, $memberId);
    }
    function test_removeMember_activeTeamNotFound_throwException() {
        $this->setExpectedException('\Resources\Exception\DoNotCatchException', 'active team not found');
        $commanderId = $this->invitedTalent->getId();
        $memberId = $this->activeTalent->anActiveMembershipRDO()->getId();
        $msg = $this->service->removeMember($commanderId, $memberId);
    }
}
