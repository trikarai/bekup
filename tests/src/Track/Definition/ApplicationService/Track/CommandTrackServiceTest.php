<?php

namespace Tests\Track\Definition\ApplicationService\Track;

use Track\Definition\ApplicationService\Track\CommandTrackService;
use Track\Definition\DomainModel\Track\DataObject\TrackWriteDataObject;

class CommandTrackServiceTest extends \PHPUnit_Framework_TestCase {

    protected $service;
    protected $bisnis;
    protected $teknis;
    protected $repository;
    protected $personnelFinder;
    protected $director;
    protected $trackCoordinator;

    protected function setUp() {
        $trackData = new PreparedInMemoryTrackData();
        $personnelData = new \Tests\Personnel\ApplicationService\Personnel\PreparedInMemoryPersonnelData();

        $this->repository = $trackData->repository();
        $this->teknis = $trackData->teknis();
        $this->bisnis = $trackData->bisnis();

        $this->director = $personnelData->getDirector();
        $this->trackCoordinator = $personnelData->getTrackCoordinator();

        $this->service = new CommandTrackService($this->repository, $personnelData->rdoRepository());
    }

    protected function _createRequest($name = 'design') {
        return TrackWriteDataObject::request($name, 'track description');
    }

    function test_add_shouldAddToRepository() {
        $this->assertEquals(2, count($this->repository->all()));

        $request = $this->_createRequest();
        $msg = $this->service->add($this->director->getId(), $request);

        $this->assertTrue($msg->getStatus());
        $this->assertEquals(3, count($this->repository->all()));
        $lastTrack = $this->repository->getLastTrack();
        $rdo = $lastTrack->toReadDataObject();
        $this->assertEquals($request->getName(), $rdo->getName());
        $this->assertEquals($request->getDescription(), $rdo->getDescription());
    }

    function test_add_duplicateNameWithExisting_returnFalseResponse() {
        $request = $this->_createRequest($this->bisnis->getName());
        $msg = $this->service->add($this->director->getId(), $request);
        $this->assertFalse($msg->getStatus());
//print_r($msg->errorMessage()->toArray());
    }

    function test_add_personnelNotFOund_throwExcpetion() {
        $this->setExpectedException('\Resources\Exception\DoNotCatchException');
        $request = $this->_createRequest();
        $msg = $this->service->add(\Ramsey\Uuid\Uuid::uuid4()->toString(), $request);
    }

    function test_add_unauthorizedPersonnel_throwException() {
        $request = $this->_createRequest();
        $msg = $this->service->add($this->trackCoordinator->getId(), $request);
        $this->assertFalse($msg->getStatus());
//print_r($msg->errorMessage()->toArray());
    }

    function test_add_containInvalidArgument_returnFalseStatus() {
        $request = TrackWriteDataObject::request('', '');
        $msg = $this->service->add($this->director->getId(), $request);
        $this->assertFalse($msg->getStatus());
//print_r($msg->errorMessage()->toArray());
    }

    function test_update_shouldChangeDataInRepository() {
        $request = $this->_createRequest();
        $this->service->update($this->director->getId(), $this->teknis->getId(), $request);
        $rdo = $this->teknis->toReadDataObject();
        $this->assertEquals($request->getName(), $rdo->getName());
        $this->assertEquals($request->getDescription(), $rdo->getDescription());
    }

    function test_update_newNameConflictWithExisting_throwException() {
        $request = $this->_createRequest($this->bisnis->getName());
        $msg = $this->service->update($this->director->getId(), $this->teknis->getId(), $request);
        $this->assertFalse($msg->getStatus());
//print_r($msg->errorMessage()->toArray());
    }

    function test_update_sameNameAsBefore_updateDeskription() {
        $request = $this->_createRequest($this->teknis->getName());
        $msg = $this->service->update($this->director->getId(), $this->teknis->getId(), $request);
        $this->assertTrue($msg->getStatus());
        $rdo = $this->teknis->toReadDataObject();
        $this->assertEquals($request->getDescription(), $rdo->getDescription());
    }

    function test_update_trackNotFOund_throwException() {
        $request = $this->_createRequest();
        $msg = $this->service->update($this->director->getId(), \Ramsey\Uuid\Uuid::uuid4()->toString(), $request);
        $this->assertFalse($msg->getStatus());
//print_r($msg->errorMessage()->toArray());
    }

    function test_update_personnelNotFOund_throwException() {
        $this->setExpectedException('\Resources\Exception\DoNotCatchException');
        $request = $this->_createRequest();
        $this->service->update(\Ramsey\Uuid\Uuid::uuid4()->toString(), $this->teknis->getId(), $request);
    }

    function test_update_unauthorizedPersonnel_returnFalseResponse() {
        $request = $this->_createRequest();
        $msg = $this->service->update($this->trackCoordinator->getId(), $this->teknis->getId(), $request);
        $this->assertFalse($msg->getStatus());
//print_r($msg->errorMessage()->toArray());
    }

    function test_update_containInvalidArgument_returnFalseStatus() {
        $request = TrackWriteDataObject::request('', '');
        $msg = $this->service->update($this->director->getId(), $this->bisnis->getId(), $request);
        $this->assertFalse($msg->getStatus());
//print_r($msg->errorMessage()->toArray());
    }

    function test_remove_shouldRemoveDataFromREpository() {
        $this->assertEquals(2, count($this->repository->all()));
        $this->assertFalse($this->teknis->getIsRemoved());
        $msg = $this->service->remove($this->director->getId(), $this->teknis->getId());
        $this->assertTrue($msg->getStatus());
        $this->assertEquals(1, count($this->repository->all()));
        $this->assertTrue($this->teknis->getIsRemoved());
    }

    function test_remove_trackNotFOund_returnFalseResponse() {
        $msg = $this->service->remove($this->director->getId(), \Ramsey\Uuid\Uuid::uuid4()->toString());
        $this->assertFalse($msg->getStatus());
        print_r($msg->errorMessage()->toArray());
    }

    function test_remove_personnelNotFound_throwException() {
        $this->setExpectedException('\Resources\Exception\DoNotCatchException');
        $this->service->remove(\Ramsey\Uuid\Uuid::uuid4()->toString(), $this->teknis->getId());
    }

    function test_remove_unauthorizedPersonnel_returnFalseResponse() {
        $msg = $this->service->remove($this->trackCoordinator->getId(), $this->teknis->getId());
        $this->assertFalse($msg->getStatus());
        print_r($msg->errorMessage()->toArray());
    }

}
