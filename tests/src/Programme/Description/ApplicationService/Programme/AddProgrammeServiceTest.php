<?php

namespace Tests\Programme\Description\ApplicationService\Programme;

use Programme\Description\ApplicationService\Programme\AddProgrammeService;
use Programme\Description\DomainModel\Programme\DataObject\ProgrammeWriteDataObject;

class AddProgrammeServiceTest extends \PHPUnit_Framework_TestCase {

    protected $service;
    protected $repository;
    protected $director;
    protected $trackCoordinator;
    protected $programme2017;

    protected function setUp() {
        $personnelData = new \Tests\Personnel\ApplicationService\Personnel\PreparedInMemoryPersonnelData();
        $this->director = $personnelData->getDirector();
        $this->trackCoordinator = $personnelData->getTrackCoordinator();
        $programmeData = new PreparedInMemoryProgrammeData();
        $this->programme2017 = $programmeData->getProgramme2017();
        $this->repository = $programmeData->getRepository();
        $this->service = new AddProgrammeService($this->repository, $personnelData->rdoRepository());
    }

    protected function _createRequest($name = 'programme 2019', $registrationEndDate = '2019-01-31', $operationEndDate = '2019-12-31') {
        return ProgrammeWriteDataObject::request($name, '2019-01-01', $registrationEndDate, '2019-02-01', $operationEndDate);
    }

    function test_execute_returnTrueResponseAndAddDataToRepository() {
        $this->assertEquals(2, $this->repository->getCountOfProgramme());
        $request = $this->_createRequest();
        $msg = $this->service->execute($this->director->getId(), $request);

        $this->assertTrue($msg->getStatus());
        $this->assertEquals(3, $this->repository->getCountOfProgramme());
        $rdo = $this->repository->lastInsertedProgramme()->toReadDataObject();
        $this->assertEquals($request->getName(), $rdo->getName());
        $this->assertEquals($request->getRegistrationStartDate(), $rdo->getRegistrationStartDate());
        $this->assertEquals($request->getRegistrationEndDate(), $rdo->getRegistrationEndDate());
        $this->assertEquals($request->getOperationStartDate(), $rdo->getOperationStartDate());
        $this->assertEquals($request->getOperationEndDate(), $rdo->getOperationEndDate());
//print_r($rdo->toArray());
    }

    function test_execute_personnelNotFound_throwException() {
        $this->setExpectedException('\Resources\Exception\DoNotCatchException');
        $request = $this->_createRequest();
        $msg = $this->service->execute(\Ramsey\Uuid\Uuid::uuid4()->toString(), $request);
    }

    function test_execute_personnelNotAuthorized_returnFalseResponse() {
        $request = $this->_createRequest();
        $msg = $this->service->execute($this->trackCoordinator->getId(), $request);
        $this->assertFalse($msg->getStatus());
//print_r($msg->errorMessage()->toArray());
    }

    function test_execute_requestContainInvalidData_returnFalseResponse() {
        $request = ProgrammeWriteDataObject::request('', 'asdfa', 'sdfasd', 'sdfasd', 'sdfasdf');
        $msg = $this->service->execute($this->director->getId(), $request);
        $this->assertFalse($msg->getStatus());
//print_r($msg->errorMessage()->toArray());
    }

    function test_execute_duplicateProgrammeName_returnFalseResponse() {
        $request = $this->_createRequest($this->programme2017->getName());
        $msg = $this->service->execute($this->director->getId(), $request);
        $this->assertFalse($msg->getStatus());
//print_r($msg->errorMessage()->toArray());
    }

    function test_execute_registrationEndDateBeforeStartDate_returnFalseResponse() {
        $request = $this->_createRequest('programme 2019', '2018-12-12');
        $msg = $this->service->execute($this->director->getId(), $request);
        $this->assertFalse($msg->getStatus());
//print_r($msg->errorMessage()->toArray());
    }

    function test_execute_OperationEndDateBeforeStartDate_returnFalseResponse() {
        $request = $this->_createRequest('programme 2019', '2019-01-31', '2018-12-12');
        $msg = $this->service->execute($this->director->getId(), $request);
        $this->assertFalse($msg->getStatus());
//print_r($msg->errorMessage()->toArray());
    }

}
