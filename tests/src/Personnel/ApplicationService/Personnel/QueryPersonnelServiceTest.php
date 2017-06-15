<?php

namespace Tests\Personnel\ApplicationService\Personnel;

use Personnel\ApplicationService\Personnel\QueryPersonnelService;

class QueryPersonnelServiceTest extends \PHPUnit_Framework_TestCase {

    protected $service;
    protected $director;
    protected $trackCoordinator;

    protected function setUp() {
        $personnelData = new PreparedInMemoryPersonnelData();
        $this->director = $personnelData->getDirector();
        $this->trackCoordinator = $personnelData->getTrackCoordinator();
        $this->service = new QueryPersonnelService($personnelData->rdoRepository());
    }

    function test_showByid_shouldReturnTrueResponseWithOnePersonnelRDO() {
        $msg = $this->service->showById($this->trackCoordinator->getId());
        $this->assertTrue($msg->getStatus());
        $this->assertInstanceOf('\Personnel\DomainModel\Personnel\DataObject\PersonnelReadDataObject', $msg->firstReadDataObject());
    }

    function test_showByid_personnelNotFound_returnFalseResponse() {
        $msg = $this->service->showById(\Ramsey\Uuid\Uuid::uuid4()->toString());
        $this->assertFalse($msg->getStatus());
        print_r($msg->errorMessage()->toArray());
    }

    function test_showAll_shouldReturnTrueResponseWIthAllPersonnelRDO() {
        $msg = $this->service->showAll();
        $this->assertTrue($msg->getStatus());
        $this->assertEquals(2, count($msg->arrayOfReadDataObject()));
        foreach ($msg->arrayOfReadDataObject() as $rdo) {
            $this->assertInstanceOf('\Personnel\DomainModel\Personnel\DataObject\PersonnelReadDataObject', $rdo);
        }
    }

    function test_showAll_noPersonnelFOund_returnFalseResponse() {
        $this->director->remove();
        $this->trackCoordinator->remove();

        $msg = $this->service->showAll();
        $this->assertFalse($msg->getStatus());
//print_r($msg->errorMessage()->toArray());
    }

}
