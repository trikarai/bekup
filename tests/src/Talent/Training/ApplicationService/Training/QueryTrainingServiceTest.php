<?php

namespace Tests\Talent\Training\ApplicationService\Training;

use Talent\Training\ApplicationService\Training\QueryTrainingService;

class QueryTrainingServiceTest extends \PHPUnit_Framework_TestCase {

    protected $service;
    protected $talent;
    protected $phpTraining;
    protected $dddTraining;

    protected function setUp() {
        $trainingData = new PreparedInMemoryTrainingData();
        $this->talent = $trainingData->talent();
        $this->phpTraining = $trainingData->phpTraining();
        $this->dddTraining = $trainingData->dddTraining();
        $this->service = new QueryTrainingService($trainingData->repository());
    }

    function test_showById_shouldReturnMessageObjectContainTrainingRDO() {
        $msg = $this->service->showById($this->talent->getId(), $this->phpTraining->getId());
        $this->assertTrue($msg->getStatus());
        $this->assertInstanceOf('\Talent\Training\DomainModel\Training\DataObject\TrainingReadDataObject', $msg->firstReadDataObject());
//print_r($msg->firstReadDataObject()->toArray());
    }

    function test_showById_trainingNotFOund_returnFalseMO() {
        $msg = $this->service->showById($this->talent->getId(), 123);
        $this->assertFalse($msg->getStatus());
//print_r($msg->errorMessage()->toArray());
    }

    function test_showById_trainingAlreadyRemoved_returnFalseMO() {
        $this->phpTraining->remove();
        $msg = $this->service->showById($this->talent->getId(), $this->phpTraining->getId());
        $this->assertFalse($msg->getStatus());
//print_r($msg->errorMessage()->toArray());
    }

    function test_showById_talentNotFound_throwException() {
        $this->setExpectedException('\Resources\Exception\DoNotCatchException');
        $msg = $this->service->showById(\Ramsey\Uuid\Uuid::uuid4()->toString(), $this->phpTraining->getId());
    }

    function test_showAll_shouldReturnMessageObjectContainAllTrainingRDO() {
        $msg = $this->service->showAll($this->talent->getId());
        $this->assertTrue($msg->getStatus());
        $this->assertEquals(2, count($msg->arrayOfReadDataObject()));
        foreach($msg->arrayOfReadDataObject() as $rdo){
            $this->assertInstanceOf('\Talent\Training\DomainModel\Training\DataObject\TrainingReadDataObject', $rdo);
print_r($rdo->toArray());
        }
    }

    function test_showAll_emptyTraining_returnFalseMO() {
        $this->phpTraining->remove();
        $this->dddTraining->remove();
        $msg = $this->service->showAll($this->talent->getId());
        $this->assertFalse($msg->getStatus());
print_r($msg->errorMessage()->toArray());
    }

    function test_showAll_talentNotFOund_throwException() {
        $this->setExpectedException('\Resources\Exception\DoNotCatchException');
        $msg = $this->service->showAll(\Ramsey\Uuid\Uuid::uuid4()->toString());
    }
}
