<?php

namespace Tests\Personnel\ApplicationService\Personnel;

use Personnel\ApplicationService\Personnel\RemovePersonnelService;

class RemovePersonnelServiceTest extends \PHPUnit_Framework_TestCase {

    protected $repository;
    protected $director;
    protected $trackCoordinator;
    protected $service;

    protected function setUp() {
        $preparedData = new PreparedInMemoryPersonnelData();
        $this->repository = $preparedData->getRepository();
        $this->director = $preparedData->getDirector();
        $this->trackCoordinator = $preparedData->getTrackCoordinator();
        $this->service = new RemovePersonnelService($this->repository);
    }

    function test_execute_shouldRemoveData() {
        $this->assertEquals(2, count($this->repository->all()));
        $this->assertFalse($this->trackCoordinator->getIsRemoved());
        $msg = $this->service->execute($this->director->getId(), $this->trackCoordinator->getId());
        $this->assertTrue($msg->getStatus());
        $this->assertEquals(1, count($this->repository->all()));
        $this->assertTrue($this->trackCoordinator->getIsRemoved());
    }

    function test_execute_executorNotFOund_throwException() {
        $this->setExpectedException('\Resources\Exception\DoNotCatchException');
        $this->service->execute(\Ramsey\Uuid\Uuid::uuid4()->toString(), $this->trackCoordinator->getId());
    }

    function test_execute_unauthorizedPersonnel_throwException() {
        $msg = $this->service->execute($this->trackCoordinator->getId(), $this->director->getId());
        $this->assertFalse($msg->getStatus());
        print_r($msg->errorMessage()->toArray());
    }

    function test_execute_PersonnelToRemoveNotFOund_returnFalse() {
        $msg = $this->service->execute($this->director->getId(), \Ramsey\Uuid\Uuid::uuid4()->toString());
        $this->assertFalse($msg->getStatus());
        print_r($msg->errorMessage()->toArray());
    }

    function test_execute_PersonnelAlreadyRemove_returnFalse() {
        $this->trackCoordinator->remove();
        $this->assertEquals(1, count($this->repository->all()));
        $msg = $this->service->execute($this->director->getId(), $this->trackCoordinator->getId());
        $this->assertFalse($msg->getStatus());
        $this->assertEquals(1, count($this->repository->all()));
        print_r($msg->errorMessage()->toArray());
    }

}
