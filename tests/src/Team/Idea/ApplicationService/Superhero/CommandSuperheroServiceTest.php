<?php

namespace Tests\Team\Idea\ApplicationService\Superhero;

use Team\Idea\ApplicationService\Superhero\CommandSuperheroService;
use Team\Idea\DomainModel\Superhero\DataObject\SuperheroWriteDataObject;

class CommandSuperheroServiceTest extends \PHPUnit_Framework_TestCase {

    protected $service;
    protected $talent;
    protected $batman;
    protected $goku;

    protected function setUp() {
        $talentId = \Ramsey\Uuid\Uuid::uuid4()->toString();
        $preparedData = new PreparedInMemoryTalentData($talentId);
        $this->talent = $preparedData->talent();
        $this->batman = $preparedData->batman();
        $this->goku = $preparedData->goku();
        $this->service = new CommandSuperheroService($preparedData->repository());
    }

    protected function _createRequest() {
        return SuperheroWriteDataObject::request('apheiron', 'calming the earth', 'sloth', 'sleep', 'bed');
    }

    function test_add_shouldAddSuperheroInPropertyAndReturnTrueMessageObject() {
        $this->assertEquals(2, count($this->talent->getArrayOfActiveSuperhero()));

        $request = $this->_createRequest();
        $msg = $this->service->add($this->talent->getId(), $request);

        $this->assertTrue($msg->getStatus());
        $apheironRdo = $this->talent->getLastInsertedSuperhero()->toReadDataObject();
        $this->assertEquals($apheironRdo->getId(), 3);
        $this->assertEquals($apheironRdo->getName(), $request->getName());
        $this->assertEquals($apheironRdo->getMainDuty(), $request->getMainDuty());
        $this->assertEquals($apheironRdo->getSpecialAbility(), $request->getSpecialAbility());
        $this->assertEquals($apheironRdo->getDailyActivity(), $request->getDailyActivity());
        $this->assertEquals($apheironRdo->getAlternativeTechnology(), $request->getAlternativeTechnology());
    }

    function test_add_talentNotFound_throwException() {
        $this->setExpectedException('\Resources\Exception\DoNotCatchException');
        $request = $this->_createRequest();
        $this->service->add(\Ramsey\Uuid\Uuid::uuid4()->toString(), $request);
    }

    function test_add_invalidArgument_returnFalseMessageObject() {
        $request = SuperheroWriteDataObject::request('', '', '', '', '');
        $messageObject = $this->service->add($this->talent->getId(), $request);

        $this->assertFalse($messageObject->getStatus());
        $this->assertEquals(5, count($messageObject->errorMessage()->getDetails()));
//print_r($messageObject->errorMessage()->toArray());
    }

    function test_update_shouldChangeDataInRepositoryAndReturnTrueMessageObject() {
        $request = $this->_createRequest();
        $message = $this->service->update($this->talent->getId(), $this->goku->getId(), $request);

        $this->assertTrue($message->getStatus());
        $this->assertEquals(2, $this->goku->getId());
        $rdo = $this->goku->toReadDataObject();
        $this->assertEquals($request->getName(), $rdo->getName());
        $this->assertEquals($request->getAlternativeTechnology(), $rdo->getAlternativeTechnology());
        $this->assertEquals($request->getDailyActivity(), $rdo->getDailyActivity());
        $this->assertEquals($request->getMainDuty(), $rdo->getMainDuty());
        $this->assertEquals($request->getSpecialAbility(), $rdo->getSpecialAbility());
    }

    function test_update_talentNotFOund_throwDoNotCatchException() {
        $this->setExpectedException('\Resources\Exception\DoNotCatchException');
        $request = $this->_createRequest();
        $this->service->update(\Ramsey\Uuid\Uuid::uuid4()->toString(), $this->goku->getId(), $request);
    }

    function test_update_superheroNotFound_throwDoNotCatchException() {
        $request = $this->_createRequest();
        $msg = $this->service->update($this->talent->getId(), 5, $request);
        $this->assertFalse($msg->getStatus());
//print_r($msg->errorMessage()->toArray());
    }

    function test_update_InvalidArgument_returnFalseMessageObject() {
        $request = SuperheroWriteDataObject::request('', '', '', '', '');
        $msg = $this->service->update($this->talent->getId(), $this->goku->getId(), $request);
        $this->assertFalse($msg->getStatus());
//print_r($msg->errorMessage()->toArray());
    }

    function test_remove_shouldREmoveSuperheroAndREturnTrueMessageObject() {
        $this->assertFalse($this->goku->getIsRemoved());
        $msg = $this->service->remove($this->talent->getId(), $this->goku->getId());
        $this->assertTrue($msg->getStatus());
        $this->assertTrue($this->goku->getIsRemoved());
    }

    function test_remove_talentNotFound_throwDoNotCatchException() {
        $this->setExpectedException('\Resources\Exception\DoNotCatchException');
        $this->service->remove(\Ramsey\Uuid\Uuid::uuid4()->toString(), $this->goku->getId());
    }

    function test_remove_superheroNotFound_throwDoNotCatchException() {
        $msg = $this->service->remove($this->talent->getId(), 7);
        $this->assertFalse($msg->getStatus());
        print_r($msg->errorMessage()->toArray());
    }

}
