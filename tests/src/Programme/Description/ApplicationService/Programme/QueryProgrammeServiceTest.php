<?php

namespace Tests\Programme\Description\ApplicationService\Programme;

use Programme\Description\ApplicationService\Programme\QueryProgrammeService;

class QueryProgrammeServiceTest extends \PHPUnit_Framework_TestCase {

    protected $programme2017;
    protected $programme2018;
    protected $service;

    protected function setUp() {
        $programmeData = new PreparedInMemoryProgrammeData();
        $this->programme2017 = $programmeData->getProgramme2017();
        $this->programme2018 = $programmeData->getProgramme2018();
        $this->service = new QueryProgrammeService($programmeData->getRdoRepository());
    }

    function test_showById_shouldReturnTrueResponseContainOneProgrammeRDO() {
        $msg = $this->service->showById($this->programme2017->getId());
        $this->assertTrue($msg->getStatus());
        $this->assertInstanceOf('\Programme\Description\DomainModel\Programme\ProgrammeRdo', $msg->firstReadDataObject());
//print_r($msg->firstReadDataObject()->toArray());
    }
    function test_showById_programmeNotFound_returnFalseResponse() {
        $msg = $this->service->showById(\Ramsey\Uuid\Uuid::uuid4()->toString());
        $this->assertFalse($msg->getStatus());
print_r($msg->errorMessage()->toArray());
    }

    function test_showAll_shouldReturnTrueResponseContainAllProgrammeRdo() {
        $msg = $this->service->showAll();
        $this->assertTrue($msg->getStatus());
        $this->assertEquals(2, count($msg->arrayOfReadDataObject()));
        foreach ($msg->arrayOfReadDataObject() as $rdo) {
            $this->assertInstanceOf('\Programme\Description\DomainModel\Programme\ProgrammeRdo', $rdo);
//print_r($rdo->toArray());
        }
    }

    function test_showAll_noProgrammeFound_returnFalseResponse() {
        $this->programme2017->remove();
        $this->programme2018->remove();
        $msg = $this->service->showAll();
        $this->assertFalse($msg->getStatus());
        print_r($msg->errorMessage()->toArray());
    }
}
