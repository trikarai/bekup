<?php

namespace Tests\Talent\Skill\ApplicationService\SkillScore;

use Talent\Skill\ApplicationService\SkillScore\AddSkillScoreService;

class AddSkillScoreServiceTest extends \PHPUnit_Framework_TestCase {

    protected $service;
    protected $talent;
    protected $phpSkill;
    protected $cssSkill;
    protected $phpSkillScore;

    protected function setUp() {
        $skillScoreData = new PreparedInMemorySkillScoreData();
        $this->talent = $skillScoreData->talent();
        $this->phpSkillScore = $skillScoreData->phpSkillScore();
        $this->phpSkill = $skillScoreData->skillData()->phpSkill();
        $this->cssSkill = $skillScoreData->skillData()->cssSkill();
        $this->service = new AddSkillScoreService($skillScoreData->repository(), $skillScoreData->skillData()->rdoRepository());
    }

    function test_execute_shouldAddSkillScoreToTalentProperty() {
        $this->assertEquals(2, $this->talent->getCountOfSkillScore());
        $msg = $this->service->execute($this->talent->getId(), $this->cssSkill->getId(), 5);
        $this->assertTrue($msg->getStatus());
        $this->assertEquals(3, $this->talent->getCountOfSkillScore());
        $rdo = $this->talent->lastAddedSkillScore()->toReadDataObject();
        $this->assertEquals(5, $rdo->getScoreValue());
        $this->assertEquals($this->cssSkill->toReadDataObject(), $rdo->skillRDO());
//print_r($css->toReadDataObject()->toArray());
    }
    function test_execute_talentNotFOund_throwExcpetion() {
        $this->setExpectedException('\Resources\Exception\DoNotCatchException');
        $this->service->execute(\Ramsey\Uuid\Uuid::uuid4()->toString(), $this->cssSkill->getId(), 5);
    }

    function test_execute_invalidScore_returnFalseResponse() {
        $msg = $this->service->execute($this->talent->getId(), $this->cssSkill->getId(), 7);
        $this->assertFalse($msg->getStatus());
//print_r($msg->errorMessage()->toArray());
    }

    function test_execute_skillReferenceNotFOund_returnFalseResponse() {
        $this->cssSkill->remove();
        $msg = $this->service->execute($this->talent->getId(), $this->cssSkill->getId(), 5);
        $this->assertFalse($msg->getStatus());
//print_r($msg->errorMessage()->toArray());
    }

    function test_execute_skillAlreadyUsed_returnFalseResponse() {
        $this->cssSkill->remove();
        $msg = $this->service->execute($this->talent->getId(), $this->phpSkill->getId(), 5);
        $this->assertFalse($msg->getStatus());
//print_r($msg->errorMessage()->toArray());
    }
}
