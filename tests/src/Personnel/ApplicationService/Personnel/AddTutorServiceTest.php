<?php

namespace Tests\Personnel\ApplicationService\Personnel;

use Personnel\ApplicationService\Personnel\AddTutorService;
use Personnel\DomainModel\Personnel\DataObject\PersonnelWriteDataObject;
use Personnel\DomainModel\Personnel\ValueObject\PersonnelPassword;

class AddTutorServiceTest extends \PHPUnit_Framework_TestCase {

    protected $service;
    protected $director;
    protected $trackCoordinator;
    protected $repository;
    protected $bandung;
    protected $trackTeknis;

    protected function setUp() {
        $cityData = new \Tests\City\Profile\ApplicationService\City\PreparedInMemoryCityData();
        $this->bandung = $cityData->bandung();

        $trackData = new \Tests\Track\Definition\ApplicationService\Track\PreparedInMemoryTrackData();
        $this->trackTeknis = $trackData->teknis();

        $preparedData = new PreparedInMemoryPersonnelData();
        $this->repository = $preparedData->getRepository();
        $this->director = $preparedData->getDirector();
        $this->trackCoordinator = $preparedData->getTrackCoordinator();

        $this->service = new AddTutorService($this->repository, $trackData->rdoRepository(), $cityData->rdoRepository());
    }

    protected function _createRequest($email = 'tri@email.org') {
        return PersonnelWriteDataObject::asTutorRequest('tri', $email, '123', $this->bandung->getId(), $this->trackTeknis->getId());
    }

    function test_execute_shouldAddToRepositoryAndReturnTrueResponse() {
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
        $this->assertEquals($this->trackTeknis->toReadDataObject(), $triRdo->trackRDO());
        print_r($triRdo->toArray());
    }

    function test_execute_TrackNotFound_returnFalseResponse() {
        $this->trackTeknis->remove();
        $request = $this->_createRequest();
        $msg = $this->service->execute($this->director->getId(), $request);
        $this->assertFalse($msg->getStatus());
        print_r($msg->errorMessage()->toArray());
    }

    function test_execute_CityNotFound_returnFalseResponse() {
        $this->bandung->remove();
        $request = $this->_createRequest();
        $msg = $this->service->execute($this->director->getId(), $request);
        $this->assertFalse($msg->getStatus());
        print_r($msg->errorMessage()->toArray());
    }

}
