<?php

namespace Tests\Team\Profile\ApplicationService\Team;

use Team\Profile\ApplicationService\Team\UpdateTeamService;
use Team\Profile\DomainModel\Team\DataObject\TeamWriteDataObject;

class UpdateTeamServiceTest extends \PHPUnit_Framework_TestCase {

    protected $service;
    protected $teamBara;
    protected $teamPraja;
    protected $activeTalent;
    protected $activeNonAdminTalent;
    protected $invitedTalent;

    /** @var TestableTeam */
    protected $team;

    protected function setUp() {
        $teamData = new PreparedInMemoryTeamData();
        $this->teamBara = $teamData->getTeamBara();
        $this->teamPraja = $teamData->getTeamPraja();
        $this->activeTalent = $teamData->getActiveTalent();
        $this->activeNonAdminTalent = $teamData->getActiveNonAdminTalent();
        $this->invitedTalent = $teamData->getInvitedTalent();
        $this->service = new UpdateTeamService($teamData->getRepository(), $teamData->getTalentRepository());
    }

    protected function _createRequest($name = 'new name') {
        return TeamWriteDataObject::request($name, 'new vision', 'new mission', 'new cuture', 'new agreement');
    }

    function test_execute_returnTrueResponse() {
        $request = $this->_createRequest();
        $talentId = $this->activeTalent->getId();
        $msg = $this->service->execute($talentId, $request);
        $this->assertTrue($msg->getStatus());
        $teamRdo = $this->teamBara->toReadDataObject();
        $this->assertEquals($request->getName(), $teamRdo->getName());
        $this->assertEquals($request->getVision(), $teamRdo->getVision());
        $this->assertEquals($request->getMission(), $teamRdo->getMission());
        $this->assertEquals($request->getCulture(), $teamRdo->getCulture());
        $this->assertEquals($request->getFounderAgreement(), $teamRdo->getFounderAgreement());
    }
    function test_execute_containInvalidTeamWdoArgument_returnFalseResponse() {
        $request = TeamWriteDataObject::request('', '', '', '', '');
        $talentId = $this->activeTalent->getId();
        $msg = $this->service->execute($talentId, $request);
        $this->assertFalse($msg->getStatus());
print_r($msg->errorMessage()->toArray());        
    }

    function test_execute_duplicateName_returnFalseResponse() {
        $request = $this->_createRequest($this->teamPraja->getName());
        $talentId = $this->activeTalent->getId();
        $msg = $this->service->execute($talentId, $request);
        $this->assertFalse($msg->getStatus());
print_r($msg->errorMessage()->toArray());        
    }

    function test_execute_sameNameAsBefore_returnTrueResponse() {
        $request = $this->_createRequest($this->teamBara->getName());
        $talentId = $this->activeTalent->getId();
        $msg = $this->service->execute($talentId, $request);
        $this->assertTrue($msg->getStatus());
    }

    function test_execute_FailExecutingUpdateMethodInTeam_returnFalseResponse() {
        $request = $this->_createRequest();
        $talentId = $this->activeNonAdminTalent->getId();
        $msg = $this->service->execute($talentId, $request);
        $this->assertFalse($msg->getStatus());
print_r($msg->errorMessage()->toArray());        
    }

    function test_execute_talentNotFound_throwException() {
        $this->setExpectedException('\Resources\Exception\DoNotCatchException', 'talent not found');
        $request = $this->_createRequest();
        $talentId = \Ramsey\Uuid\Uuid::uuid4()->toString();
        $msg = $this->service->execute($talentId, $request);
    }
    function test_execute_activeTeamNotFound_throwException() {
        $this->setExpectedException('\Resources\Exception\DoNotCatchException', 'active team not found');
        $request = $this->_createRequest();
        $talentId = $this->invitedTalent->getId();
        $msg = $this->service->execute($talentId, $request);
    }
}
