<?php

namespace Tests\City\Profile\ApplicationService\City;

use City\Profile\ApplicationService\City\QueryCityService;

class QueryCityServiceTest extends \PHPUnit_Framework_TestCase {

    protected $service;
    protected $bandung;
    protected $jakarta;

    protected function setUp() {
        $cityData = new PreparedInMemoryCityData();
        $this->bandung = $cityData->bandung();
        $this->jakarta = $cityData->jakarta();
        $this->service = new QueryCityService($cityData->rdoRepository());
    }

    function test_showById_shouldReturnTrueMessageWithCItyRDO() {
        $msg = $this->service->showById($this->bandung->getId());
        $this->assertTrue($msg->getStatus());
        $this->assertInstanceOf('\Superclass\DomainModel\City\CityReadDataObject', $msg->firstReadDataObject());
        print_r($msg->firstReadDataObject()->toArray());
    }

    function test_showById_cityNotFound_returnFalseStatusMessage() {
        $msg = $this->service->showById(\Ramsey\Uuid\Uuid::uuid4()->toString());
        $this->assertFalse($msg->getStatus());
        print_r($msg->errorMessage()->toArray());
    }

    function test_showById_cityAlreadyRemoved_returnFalseStatusMessage() {
        $this->bandung->remove();
        $msg = $this->service->showById($this->bandung->getId());
        $this->assertFalse($msg->getStatus());
        print_r($msg->errorMessage()->toArray());
    }

    function test_showAll_shouldReturnTrueStatusMessageWithCitiesRDO() {
        $msg = $this->service->showAll();
        $this->assertTrue($msg->getStatus());
        $this->assertEquals(2, count($msg->arrayOfReadDataObject()));
        foreach ($msg->arrayOfReadDataObject() as $rdo) {
            $this->assertInstanceOf('\Superclass\DomainModel\City\CityReadDataObject', $rdo);
            print_r($rdo->toArray());
        }
    }

    function test_showAll_emptyData_returnFalseStatusMessage() {
        $this->bandung->remove();
        $this->jakarta->remove();
        $msg = $this->service->showAll();
        $this->assertFalse($msg->getStatus());
        print_r($msg->errorMessage()->toArray());
    }

}
