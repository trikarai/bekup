<?php

namespace Tests\Team\Idea\ApplicationService\Idea;

use Team\Idea\ApplicationService\Idea\QueryIdeaService;

class QueryIdeaServiceTest extends \PHPUnit_Framework_TestCase {

    protected $service;
    protected $teamData;
    protected $teamRepository;

    protected function setUp() {
        $this->teamData = new PreparedInMemoryTeamData();
        $this->service = new QueryIdeaService($this->teamData->getTeamRepository(), $this->teamData->getActiveMembershipFinder());
    }

    function test_showIdea_returnTrueResponseWithRdo() {
        $talentId = $this->teamData->getActiveMember()->getId();
        $ideaId = $this->teamData->getKabIdea()->getId();
        $msg = $this->service->showIdeaById($talentId, $ideaId);
        $this->assertTrue($msg->getStatus());
$this->assertInstanceOf('\Team\Idea\DomainModel\Idea\DataObject\IdeaReadDataObject', $msg->firstReadDataObject());
    }
    function test_showIdea_ideaNotFOund_returnFalseResponse() {
        $talentId = $this->teamData->getActiveMember()->getId();
        $ideaId = 123;
        $msg = $this->service->showIdeaById($talentId, $ideaId);
        $this->assertFalse($msg->getStatus());
//print_r($msg->errorMessage()->toArray());
    }

    function test_showIdea_teamNotFOund_throwException() {
        $this->setExpectedException('\Resources\Exception\DoNotCatchException', 'active team not found');
        $talentId = $this->teamData->getInvitedMember()->getId();
        $ideaId = $this->teamData->getKabIdea()->getId();
        $msg = $this->service->showIdeaById($talentId, $ideaId);
    }

    function test_showAllIdea_returnTrueResponseWithAllRdos() {
        $talentId = $this->teamData->getActiveMember()->getId();
        $msg = $this->service->showAllIdea($talentId);
        $this->assertTrue($msg->getStatus());
        $this->assertEquals(2, count($msg->arrayOfReadDataObject()));
        foreach ($msg->arrayOfReadDataObject() as $rdo) {
            $this->assertInstanceOf('\Team\Idea\DomainModel\Idea\DataObject\IdeaReadDataObject', $rdo);
        }
    }

    function test_showAllIdea_noIdeaFound_returnFalseResponse() {
        $this->teamData->getKabIdea()->remove();
        $this->teamData->getFormaticIdea()->remove();
        $talentId = $this->teamData->getActiveMember()->getId();
        $msg = $this->service->showAllIdea($talentId);
        $this->assertFalse($msg->getStatus());
print_r($msg->errorMessage()->toArray());
    }

    function test_showAllIdea_teamNotFOund_throwExcption() {
        $this->setExpectedException('\Resources\Exception\DoNotCatchException', 'active team not found');
        $talentId = \Ramsey\Uuid\Uuid::uuid4()->toString();
        $msg = $this->service->showAllIdea($talentId);
    }
}
