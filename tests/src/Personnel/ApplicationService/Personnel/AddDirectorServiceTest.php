<?php

namespace Tests\Personnel\ApplicationService\Personnel;

use Personnel\ApplicationService\Personnel\AddDirectorService;
use Personnel\DomainModel\Personnel\DataObject\PersonnelWriteDataObject;
use Personnel\DomainModel\Personnel\ValueObject\PersonnelPassword;

class AddDirectorServiceTest extends \PHPUnit_Framework_TestCase {

    protected $service;
    protected $director;
    protected $trackCoordinator;
    protected $repository;

    protected function setUp() {
        $preparedData = new PreparedInMemoryPersonnelData();
        $this->repository = $preparedData->getRepository();
        $this->service = new AddDirectorService($this->repository);
        $this->director = $preparedData->getDirector();
        $this->trackCoordinator = $preparedData->getTrackCoordinator();
    }

    protected function _createRequest($email = 'tri@email.org') {
        return PersonnelWriteDataObject::asDirectorRequest('tri', $email, '123');
    }

    function test_execute_shouldAddToRepository() {
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
        print_r($triRdo->toArray());
    }

    function test_execute_personnelNotFound_throwException() {
        $this->setExpectedException('\Resources\Exception\DoNotCatchException');
        $request = $this->_createRequest();
        $msg = $this->service->execute(\Ramsey\Uuid\Uuid::uuid4()->toString(), $request);
    }

    function test_execute_personnelNotAuthorized_throwException() {
        $request = $this->_createRequest();
        $msg = $this->service->execute($this->trackCoordinator->getId(), $request);
        $this->assertFalse($msg->getStatus());
        print_r($msg->errorMessage()->toArray());
    }

    function test_execute_invalidArguments_returnFalse() {
        $request = PersonnelWriteDataObject::asDirectorRequest('', 'bad email', '');
        $msg = $this->service->execute($this->director->getId(), $request);
        $this->assertFalse($msg->getStatus());
        $this->assertEquals(2, count($this->repository->all()));
        print_r($msg->errorMessage()->toArray());
    }

    function test_execute_duplicateEmail_returnFalse() {
        $request = $this->_createRequest($this->trackCoordinator->getEmail());
        $msg = $this->service->execute($this->director->getId(), $request);
        $this->assertFalse($msg->getStatus());
        $this->assertEquals(2, count($this->repository->all()));
        print_r($msg->errorMessage()->toArray());
    }

}
