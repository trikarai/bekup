<?php

namespace Tests\Team\Idea\ApplicationService\Idea;

use Team\Idea\ApplicationService\Idea\CommandIdeaService;
use Team\Idea\DomainModel\Idea\DataObject\IdeaWriteDataObject;

class CommandIdeaServiceTest extends \PHPUnit_Framework_TestCase {

    protected $service;
    protected $baraTeam;
    protected $kabIdea;
    protected $activeTalent;
    protected $invitedTalent;

    protected function setUp() {
        $teamData = new PreparedInMemoryTeamData();
        $this->activeTalent = $teamData->getActiveMember();
        $this->invitedTalent = $teamData->getInvitedMember();
        $this->baraTeam = $teamData->getTeamBara();
        $this->kabIdea = $teamData->getKabIdea();
        $this->service = new CommandIdeaService($teamData->getTeamRepository(), $teamData->getActiveMembershipFinder());
    }

    protected function _createRequest($name = 'maspoer') {
        return IdeaWriteDataObject::request($name, 'local problem', 'global trend', 'applied tech', 'final result', 'value contradiction', 'used resource');
    }

    function test_updateIdea_returnTrueResponse() {
        $talentId = $this->activeTalent->getId();
        $ideaId = $this->kabIdea->getId();
        $request = $this->_createRequest();
        $msg = $this->service->updateIdea($talentId, $ideaId, $request);
        $this->assertTrue($msg->getStatus());
        $ideaRdo = $this->baraTeam->anIdeaRdoOfId($ideaId);
        $this->assertEquals($request->getName(), $ideaRdo->getName());
//print_r($ideaRdo->toArray());
    }
    function test_updateIdea_activeTeamNotFound_throwException() {
        $this->setExpectedException('\Resources\Exception\DoNotCatchException', 'active team not found');
        $talentId = $this->invitedTalent->getId();
        $ideaId = $this->kabIdea->getId();
        $request = $this->_createRequest();
        $msg = $this->service->updateIdea($talentId, $ideaId, $request);
    }

    function test_update_executingUpdateInTeamFail_returnFalseResponse() {
        $talentId = $this->activeTalent->getId();
        $ideaId = 123;
        $request = $this->_createRequest();
        $msg = $this->service->updateIdea($talentId, $ideaId, $request);
        $this->assertFalse($msg->getStatus());
//print_r($msg->errorMessage()->toArray());
    }

    function test_updateIdea_containInvalidArgument_stopOpAndReturnFalseMO() {
        $talentId = $this->activeTalent->getId();
        $ideaId = $this->kabIdea->getId();
        $request = IdeaWriteDataObject::request('', '', '', '', '', '', '');
        $msg = $this->service->updateIdea($talentId, $ideaId, $request);
        
        $this->assertFalse($msg->getStatus());
print_r($msg->errorMessage()->toArray());
    }

    function test_removeIdea_shouldSetIsRemovedPropertyTrue() {
        $this->assertFalse($this->kabIdea->getIsRemoved());
        $talentId = $this->activeTalent->getId();
        $ideaId = $this->kabIdea->getId();
        $msg = $this->service->removeIdea($talentId, $ideaId);
        
        $this->assertTrue($msg->getStatus());
        $this->assertTrue($this->kabIdea->getIsRemoved());
    }

    function test_removeIdea_activeTeamNotFound_throwException() {
        $this->setExpectedException('\Resources\Exception\DoNotCatchException', 'active team not found');
        $talentId = \Ramsey\Uuid\Uuid::uuid4()->toString();
        $ideaId = $this->kabIdea->getId();
        $msg = $this->service->removeIdea($talentId, $ideaId);
    }

    function test_removeIdea_ExecutingRemoveInTeamFail_returnFalseResponse() {
        $talentId = $this->activeTalent->getId();
        $ideaId = 123;
        $msg = $this->service->removeIdea($talentId, $ideaId);

        $this->assertFalse($msg->getStatus());
print_r($msg->errorMessage()->toArray());
    }
}
