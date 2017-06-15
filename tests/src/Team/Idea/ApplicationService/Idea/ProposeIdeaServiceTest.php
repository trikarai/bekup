<?php

namespace Tests\Team\Idea\ApplicationService\Idea;

use Team\Idea\ApplicationService\Idea\ProposeIdeaService;
use Team\Idea\DomainModel\Idea\DataObject\IdeaWriteDataObject;

class ProposeIdeaServiceTest extends \PHPUnit_Framework_TestCase {

    protected $service;
    protected $activeTalent;
    protected $invitedTalent;
    protected $uninvolvedTalent;
    protected $superheroGoku;
    protected $teamBara;

    protected function setUp() {
        $teamData = new PreparedInMemoryTeamData();
        $this->teamBara = $teamData->getTeamBara();
        $this->activeTalent = $teamData->getActiveMember();
        $this->invitedTalent = $teamData->getInvitedMember();
        $this->uninvolvedTalent = $teamData->getUninvolvedMember();
        $this->superheroGoku = $teamData->getSuperheroGoku();
        $this->service = new ProposeIdeaService($teamData->getTeamRepository(), $teamData->getTalentRepository(), $teamData->getActiveMembershipFinder());
    }

    protected function _createRequest($name = 'maspoer') {
        return IdeaWriteDataObject::request($name, 'local problem', 'global trend', 'applied tech', 'final result', 'value contradiction', 'used resource');
    }

    function test_proposeIdea_returnTrueResponse() {
        $this->assertEquals(2, count($this->teamBara->allIdeaRdo()));
        
        $request = $this->_createRequest();
        $msg = $this->service->execute($this->activeTalent->getId(), $request, $this->superheroGoku->getId());
        
        $this->assertTrue($msg->getStatus());
        $this->assertEquals(3, count($this->teamBara->allIdeaRdo()));
        $ideaRdo = $this->teamBara->allIdeaRdo()[2];
        $this->assertEquals($request->getName(), $ideaRdo->getName());
    }
    
    function test_proposeIdea_hasNoSuperhero_proposedIdeaWithoutSuperhero() {
        $request = $this->_createRequest();
        $msg = $this->service->execute($this->activeTalent->getId(), $request);
        $this->assertTrue($msg->getStatus());
    }

    function test_proposeIdea_activeTeamNotFound_stopOpAndReturnFalseStatus() {
        $this->setExpectedException('\Resources\Exception\DoNotCatchException', 'active team not found');
        $request = $this->_createRequest();
        $msg = $this->service->execute($this->invitedTalent->getId(), $request);
    }

    function test_proposeIdea_talentNotFOund_throwException() {
        $this->setExpectedException('\Resources\Exception\DoNotCatchException', 'active team not found');
        $request = $this->_createRequest();
        $msg = $this->service->execute(\Ramsey\Uuid\Uuid::uuid4()->toString(), $request);
    }

    function test_proposeIdea_superheroNotFound_returnErrorMessage() {
        $request = $this->_createRequest();
        $msg = $this->service->execute($this->activeTalent->getId(), $request, \Ramsey\Uuid\Uuid::uuid4()->toString());
        
        $this->assertFalse($msg->getStatus());
//print_r($msg->errorMessage()->toArray());
    }
    function test_proposeIdea_containInvalidArgument_stopOpAndreturnFalseStatus() {
        $request = IdeaWriteDataObject::request('', '', '', '', '', '', '');
        $msg = $this->service->execute($this->activeTalent->getId(), $request, $this->superheroGoku->getId());
        $this->assertFalse($msg->getStatus());
print_r($msg->errorMessage()->toArray());
    }

    function test_proposeIdea_failWhenExecuteProposeIdeaInTeam_returnFalseResponse() {
        $request = $this->_createRequest();
        $this->service->execute($this->activeTalent->getId(), $request, $this->superheroGoku->getId());
        $msg = $this->service->execute($this->activeTalent->getId(), $request, $this->superheroGoku->getId());

        $this->assertFalse($msg->getStatus());
print_r($msg->errorMessage()->toArray());
    }
}
