<?php

namespace Tests\Personnel\ApplicationService\Personnel;

use Personnel\ApplicationService\Personnel\AddTrackCoordinatorService;
use Personnel\DomainModel\Personnel\DataObject\PersonnelWriteDataObject;
use Personnel\DomainModel\Personnel\ValueObject\PersonnelPassword;

class AddTrackCoordinatorServiceTest extends \PHPUnit_Framework_TestCase {

    protected $service;
    protected $director;
    protected $trackCoordinator;
    protected $repository;
    protected $trackTeknis;

    protected function setUp() {
        $trackData = new \Tests\Track\Definition\ApplicationService\Track\PreparedInMemoryTrackData();
        $this->trackTeknis = $trackData->teknis();

        $preparedData = new PreparedInMemoryPersonnelData();
        $this->repository = $preparedData->getRepository();
        $this->director = $preparedData->getDirector();
        $this->trackCoordinator = $preparedData->getTrackCoordinator();

        $this->service = new AddTrackCoordinatorService($this->repository, $trackData->rdoRepository());
    }

    protected function _createRequest($email = 'tri@email.org') {
        return PersonnelWriteDataObject::asTrackCoordinatorRequest('tri', $email, '123', $this->trackTeknis->getId());
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
        $this->assertEquals($this->trackTeknis->toReadDataObject(), $triRdo->trackRDO());
//print_r($triRdo->toArray());
    }

    function test_execute_trackNotFOund_returnFalseResponse() {
        $request = PersonnelWriteDataObject::asTrackCoordinatorRequest('tri', 'tri@email.org', '123', \Ramsey\Uuid\Uuid::uuid4()->toString());
        $msg = $this->service->execute($this->director->getId(), $request);
        $this->assertFalse($msg->getStatus());
//print_r($msg->errorMessage()->toArray());
    }

    function test_execute_trackAlreadyRemoved_returnFalseResponse() {
        $this->trackTeknis->remove();
        $request = $this->_createRequest();
        $msg = $this->service->execute($this->director->getId(), $request);
        $this->assertFalse($msg->getStatus());
        print_r($msg->errorMessage()->toArray());
    }

}
