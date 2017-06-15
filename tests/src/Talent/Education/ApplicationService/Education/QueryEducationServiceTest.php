<?php

namespace Tests\Talent\Education\ApplicationService\Education;

use Talent\Education\ApplicationService\Education\QueryEducationService;

class QueryEducationServiceTest extends \PHPUnit_Framework_TestCase {

    protected $service;
    protected $talent;
    protected $sd;
    protected $smp;

    protected function setUp() {
        $educationData = new PreparedInMemoryEducationData();
        $this->talent = $educationData->talentApur();
        $this->sd = $educationData->educationSD();
        $this->smp = $educationData->educationSMP();
        $this->service = new QueryEducationService($educationData->repository());
    }

    function test_showById_returnTrueResponseContainOneRDO() {
        $msg = $this->service->showById($this->talent->getId(), $this->sd->getId());
        $this->assertTrue($msg->getStatus());
        $this->assertInstanceOf('\Talent\Education\DomainModel\Education\DataObject\EducationReadDataObject', $msg->firstReadDataObject());
print_r($msg->firstReadDataObject()->toArray());
    }

    function test_showById_educationNotFound_returnFalseStatus() {
        $this->sd->remove();
        $msg = $this->service->showById($this->talent->getId(), $this->sd->getId());
        $this->assertFalse($msg->getStatus());
//print_r($msg->errorMessage()->toArray());
    }

    function test_showById_talentNotFound_throwException() {
        $this->setExpectedException('\Resources\Exception\DoNotCatchException');
        $this->service->showById(\Ramsey\Uuid\Uuid::uuid4()->toString(), $this->sd->getId());
    }

    function test_showAll_shouldReturnTrueEducationMOcontainAllEduacationRDOs() {
        $msg = $this->service->showAll($this->talent->getId());
        $this->assertTrue($msg->getStatus());
        $this->assertEquals(2, count($msg->arrayOfReadDataObject()));
        foreach($msg->arrayOfReadDataObject() as $rdo){
            $this->assertInstanceOf('\Talent\Education\DomainModel\Education\DataObject\EducationReadDataObject', $rdo);
print_r($rdo->toArray());
        }
    }

    function test_showAll_emptyEducation_returnFalseStatus() {
        $this->sd->remove();
        $this->smp->remove();
        $msg = $this->service->showAll($this->talent->getId());
        $this->assertFalse($msg->getStatus());
        $this->assertEmpty($msg->arrayOfReadDataObject());
print_r($msg->errorMessage()->toArray());
    }

    function test_showAll_talentNotFOund_throwException() {
        $this->setExpectedException('\Resources\Exception\DoNotCatchException');
        $msg = $this->service->showAll(\Ramsey\Uuid\Uuid::uuid4()->toString());
    }
}
