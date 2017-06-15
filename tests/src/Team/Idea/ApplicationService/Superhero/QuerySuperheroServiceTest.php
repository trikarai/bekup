<?php

namespace Tests\Team\Idea\ApplicationService\Superhero;

use Team\Idea\ApplicationService\Superhero\QuerySuperheroService;

class QuerySuperheroServiceTest extends \PHPUnit_Framework_TestCase {

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
        $this->service = new QuerySuperheroService($preparedData->repository());
    }

    function test_showAll_shouldReturmMessageObjectContainAllRDOs() {
        $msg = $this->service->showAll($this->talent->getId());
        $this->assertTrue($msg->getStatus());
        foreach($msg->arrayOfReadDataObject() as $rdo){
            $this->assertInstanceOf('\Team\Idea\DomainModel\Superhero\DataObject\SuperheroReadDataObject', $rdo);
print_r($rdo->toArray());
        }
    }

    function test_showAll_talentNotFound_throwException() {
        $this->setExpectedException('\Resources\Exception\DoNotCatchException');
        $this->service->showAll(\Ramsey\Uuid\Uuid::uuid4()->toString());
    }

    function test_showAll_noActiveSuperheroFound_returnFalseResponse() {
        $this->batman->remove();
        $this->goku->remove();

        $msg = $this->service->showAll($this->talent->getId());
        $this->assertFalse($msg->getStatus());
print_r($msg->errorMessage()->toArray());
    }

    function test_showById_returnMessageObjectWithExactlyOneRDO() {
        $msg = $this->service->showById($this->talent->getId(), $this->goku->getId());
        $this->assertTrue($msg->getStatus());
        $this->assertInstanceOf('\Team\Idea\DomainModel\Superhero\DataObject\SuperheroReadDataObject', $msg->firstReadDataObject());
print_r($msg->firstReadDataObject()->toArray());
    }

    function test_showById_talentNotFound_throwException() {
        $this->setExpectedException('\Resources\Exception\DoNotCatchException');
        $msg = $this->service->showById(\Ramsey\Uuid\Uuid::uuid4()->toString(), $this->goku->getId());
    }

    function test_showById_superheroNotFound_throwException() {
        $msg = $this->service->showById($this->talent->getId(), 5);
        $this->assertFalse($msg->getStatus());
print_r($msg->errorMessage()->toArray());
    }

}
