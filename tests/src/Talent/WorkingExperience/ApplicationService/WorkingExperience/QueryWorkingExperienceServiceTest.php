<?php

namespace Talent\WorkingExperience\ApplicationService\WorkingExperience;

use Talent\WorkingExperience\ApplicationService\WorkingExperience\QueryWorkingExperienceService;

class QueryWorkingExperienceServiceTest extends \PHPUnit_Framework_TestCase {

    protected $talent;
    protected $convergain;
    protected $barapraja;
    protected $service;

    protected function setUp() {
        $workingExperienceData = new \Tests\Talent\WorkingExperience\ApplicationService\WorkingExperience\PreparedInMemoryWorkingExperienceData();
        $this->talent = $workingExperienceData->talent();
        $this->convergain = $workingExperienceData->convergain();
        $this->barapraja = $workingExperienceData->barapraja();
        $this->service = new QueryWorkingExperienceService($workingExperienceData->repository());
    }

    function test_showById_shouldReturnWorkingMoWithoneWorkingRDO() {
        $msg = $this->service->showById($this->talent->getId(), $this->convergain->getId());
        $this->assertTrue($msg->getStatus());
        $this->assertInstanceOf('\Talent\WorkingExperience\DomainModel\WorkingExperience\DataObject\WorkingExperienceReadDataObject', $msg->firstReadDataObject());
print_r($msg->firstReadDataObject()->toArray());
    }

    function test_showById_WorkingExperienceNotFOund_returnFalseMO() {
        $msg = $this->service->showById($this->talent->getId(), 123);
        $this->assertFalse($msg->getStatus());
print_r($msg->errorMessage()->toArray());
    }

    function test_showById_WorkingExperienceAlreadyRemoved_returnFalseMO() {
        $this->convergain->remove();
        $msg = $this->service->showById($this->talent->getId(), $this->convergain->getId());
        $this->assertFalse($msg->getStatus());
print_r($msg->errorMessage()->toArray());
    }

    function test_showById_talentNotFOund_throwException() {
        $this->setExpectedException('\Resources\Exception\DoNotCatchException');
        $msg = $this->service->showById(\Ramsey\Uuid\Uuid::uuid4()->toString(), $this->convergain->getId());
    }

    function test_showAll_shouldReturnWorkingMoWithAllWorkingRdo() {
        $msg = $this->service->showAll($this->talent->getId());
        $this->assertTrue($msg->getStatus());
        $this->assertEquals(2, count($msg->arrayOfReadDataObject()));
        foreach ($msg->arrayOfReadDataObject() as $rdo) {
            $this->assertInstanceOf('\Talent\WorkingExperience\DomainModel\WorkingExperience\DataObject\WorkingExperienceReadDataObject', $rdo);
print_r($rdo->toArray());
        }
    }

    function test_showAll_noData_returnFalse() {
        $this->convergain->remove();
        $this->barapraja->remove();
        $msg = $this->service->showAll($this->talent->getId());
        $this->assertFalse($msg->getStatus());
print_r($msg->errorMessage()->toArray());
    }

    function test_showAll_talentNotFOund_throwException() {
        $this->setExpectedException('\Resources\Exception\DoNotCatchException');
        $this->service->showAll(\Ramsey\Uuid\Uuid::uuid4()->toString());
    }

}
