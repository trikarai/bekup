<?php

namespace Tests\Track\Definition\ApplicationService\Track;

use Track\Definition\ApplicationService\Track\QueryTrackService;

class QueryTrackServiceTest extends \PHPUnit_Framework_TestCase {

    protected $service;
    protected $teknis;
    protected $bisnis;

    protected function setUp() {
        $trackData = new PreparedInMemoryTrackData();
        $this->teknis = $trackData->teknis();
        $this->bisnis = $trackData->bisnis();
        $this->service = new QueryTrackService($trackData->rdoRepository());
    }

    function test_showById_shouldReturnMessageObjectWithTrackRDO() {
        $msg = $this->service->showById($this->teknis->getId());
        $this->assertTrue($msg->getStatus());
        $this->assertInstanceOf('\Superclass\DomainModel\Track\TrackReadDataObject', $msg->firstReadDataObject());
        print_r($msg->firstReadDataObject()->toArray());
    }

    function test_showById_trackNotFound_returnFalseStatusMessages() {
        $msg = $this->service->showById(\Ramsey\Uuid\Uuid::uuid4()->toString());
        $this->assertFalse($msg->getStatus());
        print_r($msg->errorMessage()->toArray());
    }

    function test_showById_trackRemoved_returnFalseStatusMessages() {
        $this->teknis->remove();
        $msg = $this->service->showById($this->teknis->getId());
        $this->assertFalse($msg->getStatus());
        print_r($msg->errorMessage()->toArray());
    }

    function test_showAll_shouldReturnMessageObjectWithTrackRDOs() {
        $msg = $this->service->showAll();
        $this->assertTrue($msg->getStatus());
        $this->assertEquals(2, count($msg->arrayOfReadDataObject()));
        foreach ($msg->arrayOfReadDataObject() as $trackRDO) {
            $this->assertInstanceOf('\Superclass\DomainModel\Track\TrackReadDataObject', $trackRDO);
            print_r($trackRDO->toArray());
        }
    }

    function test_showALl_notTrackAvailable_returnFalseMessage() {
        $this->teknis->remove();
        $this->bisnis->remove();
        $msg = $this->service->showAll();
        $this->assertFalse($msg->getStatus());
        print_r($msg->errorMessage()->toArray());
    }

}
