<?php

namespace Tests\Team\Profile\ApplicationService\Team;

use Team\Profile\ApplicationService\Team\InviteTeamMemberService;
use Superclass\ApplicationService\Talent\BaseTalentFinder;
use Tests\Team\Profile\ApplicationService\Talent\TestableTalentRepository;

class InviteTeamMemberServiceTest extends \PHPUnit_Framework_TestCase {

    protected $service;
    protected $teamBara;
    protected $invitedTalent;
    protected $availableTalent;
    protected $activeTalent;

    protected function setUp() {
        $teamData = new PreparedInMemoryTeamData();
        $this->teamBara = $teamData->getTeamBara();
        $this->invitedTalent = $teamData->getInvitedTalent();
        $this->availableTalent = $teamData->getAvailableTalent();
        $this->activeTalent = $teamData->getActiveTalent();
        $this->service = new InviteTeamMemberService($teamData->getRepository(), $teamData->getTalentRepository());
    }

    function test_execute_returnTrueResponse() {
        $commanderId = $this->activeTalent->getId();
        $idOfTalentToInvite = $this->availableTalent->getId();
        $position = 'programmer';
        $msg = $this->service->execute($commanderId, $idOfTalentToInvite, $position);
        $this->assertTrue($msg->getStatus());
    }
    function test_execute_containInvalidArgument_returnFalseResponse() {
        $commanderId = $this->activeTalent->getId();
        $idOfTalentToInvite = $this->availableTalent->getId();
        $position = '';
        $msg = $this->service->execute($commanderId, $idOfTalentToInvite, $position, 123);
        $this->assertFalse($msg->getStatus());
print_r($msg->errorMessage()->toArray());
    }

    function test_execute_talentToInviteNotFound_returnFalseResponse() {
        $commanderId = $this->activeTalent->getId();
        $idOfTalentToInvite = \Ramsey\Uuid\Uuid::uuid4()->toString();
        $position = 'programmer';
        $msg = $this->service->execute($commanderId, $idOfTalentToInvite, $position);
        $this->assertFalse($msg->getStatus());
print_r($msg->errorMessage()->toArray());
    }

    function test_execute_failToExecuteInviteMemberInTeamObject_returnFalseResponse() {
        $commanderId = $this->activeTalent->getId();
        $idOfTalentToInvite = $this->invitedTalent->getId();
        $position = 'programmer';
        $msg = $this->service->execute($commanderId, $idOfTalentToInvite, $position);
        $this->assertFalse($msg->getStatus());
print_r($msg->errorMessage()->toArray());
    }

    function test_execute_commanderNotFound_throwException() {
        $this->setExpectedException('\Resources\Exception\DoNotCatchException');
        $commanderId = \Ramsey\Uuid\Uuid::uuid4()->toString();
        $idOfTalentToInvite = $this->availableTalent->getId();
        $position = 'programmer';
        $msg = $this->service->execute($commanderId, $idOfTalentToInvite, $position);
    }
    function test_execute_activeTeamNotFound_throwException() {
        $this->setExpectedException('\Resources\Exception\DoNotCatchException');
        $commanderId = $this->invitedTalent->getId();
        $idOfTalentToInvite = $this->availableTalent->getId();
        $position = 'programmer';
        $msg = $this->service->execute($commanderId, $idOfTalentToInvite, $position);
    }
}
