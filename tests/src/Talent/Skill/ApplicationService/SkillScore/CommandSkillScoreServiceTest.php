<?php

namespace Tests\Talent\Skill\ApplicationService\SkillScore;

use Talent\Skill\ApplicationService\SkillScore\CommandSkillScoreService;

class CommandSkillScoreServiceTest extends \PHPUnit_Framework_TestCase {

    protected $service;
    protected $talent;
    protected $phpSkillScore;

    protected function setUp() {
        $skillScoreData = new PreparedInMemorySkillScoreData();
        $this->talent = $skillScoreData->talent();
        $this->phpSkillScore = $skillScoreData->phpSkillScore();
        $this->service = new CommandSkillScoreService($skillScoreData->repository());
    }

    function test_update_shouldUpdateSkillScoreData() {
        $msg = $this->service->update($this->talent->getId(), $this->phpSkillScore->getId(), 1);
        $this->assertTrue($msg->getStatus());
        $rdo = $this->phpSkillScore->toReadDataObject();
        $this->assertEquals(1, $rdo->getScoreValue());
    }

    function test_update_talentNotFOund_throwException() {
        $this->setExpectedException('\Resources\Exception\DoNotCatchException');
        $msg = $this->service->update(\Ramsey\Uuid\Uuid::uuid4()->toString(), $this->phpSkillScore->getId(), 1);
    }

    function test_update_skillScoreNotFOund_returnFalseRespond() {
        $msg = $this->service->update($this->talent->getId(), 123, 1);
        $this->assertFalse($msg->getStatus());
//print_r($msg->errorMessage()->toArray());
    }

    function test_update_skillScoreAlreadyRemoved_returnFalseRespond() {
        $this->phpSkillScore->remove();
        $msg = $this->service->update($this->talent->getId(), $this->phpSkillScore->getId(), 5);
        $this->assertFalse($msg->getStatus());
//print_r($msg->errorMessage()->toArray());
    }

    function test_update_invalidScoreValue_returnFalseRespond() {
        $msg = $this->service->update($this->talent->getId(), $this->phpSkillScore->getId(), 9);
        $this->assertFalse($msg->getStatus());
//print_r($msg->errorMessage()->toArray());
    }

    function test_remove_shouldREmoveSKillScoreData() {
        $this->assertEquals(2, $this->talent->getCountOfSkillScore());
        $this->assertFalse($this->phpSkillScore->getIsRemoved());
        $msg = $this->service->remove($this->talent->getId(), $this->phpSkillScore->getId());
        $this->assertTrue($msg->getStatus());
        $this->assertEquals(1, $this->talent->getCountOfSkillScore());
        $this->assertTrue($this->phpSkillScore->getIsRemoved());
    }

    function test_remove_talentNotFound_throwException() {
        $this->setExpectedException('\Resources\Exception\DoNotCatchException');
        $msg = $this->service->remove(\Ramsey\Uuid\Uuid::uuid4()->toString(), $this->phpSkillScore->getId());
    }

    function test_remove_skillScoreNotFOund_returnFalseREspond() {
        $msg = $this->service->remove($this->talent->getId(), 123);
        $this->assertFalse($msg->getStatus());
//print_r($msg->errorMessage()->toArray());
    }

    function test_remove_skillScoreAlreadyRemoved_returnFalseREspond() {
        $this->phpSkillScore->remove();
        $msg = $this->service->remove($this->talent->getId(), $this->phpSkillScore->getId());
        $this->assertFalse($msg->getStatus());
//print_r($msg->errorMessage()->toArray());
    }

}
