<?php

namespace Tests\City\Profile\ApplicationService\City;

use City\Profile\ApplicationService\City\CommandCityService;

class CommandCityServiceTest extends \PHPUnit_Framework_TestCase {

    protected $service;
    protected $repository;
    protected $bandung;
    protected $jakarta;
    protected $director;
    protected $trackCoordinator;

    protected function setUp() {
        $cityData = new PreparedInMemoryCityData();
        $this->repository = $cityData->repository();
        $this->bandung = $cityData->bandung();
        $this->jakarta = $cityData->jakarta();

        $personnelData = new \Tests\Personnel\ApplicationService\Personnel\PreparedInMemoryPersonnelData();
        $this->director = $personnelData->getDirector();
        $this->trackCoordinator = $personnelData->getTrackCoordinator();

        $this->service = new CommandCityService($this->repository, $personnelData->rdoRepository());
    }

    function test_add_shouldAddToRepository() {
        $this->assertEquals(2, count($this->repository->all()));

        $msg = $this->service->add($this->director->getId(), 'cimahi');
        $this->assertTrue($msg->getStatus());

        $this->assertEquals(3, count($this->repository->all()));
        $cimahi = $this->repository->lastInsertedCity();
        $this->assertEquals('cimahi', $cimahi->getName());
    }

    function test_add_personnelNotFOund_throwException() {
        $this->setExpectedException('\Resources\Exception\DoNotCatchException');
        $msg = $this->service->add(\Ramsey\Uuid\Uuid::uuid4()->toString(), 'cimahi');
    }

    function test_add_unauthorizedPersonnel_throwException() {
        $msg = $this->service->add($this->trackCoordinator->getId(), 'cimahi');
        $this->assertFalse($msg->getStatus());
//print_r($msg->errorMessage()->toArray());
    }

    function test_add_duplicateName_returnFalseStatusMessage() {
        $msg = $this->service->add($this->director->getId(), $this->bandung->getName());
        $this->assertFalse($msg->getStatus());
//print_r($msg->errorMessage()->toArray());
    }

    function test_add_emptyName_returnFalseStatusMessage() {
        $msg = $this->service->add($this->director->getId(), '');
        $this->assertFalse($msg->getStatus());
//print_r($msg->errorMessage()->toArray());
    }

    function test_update_shouldChangeData() {
        $msg = $this->service->update($this->director->getId(), $this->bandung->getId(), 'cimahi');
        $this->assertTrue($msg->getStatus());
        $this->assertEquals($this->bandung->getName(), 'cimahi');
    }

    function test_update_personnelNotFound_throwException() {
        $this->setExpectedException('\Resources\Exception\DoNotCatchException');
        $msg = $this->service->update(\Ramsey\Uuid\Uuid::uuid4()->toString(), $this->bandung->getId(), 'cimahi');
    }

    function test_update_personnelNotAuthorized_throwException() {
        $msg = $this->service->update($this->trackCoordinator->getId(), $this->bandung->getId(), 'cimahi');
        $this->assertFalse($msg->getStatus());
//print_r($msg->errorMessage()->toArray());
    }

    function test_update_cityNotFound_throwException() {
        $msg = $this->service->update($this->director->getId(), \Ramsey\Uuid\Uuid::uuid4()->toString(), 'cimahi');
        $this->assertFalse($msg->getStatus());
//print_r($msg->errorMessage()->toArray());
    }

    function test_update_duplicateNameWithExisting_returnFalseStatusMessage() {
        $msg = $this->service->update($this->director->getId(), $this->bandung->getId(), $this->jakarta->getName());
        $this->assertFalse($msg->getStatus());
//print_r($msg->errorMessage()->toArray());
    }

    function test_update_sameNameAsBefore_udpateNormally() {
        $msg = $this->service->update($this->director->getId(), $this->bandung->getId(), $this->bandung->getName());
        $this->assertTrue($msg->getStatus());
    }

    function test_update_emptyName_returnFalseStatus() {
        $msg = $this->service->update($this->director->getId(), $this->bandung->getId(), '');
        $this->assertFalse($msg->getStatus());
//print_r($msg->errorMessage()->toArray());
    }

    function test_remove_shouldRemoveDataAndReturnTrueMessage() {
        $this->assertEquals(2, count($this->repository->all()));
        $this->assertFalse($this->bandung->getIsRemoved());

        $msg = $this->service->remove($this->director->getId(), $this->bandung->getId());
        $this->assertTrue($msg->getStatus());
        $this->assertEquals(1, count($this->repository->all()));
        $this->assertTrue($this->bandung->getIsRemoved());
    }

    function test_remove_personnelNotFound_throwException() {
        $this->setExpectedException('\Resources\Exception\DoNotCatchException');
        $this->service->remove(\Ramsey\Uuid\Uuid::uuid4()->toString(), $this->bandung->getId());
    }

    function test_remove_unauthorizedPersonnel_throwException() {
        $msg = $this->service->remove($this->trackCoordinator->getId(), $this->bandung->getId());
        $this->assertFalse($msg->getStatus());
//print_r($msg->errorMessage()->toArray());
    }

    function test_remove_cityNotFound_throwException() {
        $msg = $this->service->remove($this->director->getId(), \Ramsey\Uuid\Uuid::uuid4()->toString());
        $this->assertFalse($msg->getStatus());
//print_r($msg->errorMessage()->toArray());
    }

}
