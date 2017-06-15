<?php

namespace Tests\Talent\Skill\ApplicationService\SkillScore;

use Talent\Skill\ApplicationService\SkillScore\QuerySkillScoreService;

class QuerySkillScoreServiceTest extends \PHPUnit_Framework_TestCase {

    protected $service;
    protected $talent;
    protected $phpSkillScore;
    protected $leanSkillScore;

    protected function setUp() {
        $skillScoreData = new PreparedInMemorySkillScoreData();
        $this->talent = $skillScoreData->talent();
        $this->phpSkillScore = $skillScoreData->phpSkillScore();
        $this->leanSkillScore = $skillScoreData->leanSkillScore();
        $this->service = new QuerySkillScoreService($skillScoreData->repository());
    }

    function test_showById_shouldReturnMessageContainSkillScoreRDO() {
        $msg = $this->service->showByid($this->talent->getId(), $this->phpSkillScore->getId());
        $this->assertTrue($msg->getStatus());
        $this->assertInstanceOf('\Talent\Skill\DomainModel\SkillScore\DataObject\SkillScoreReadDataObject', $msg->firstReadDataObject());
//print_r($msg->firstReadDataObject()->toArray());
    }

    function test_showById_talentNotFound_throwExcpetion() {
        $this->setExpectedException('\Resources\Exception\DoNotCatchException');
        $msg = $this->service->showByid(\Ramsey\Uuid\Uuid::uuid4()->toString(), $this->phpSkillScore->getId());
    }

    function test_showById_skillScoreNotFOund_returnFalseREsponse() {
        $msg = $this->service->showByid($this->talent->getId(), 123);
        $this->assertFalse($msg->getStatus());
//print_r($msg->errorMessage()->toArray());
    }

    function test_showById_skillScoreAlreadyREmoved_returnFalseREsponse() {
        $this->phpSkillScore->remove();
        $msg = $this->service->showByid($this->talent->getId(), $this->phpSkillScore->getId());
        $this->assertFalse($msg->getStatus());
//print_r($msg->errorMessage()->toArray());
    }

    function test_showAll_shouldREturnMessageContainAllSkillScoreRDO() {
        $msg = $this->service->showAll($this->talent->getId());
        $this->assertTrue($msg->getStatus());
        $this->assertEquals(2, count($msg->arrayOfReadDataObject()));
        foreach ($msg->arrayOfReadDataObject() as $rdo) {
            $this->assertInstanceOf('\Talent\Skill\DomainModel\SkillScore\DataObject\SkillScoreReadDataObject', $rdo);
//print_r($rdo->toArray());
        }
    }

    function test_showAll_talentNotFOund_throwException() {
        $this->setExpectedException('\Resources\Exception\DoNotCatchException');
        $msg = $this->service->showAll(\Ramsey\Uuid\Uuid::uuid4()->toString());
    }

    function test_showAll_notSkillScoreFOund_returnFalseResponse() {
        $this->phpSkillScore->remove();
        $this->leanSkillScore->remove();
        $msg = $this->service->showAll($this->talent->getId());
        $this->assertFalse($msg->getStatus());
//print_r($msg->errorMessage()->toArray());
    }

}
