<?php

namespace Tests\Talent\Training\ApplicationService\Training;

use Talent\Training\ApplicationService\Training\CommandTrainingService;
use Talent\Training\DomainModel\Training\DataObject\TrainingWriteDataObject;

class CommandTrainingServiceTest extends \PHPUnit_Framework_TestCase {

    protected $service;
    protected $talent;
    protected $phpTraining;
    protected $dddTraining;

    protected function setUp() {
        $trainingData = new PreparedInMemoryTrainingData();
        $this->talent = $trainingData->talent();
        $this->phpTraining = $trainingData->phpTraining();
        $this->dddTraining = $trainingData->dddTraining();
        $this->service = new CommandTrainingService($trainingData->repository());
    }

    protected function _createRequest() {
        return TrainingWriteDataObject::request('agile', 'bdv', '2016');
    }

    function test_add_shouldAddToTalentProperty() {
        $this->assertEquals(2, $this->talent->getTrainingCount());
        $request = $this->_createRequest();
        $msg = $this->service->add($this->talent->getId(), $request);

        $this->assertTrue($msg->getStatus());
        $agile = $this->talent->lastAddedTraining();
        $rdo = $agile->toReadDataObject();
        $this->assertEquals(3, $rdo->getId());
        $this->assertEquals($request->getName(), $rdo->getName());
        $this->assertEquals($request->getOrganizer(), $rdo->getOrganizer());
        $this->assertEquals($request->getYear(), $rdo->getYear());
//print_r($agile->toReadDataObject()->toArray());
    }

    function test_add_ContainInvalidArgument_returnFalseStatus() {
        $this->assertEquals(2, $this->talent->getTrainingCount());
        $request = TrainingWriteDataObject::request('', '', '');
        $msg = $this->service->add($this->talent->getId(), $request);
        $this->assertFalse($msg->getStatus());
        $this->assertEquals(2, $this->talent->getTrainingCount());
//print_r($msg->errorMessage()->toArray());
    }

    function test_add_illogicalYear_returnFalse() {
        $request = TrainingWriteDataObject::request('agile', 'bdv', '2018');
        $msg = $this->service->add($this->talent->getId(), $request);
        $this->assertFalse($msg->getStatus());
        $this->assertEquals(2, $this->talent->getTrainingCount());
//print_r($msg->errorMessage()->toArray());
    }

    function test_add_talentNotFound_throwException() {
        $this->setExpectedException('\Resources\Exception\DoNotCatchException');
        $request = $this->_createRequest();
        $msg = $this->service->add(\Ramsey\Uuid\Uuid::uuid1()->toString(), $request);
    }

    function test_update_shouldChangeTrainingDataInTalentProperty() {
        $request = $this->_createRequest();
        $msg = $this->service->update($this->talent->getId(), $this->phpTraining->getId(), $request);

        $this->assertTrue($msg->getStatus());
        $rdo = $this->phpTraining->toReadDataObject();
        $this->assertEquals($request->getName(), $rdo->getName());
        $this->assertEquals($request->getOrganizer(), $rdo->getOrganizer());
        $this->assertEquals($request->getYear(), $rdo->getYear());
    }

    function test_update_ContainInvalidArgument_returnFalseStatus() {
        $request = TrainingWriteDataObject::request('', '', '');
        $msg = $this->service->update($this->talent->getId(), $this->phpTraining->getId(), $request);
        $this->assertFalse($msg->getStatus());
//print_r($msg->errorMessage()->toArray());
    }

    function test_update_illogicalYear_returnFalseStatus() {
        $request = TrainingWriteDataObject::request('agile', 'bdv', '2018');
        $msg = $this->service->update($this->talent->getId(), $this->phpTraining->getId(), $request);
        $this->assertFalse($msg->getStatus());
//print_r($msg->errorMessage()->toArray());
    }

    function test_update_trainingNotFOund_returnFalseStatus() {
        $this->phpTraining->remove();
        $request = $this->_createRequest();
        $msg = $this->service->update($this->talent->getId(), $this->phpTraining->getId(), $request);
        $this->assertFalse($msg->getStatus());
//print_r($msg->errorMessage()->toArray());
    }

    function test_update_talentNotFound_returnFalseStatus() {
        $this->setExpectedException('\Resources\Exception\DoNotCatchException');
        $request = $this->_createRequest();
        $msg = $this->service->update(\Ramsey\Uuid\Uuid::uuid4()->toString(), $this->phpTraining->getId(), $request);
    }

    function test_remove_shouldRemoveTrainingDataInTalentProperty() {
        $this->assertEquals(2, $this->talent->getTrainingCount());
        $this->assertFalse($this->phpTraining->getIsRemoved());
        $msg = $this->service->remove($this->talent->getId(), $this->phpTraining->getId());
        $this->assertTrue($msg->getStatus());
        $this->assertEquals(1, $this->talent->getTrainingCount());
        $this->assertTrue($this->phpTraining->getIsRemoved());
    }

    function test_remove_trainingNotFOund_returnFalseStatus() {
        $this->phpTraining->remove();
        $msg = $this->service->remove($this->talent->getId(), $this->phpTraining->getId());
        $this->assertFalse($msg->getStatus());
        print_r($msg->errorMessage()->toArray());
    }

    function test_remove_talentNotFound_returnFalseStatus() {
        $this->setExpectedException('\Resources\Exception\DoNotCatchException');
        $msg = $this->service->remove(\Ramsey\Uuid\Uuid::uuid4()->toString(), $this->phpTraining->getId());
    }

}
