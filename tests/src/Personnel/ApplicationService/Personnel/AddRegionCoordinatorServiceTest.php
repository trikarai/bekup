<?php

namespace Tests\Personnel\ApplicationService\Personnel;

use Personnel\ApplicationService\Personnel\AddRegionCoordinatorService;
use Personnel\DomainModel\Personnel\DataObject\PersonnelWriteDataObject;
use Personnel\DomainModel\Personnel\ValueObject\PersonnelPassword;

class AddRegionCoordinatorServiceTest extends \PHPUnit_Framework_TestCase {

    protected $service;
    protected $director;
    protected $trackCoordinator;
    protected $repository;
    protected $bandung;

    protected function setUp() {
        $cityData = new \Tests\City\Profile\ApplicationService\City\PreparedInMemoryCityData();
        $this->bandung = $cityData->bandung();

        $preparedData = new PreparedInMemoryPersonnelData();
        $this->repository = $preparedData->getRepository();
        $this->director = $preparedData->getDirector();
        $this->trackCoordinator = $preparedData->getTrackCoordinator();

        $this->service = new AddRegionCoordinatorService($this->repository, $cityData->rdoRepository());
    }

    protected function _createRequest($email = 'tri@email.org') {
        return PersonnelWriteDataObject::asRegionCoordinatorRequest('tri', $email, '123', $this->bandung->getId());
    }

    function test_execute_scenario_shouldAddToRepositoryAndReturnTrueResponse() {
        $this->assertEquals(2, count($this->repository->all()));

        $request = $this->_createRequest();
        $msg = $this->service->execute($this->director->getId(), $request);

        $this->assertTrue($msg->getStatus());
        $this->assertEquals(3, count($this->repository->all()));
        $tri = $this->repository->getLastPersonnel();
        $triRdo = $tri->toReadDataObject();
        $this->assertEquals('tri', $triRdo->getName());
        $this->assertEquals('tri@email.org', $triRdo->getEmail());
        $this->assertTrue($tri->password()->sameValueAs(PersonnelPassword::fromNative('123')));
        $this->assertEquals($this->bandung->toReadDataObject(), $triRdo->cityRDO());
        print_r($triRdo->toArray());
    }

    function test_execute_cityNotFound_returnFalseResponse() {
        $request = PersonnelWriteDataObject::asRegionCoordinatorRequest('tri', 'tri@email.org', '123', \Ramsey\Uuid\Uuid::uuid4()->toString());
        $msg = $this->service->execute($this->director->getId(), $request);
        $this->assertFalse($msg->getStatus());
        print_r($msg->errorMessage()->toArray());
    }

    function test_execute_cityAlreadyRemoved_returnFalseResponse() {
        $this->bandung->remove();
        $request = $this->_createRequest();
        $msg = $this->service->execute($this->director->getId(), $request);
        $this->assertFalse($msg->getStatus());
        print_r($msg->errorMessage()->toArray());
    }

}
