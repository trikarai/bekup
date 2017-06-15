<?php

namespace Tests\Talent\Training\DomainModel\Talent;

use Talent\Training\DomainModel\Talent\Talent;
use Talent\Training\DomainModel\Training\Training;
use Talent\Training\DomainModel\Training\DataObject\TrainingWriteDataObject;

class TalentTest extends \PHPUnit_Framework_TestCase {

    protected $talent;

    /** @var Training */
    protected $phpTraining;

    /** @var Training */
    protected $dddTraining;

    protected function setUp() {
        $this->talent = new TestableTalent();
        $this->_setPhpTraining();
        $this->_setDddTraining();
    }

    protected function _setPhpTraining() {
        $id = 1;
        $request = TrainingWriteDataObject::request('php', 'php.net', '2010');
        $this->phpTraining = new Training($id, $request, $this->talent);
        $this->talent->setManually($this->phpTraining);
    }

    protected function _setDddTraining() {
        $id = 2;
        $request = TrainingWriteDataObject::request('ddd', 'erich evans', '2015');
        $this->dddTraining = new Training($id, $request, $this->talent);
        $this->talent->setManually($this->dddTraining);
    }

    protected function _createRequest($year = '2016') {
        return TrainingWriteDataObject::request('agile', 'bdv', $year);
    }

    function test_add_shouldAddToTalentProperty() {
        $this->assertEquals(2, $this->talent->getTrainingCount());
        $request = $this->_createRequest();
        $msg = $this->talent->addTraining($request);

        $this->assertTrue($msg);
        $this->assertEquals(3, $this->talent->getTrainingCount());
        $agile = $this->talent->lastAddedTraining();
        $rdo = $agile->toReadDataObject();
        $this->assertEquals(3, $agile->getId());
        $this->assertEquals($request->getName(), $rdo->getName());
        $this->assertEquals($request->getOrganizer(), $rdo->getOrganizer());
        $this->assertEquals($request->getYear(), $rdo->getYear());
    }

    function test_add_trainingYearInFuture_returnErrorMessage() {
        $request = $this->_createRequest(2020);
        $msg = $this->talent->addTraining($request);
        $this->assertInstanceOf('\Resources\ErrorMessage', $msg);
        print_r($msg->toArray());
    }

    function test_update_shouldChangeExistingData() {
        $request = $this->_createRequest();
        $msg = $this->talent->updateTraining($this->phpTraining->getId(), $request);

        $rdo = $this->phpTraining->toReadDataObject();
        $this->assertEquals($request->getName(), $rdo->getName());
        $this->assertEquals($request->getOrganizer(), $rdo->getOrganizer());
        $this->assertEquals($request->getYear(), $rdo->getYear());
    }

    function test_update_trainingAlreadyRemoved_returnfalseStatus() {
        $this->phpTraining->remove();
        $request = $this->_createRequest();
        $msg = $this->talent->updateTraining($this->phpTraining->getId(), $request);
        $this->assertInstanceOf('\Resources\ErrorMessage', $msg);
//print_r($msg->toArray());
    }

    function test_update_trainingNotFound_returnfalseStatus() {
        $request = $this->_createRequest();
        $msg = $this->talent->updateTraining(123, $request);
        $this->assertInstanceOf('\Resources\ErrorMessage', $msg);
//print_r($msg->toArray());
    }

    function test_update_trainingyearInFuture_returnErrorMessage() {
        $request = $this->_createRequest(2020);
        $msg = $this->talent->updateTraining($this->phpTraining->getId(), $request);
        $this->assertInstanceOf('\Resources\ErrorMessage', $msg);
        print_r($msg->toArray());
    }

    function test_remove_shouldRemoveTrainingFromProperty() {
        $this->assertEquals(2, $this->talent->getTrainingCount());
        $this->assertFalse($this->phpTraining->getIsRemoved());
        $msg = $this->talent->removeTraining($this->phpTraining->getId());
        $this->assertTrue($msg);
        $this->assertEquals(1, $this->talent->getTrainingCount());
        $this->assertTrue($this->phpTraining->getIsRemoved());
    }

    function test_remove_trainingAlreadyRemoved_returnFalse() {
        $this->phpTraining->remove();
        $this->assertEquals(1, $this->talent->getTrainingCount());
        $msg = $this->talent->removeTraining($this->phpTraining->getId());
        $this->assertEquals(1, $this->talent->getTrainingCount());
        $this->assertInstanceOf('\Resources\ErrorMessage', $msg);
//print_r($msg->toArray());
    }

    function test_remove_trainingNotFound_returnFalse() {
        $this->assertEquals(2, $this->talent->getTrainingCount());
        $msg = $this->talent->removeTraining(123);
        $this->assertEquals(2, $this->talent->getTrainingCount());
        $this->assertInstanceOf('\Resources\ErrorMessage', $msg);
//print_r($msg->toArray());
    }

    function test_aTrainingReadDataObject_shouldReturnTrainingRDO() {
        $trainingRDO = $this->talent->aTrainingReadDataObjectOfId($this->phpTraining->getId());
        $this->assertInstanceOf('\Talent\Training\DomainModel\Training\DataObject\TrainingReadDataObject', $trainingRDO);
//print_r($trainingRDO->toArray());
    }

    function test_aTrainingReadDataObject_trainingAlreadyRemoved_returnNull() {
        $this->phpTraining->remove();
        $this->assertNull($this->talent->aTrainingReadDataObjectOfId($this->phpTraining->getId()));
    }

    function test_aTrainingReadDataObject_trainingNotFOund_returnNull() {
        $this->assertNull($this->talent->aTrainingReadDataObjectOfId(123));
    }

    function test_allTrainingReadDataObject_shouldReturnArrayOfTrainingRDOs() {
        $trainingRDOs = $this->talent->allTrainingReadDataObject();
        $this->assertEquals(2, count($trainingRDOs));
        foreach ($trainingRDOs as $rdo) {
            $this->assertInstanceOf('\Talent\Training\DomainModel\Training\DataObject\TrainingReadDataObject', $rdo);
//print_r($rdo->toArray());
        }
    }

    function test_allTrainingReadDataObject_noDataFound_shouldReturnEmptyArray() {
        $this->phpTraining->remove();
        $this->dddTraining->remove();
        $this->assertEmpty($this->talent->allTrainingReadDataObject());
    }

}

use Doctrine\Common\Collections\Criteria;

class TestableTalent extends Talent {

    public function __construct() {
        parent::__construct();
    }

    function setManually(Training $training) {
        $this->trainings->set($training->getId(), $training);
    }

    /**
     * @return Training
     */
    function lastAddedTraining() {
        return $this->trainings->last();
    }

    function getTrainingCount() {
        $criteria = Criteria::create()
                ->where(Criteria::expr()->eq('isRemoved', false));
        return $this->trainings->matching($criteria)->count();
    }

}
