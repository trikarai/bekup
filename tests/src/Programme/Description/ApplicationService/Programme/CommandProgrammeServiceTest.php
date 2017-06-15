<?php

namespace Tests\Programme\Description\ApplicationService\Programme;

use Programme\Description\ApplicationService\Programme\CommandProgrammeService;
use Tests\Personnel\ApplicationService\Personnel\PreparedInMemoryPersonnelData;
use Programme\Description\DomainModel\Programme\DataObject\ProgrammeWriteDataObject;

class CommandProgrammeServiceTest extends \PHPUnit_Framework_TestCase {

    protected $service;
    protected $programme2017;
    protected $programme2018;
    protected $repository;
    protected $director;
    protected $trackCoordinator;

    protected function setUp() {
        $personnelData = new PreparedInMemoryPersonnelData();
        $this->director = $personnelData->getDirector();
        $this->trackCoordinator = $personnelData->getTrackCoordinator();

        $programmeData = new PreparedInMemoryProgrammeData();
        $this->programme2017 = $programmeData->getProgramme2017();
        $this->programme2018 = $programmeData->getProgramme2018();
        $this->repository = $programmeData->getRepository();
        $this->service = new CommandProgrammeService($this->repository, $personnelData->rdoRepository());
    }

    protected function _generateRequest($name = 'new name', $registrationEndDate = '2019-01-31', $operationEndDate = '2019-12-21') {
        return ProgrammeWriteDataObject::request($name, '2019-01-01', $registrationEndDate, '2019-02-01', $operationEndDate);
    }

    function test_update_shouldChangeDataInRepositoryAndReturnTrueResponse() {
        $request = $this->_generateRequest();
        $msg = $this->service->update($this->director->getId(), $this->programme2017->getId(), $request);
        $this->assertTrue($msg->getStatus());
        $rdo = $this->programme2017->toReadDataObject();
        $this->assertEquals($request->getName(), $rdo->getName());
        $this->assertEquals($request->getRegistrationStartDate(), $rdo->getRegistrationStartDate());
        $this->assertEquals($request->getRegistrationEndDate(), $rdo->getRegistrationEndDate());
        $this->assertEquals($request->getOperationStartDate(), $rdo->getOperationStartDate());
        $this->assertEquals($request->getOperationEndDate(), $rdo->getOperationEndDate());
    }

    function test_update_personnelNotFound_throwException() {
        $this->setExpectedException('\Resources\Exception\DoNotCatchException');
        $request = $this->_generateRequest();
        $msg = $this->service->update(\Ramsey\Uuid\Uuid::uuid4()->toString(), $this->programme2017->getId(), $request);
    }

    function test_update_personnelNotAuthorized_returnFalseResponse() {
        $request = $this->_generateRequest();
        $msg = $this->service->update($this->trackCoordinator->getId(), $this->programme2017->getId(), $request);
        $this->assertFalse($msg->getStatus());
//print_r($msg->errorMessage()->toArray());
    }

    function test_update_containInvalidArgument_returnFalseResponse() {
        $request = ProgrammeWriteDataObject::request('', 'adsfasd', 'sdfasd', 'asdfasd', 'asdfasd');
        $msg = $this->service->update($this->director->getId(), $this->programme2017->getId(), $request);
        $this->assertFalse($msg->getStatus());
//print_r($msg->errorMessage()->toArray());
    }

    function test_update_duplicateName_returnFalseResponse() {
        $request = $this->_generateRequest($this->programme2018->getName());
        $msg = $this->service->update($this->director->getId(), $this->programme2017->getId(), $request);
        $this->assertFalse($msg->getStatus());
//print_r($msg->errorMessage()->toArray());
    }

    function test_update_sameNameAsBefore_returnTrueResponse() {
        $request = $this->_generateRequest($this->programme2017->getName());
        $msg = $this->service->update($this->director->getId(), $this->programme2017->getId(), $request);
        $this->assertTrue($msg->getStatus());
    }

    function test_update_RegistrationEndDateBeforeStartDate_returnFalseResponse() {
        $request = $this->_generateRequest('new name', '2018-04-04');
        $msg = $this->service->update($this->director->getId(), $this->programme2017->getId(), $request);
        $this->assertFalse($msg->getStatus());
//print_r($msg->errorMessage()->toArray());
    }

    function test_update_OperationEndDateBeforeStartDate_returnFalseResponse() {
        $request = $this->_generateRequest('new name', '2019-01-31', '2018-12-12');
        $msg = $this->service->update($this->director->getId(), $this->programme2017->getId(), $request);
        $this->assertFalse($msg->getStatus());
//print_r($msg->errorMessage()->toArray());
    }

    function test_update_programmeNotFound_returnFalseResponse() {
        $request = $this->_generateRequest();
        $msg = $this->service->update($this->director->getId(), \Ramsey\Uuid\Uuid::uuid4()->toString(), $request);
        $this->assertFalse($msg->getStatus());
//print_r($msg->errorMessage()->toArray());
    }

    function test_remove_shouldRemoveDataFromRepositoryAndReturnTrueResponse() {
        $this->assertEquals(2, $this->repository->getCountOfProgramme());
        $this->assertFalse($this->programme2017->getIsRemoved());
        $msg = $this->service->remove($this->director->getId(), $this->programme2017->getId());
        $this->assertTrue($msg->getStatus());
        $this->assertEquals(1, $this->repository->getCountOfProgramme());
        $this->assertTrue($this->programme2017->getIsRemoved());
    }

    function test_remove_personnelNotFound_throwException() {
        $this->setExpectedException('\Resources\Exception\DoNotCatchException');
        $this->service->remove(\Ramsey\Uuid\Uuid::uuid4()->toString(), $this->programme2017->getId());
    }

    function test_remove_personnelNotAuthorized_returnFalseResponse() {
        $msg = $this->service->remove($this->trackCoordinator->getId(), $this->programme2017->getId());
        $this->assertFalse($msg->getStatus());
//print_r($msg->errorMessage()->toArray());
    }

    function test_remove_programmeNotFound_returnFalseResponse() {
        $msg = $this->service->remove($this->director->getId(), \Ramsey\Uuid\Uuid::uuid4()->toString());
        $this->assertFalse($msg->getStatus());
//print_r($msg->errorMessage()->toArray());
    }

}
