<?php

namespace Tests\Team\Profile\ApplicationService\Team;

use Team\Profile\ApplicationService\Team\QueryMemberService;

class QueryMemberServiceTest extends \PHPUnit_Framework_TestCase {
    protected $service;
    protected $teamBara;
    protected $activeTalent;
    protected $invitedTalent;
    protected $uninvolvedTalent;
    protected $teamPraja;
    protected $prajaCreator;
    
    protected function setUp() {
        $teamData = new PreparedInMemoryTeamData();
        $this->teamBara = $teamData->getTeamBara();
        $this->activeTalent = $teamData->getActiveTalent();
        $this->invitedTalent = $teamData->getInvitedTalent();
        $this->uninvolvedTalent = $teamData->getAvailableTalent();
        $this->teamPraja = $teamData->getTeamPraja();
        $this->prajaCreator = $teamData->getPrajaCreator();
        $this->service = new QueryMemberService($teamData->getRepository(), $teamData->getTalentRepository());
    }
    
    function test_showByMemberId_returnTrueResponseContainATeamMemberRDO() {
        $talentId = $this->activeTalent->getId();
        $memberId = $this->invitedTalent->allInvitedMembershipRDO()[0]->getId();
        $msg = $this->service->showByMemberId($talentId, $memberId);
        $this->assertTrue($msg->getStatus());
        $this->assertInstanceOf('\Superclass\DomainModel\Team\TeamMemberReadDataObject', $msg->firstReadDataObject());
    }
    function test_showByMemberId_executingQueryMethodInTeamResultingNull_returnFalseResponse() {
        $talentId = $this->activeTalent->getId();
        $memberId = 123;
        $msg = $this->service->showByMemberId($talentId, $memberId);
        $this->assertFalse($msg->getStatus());
print_r($msg->errorMessage()->toArray());        
    }
    function test_showByMemberId_talentNotFound_trowException() {
        $this->setExpectedException('\Resources\Exception\DoNotCatchException', 'talent not found');
        $talentId = \Ramsey\Uuid\Uuid::uuid4()->toString();
        $memberId = $this->invitedTalent->allInvitedMembershipRDO()[0]->getId();
        $msg = $this->service->showByMemberId($talentId, $memberId);
    }
    function test_showByMemberId_activeTeamNotFound_throwExcpetion() {
        $this->setExpectedException('\Resources\Exception\DoNotCatchException', 'active team not found');
        $talentId = $this->invitedTalent->getId();
        $memberId = $this->invitedTalent->allInvitedMembershipRDO()[0]->getId();
        $msg = $this->service->showByMemberId($talentId, $memberId);
    }
    
    function test_showAllActiveMember_returnTrueResponseCOntainAllActiveTeamMemberRDOs() {
        $talentId = $this->activeTalent->getId();
        $msg = $this->service->showAllActiveMember($talentId);
        
        $this->assertTrue($msg->getStatus());
        $this->assertEquals(3, count($msg->arrayOfReadDataObject()));
        foreach($msg->arrayOfReadDataObject() as $rdo){
            $this->assertInstanceOf('\Superclass\DomainModel\Team\TeamMemberReadDataObject', $rdo);
        }
    }
    function test_showAllActiveMember_talentNotFound_throwExcpetion() {
        $this->setExpectedException('\Resources\Exception\DoNotCatchException', 'talent not found');
        $talentId = \Ramsey\Uuid\Uuid::uuid4()->toString();
        $msg = $this->service->showAllActiveMember($talentId);
    }
    function test_showAllActiveMember_activeTeamNotFound_throwExcpetion() {
        $this->setExpectedException('\Resources\Exception\DoNotCatchException', 'active team not found');
        $talentId = $this->invitedTalent->getId();
        $msg = $this->service->showAllActiveMember($talentId);
    }
    
    function test_showAllInvitedMember_returnTrueResponseContainAllINvitedTeamMemberRDO() {
        $talentId = $this->activeTalent->getId();
        $msg = $this->service->showAllInvitedMember($talentId);
        $this->assertTrue($msg->getStatus());
        $this->assertEquals(1, count($msg->arrayOfReadDataObject()));
        foreach($msg->arrayOfReadDataObject() as $rdo){
            $this->assertInstanceOf('\Superclass\DomainModel\Team\TeamMemberReadDataObject', $rdo);
        }
    }
    function test_showAllInvitedMember_executingQueryMethodInTeamObjectResultingEmptyArray_returnFalseResponse() {
        $talentId = $this->prajaCreator->getId();
        $msg = $this->service->showAllInvitedMember($talentId);
        $this->assertFalse($msg->getStatus());
print_r($msg->errorMessage()->toArray());
    }
    function test_showAllInvitedMember_talentNotFound_throwExcpetion() {
        $this->setExpectedException('\Resources\Exception\DoNotCatchException', 'talent not found');
        $talentId = \Ramsey\Uuid\Uuid::uuid4()->toString();
        $msg = $this->service->showAllInvitedMember($talentId);
    }
    function test_showAllMember_activeTeamNotFound_throwExcpetion() {
        $this->setExpectedException('\Resources\Exception\DoNotCatchException', 'active team not found');
        $talentId = $this->invitedTalent->getId();
        $msg = $this->service->showAllInvitedMember($talentId);
    }
}
