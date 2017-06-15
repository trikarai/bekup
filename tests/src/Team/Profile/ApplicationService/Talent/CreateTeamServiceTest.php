<?php

namespace Tests\Team\Profile\ApplicationService\Talent;

use Team\Profile\ApplicationService\Talent\CreateTeamService;
use Team\Profile\DomainModel\Team\DataObject\TeamWriteDataObject;
use Tests\Team\Profile\ApplicationService\Team\TestableTeamRepository;
use Tests\Team\Profile\ApplicationService\Team\PreparedInMemoryTeamData;

class CreateTeamServiceTest extends \PHPUnit_Framework_TestCase {

    protected $service;
    protected $talent;
    protected $talentRepository;
    protected $talentWithActiveTeam;
    protected $teamRepository;

    protected function setUp() {
        $teamData = new PreparedInMemoryTeamData();
        $this->teamRepository = $teamData->getRepository();
        $this->talentRepository = $teamData->getTalentRepository();
        $this->talent = $teamData->getAvailableTalent();
        $this->talentWithActiveTeam = $teamData->getActiveTalent();
        $this->service = new CreateTeamService($this->talentRepository, $this->teamRepository);
    }

    protected function _createRequest() {
        return TeamWriteDataObject::request('bara name', 'bara vision', 'bara mission', 'bara culture', 'bara founder agreement');
    }
    function test_execute_returnTrueRepsonse() {
        $this->assertEquals(1, count($this->teamRepository->_getTeamCount()));
        $request = $this->_createRequest();
        $msg = $this->service->execute($this->talent->getId(), $request, 'position');
        $this->assertTrue($msg->getStatus());
    }

    function test_execute_talentNotFound_throwException() {
        $this->setExpectedException('\Resources\Exception\DoNotCatchException');
        $request = $this->_createRequest();
        $msg = $this->service->execute(\Ramsey\Uuid\Uuid::uuid4()->toString(), $request, 'position');
    }

    function test_execute_containInvalidTeamArgument_returnFalseResponse() {
        $request = TeamWriteDataObject::request('', '', '', '', '');
        $msg = $this->service->execute($this->talent->getId(), $request, 'position');
        $this->assertFalse($msg->getStatus());
        print_r($msg->errorMessage()->toArray());
    }

    function test_execute_containInvalidMemberArgument_returnFalseResponse() {
        $request = $this->_createRequest();
        $msg = $this->service->execute($this->talent->getId(), $request, '');
        $this->assertFalse($msg->getStatus());
        print_r($msg->errorMessage()->toArray());
    }

    function test_execute_failWhenCreatingTeamWithinTalentObject_returnFalseResponse() {
        $request = $this->_createRequest();
        $msg = $this->service->execute($this->talentWithActiveTeam->getId(), $request, 'position');

        $this->assertFalse($msg->getStatus());
        print_r($msg->errorMessage()->toArray());
    }
    
    function test_execute_duplicateNameWithinCIty_returnFalseResponse() {
        $request = TeamWriteDataObject::request('bara', 'sdfs', 'sdfsdf', 'sdfsd', 'sdfsdf');
        $msg = $this->service->execute($this->talent->getId(), $request, 'position');

        $this->assertFalse($msg->getStatus());
        print_r($msg->errorMessage()->toArray());
    }
}
