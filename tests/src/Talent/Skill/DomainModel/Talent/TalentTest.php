<?php

namespace Tests\Talent\Skill\DomainModel\Talent;

use Tests\Talent\Skill\ApplicationService\Skill\PreparedInMemorySkillData;
use Talent\Skill\DomainModel\SkillScore\SkillScore;

class TalentTest extends \PHPUnit_Framework_TestCase {

    protected $talent;
    protected $phpSkill;
    protected $leanSkill;
    protected $leanSkillScore;

    protected function setUp() {
        $skillData = new PreparedInMemorySkillData();
        $this->phpSkill = $skillData->phpSkill();
        $this->leanSkill = $skillData->leanSkill();

        $this->talent = new TestableTalent();
        $this->leanSkillScore = new SkillScore(1, 3, $this->leanSkill->toReadDataObject(), $this->talent);
        $this->talent->addManually($this->leanSkillScore);
    }

    function test_addSkillScore_shouldAddSkillScoreToTalentPropertyAndReturnTrue() {
        $this->assertEquals(1, $this->talent->getCountOfSkillScore());
        $this->assertTrue($this->talent->addSkillScore($this->phpSkill->toReadDataObject(), 4));
        $this->assertEquals(2, $this->talent->getCountOfSkillScore());
        $phpSkillScore = $this->talent->lastAddedSkillScore();
        $rdo = $phpSkillScore->toReadDataObject();
        $this->assertEquals(2, $rdo->getId());
        $this->assertEquals(4, $rdo->getScoreValue());
        $this->assertEquals($this->phpSkill->toReadDataObject(), $rdo->skillRDO());
    }

    function test_addSkillScore_duplicateSkill_returnErrorMessages() {
        $msg = $this->talent->addSkillScore($this->leanSkill->toReadDataObject(), 3);
        $this->assertInstanceOf('\Resources\ErrorMessage', $msg);
//print_r($msg->toArray());
    }

    function test_updateSkillScore_shouldUpdateSkillScoreInTalentPropertyAndReturnTrue() {
        $this->assertTrue($this->talent->updateSkillScore($this->leanSkillScore->getId(), 2));
        $rdo = $this->leanSkillScore->toReadDataObject();
        $this->assertEquals(2, $rdo->getScoreValue());
    }

    function test_updateSkillScore_skillScoreNotFound_returnErrorMessage() {
        $msg = $this->talent->updateSkillScore(123, 3);
        $this->assertInstanceOf('\Resources\ErrorMessage', $msg);
//print_r($msg->toArray());
    }

    function test_updateSkillScore_skillScoreAlreadyRemoved_returnErrorMessage() {
        $this->leanSkillScore->remove();
        $msg = $this->talent->updateSkillScore($this->leanSkillScore->getId(), 3);
        $this->assertInstanceOf('\Resources\ErrorMessage', $msg);
//print_r($msg->toArray());
    }

    function test_removeSkillScore_shouldRemoveSkillScoreInTalentProperty() {
        $this->assertEquals(1, $this->talent->getCountOfSkillScore());
        $this->assertFalse($this->leanSkillScore->getIsRemoved());
        $this->assertTrue($this->talent->removeSkillScore($this->leanSkillScore->getId()));

        $this->assertEquals(0, $this->talent->getCountOfSkillScore());
        $this->assertTrue($this->leanSkillScore->getIsRemoved());
    }

    function test_removeSkillScore_skillScoreNotFound_returnErrorMessage() {
        $msg = $this->talent->removeSkillScore(123);
        $this->assertInstanceOf('\Resources\ErrorMessage', $msg);
//print_r($msg->toArray());
    }

    function test_removeSkillScore_skillScoreAlreadyRemoved_returnErrorMessage() {
        $this->leanSkillScore->remove();
        $msg = $this->talent->removeSkillScore($this->leanSkillScore->getId());
        $this->assertInstanceOf('\Resources\ErrorMessage', $msg);
//print_r($msg->toArray());
    }

    function test_aSkillScoreReadDataObjectOfId_shouldReturnSKillSCoreRDO() {
        $rdo = $this->talent->aSkillScoreReadDataObjectOfId($this->leanSkillScore->getId());
        $this->assertInstanceOf('\Talent\Skill\DomainModel\SkillScore\DataObject\SkillScoreReadDataObject', $rdo);
//print_r($rdo->toArray());
    }

    function test_aSkillScoreReadDataObjectOfId_skillScoreNotFound_returnNull() {
        $rdo = $this->talent->aSkillScoreReadDataObjectOfId(123);
        $this->assertNull($rdo);
    }

    function test_aSkillScoreReadDataObjectOfId_skillScoreAlreadyRemoved_returnNull() {
        $this->leanSkillScore->remove();
        $rdo = $this->talent->aSkillScoreReadDataObjectOfId($this->leanSkillScore->getId());
        $this->assertNull($rdo);
    }

    function test_allSkillScoreReadDataObject_shouldReturnArrayOfSkillScoreRDO() {
        $this->talent->addSkillScore($this->phpSkill->toReadDataObject(), 3);
        $rdos = $this->talent->allSkillScoreReadDataObject();
        $this->assertEquals(2, count($rdos));
        foreach ($rdos as $rdo) {
            $this->assertInstanceOf('\Talent\Skill\DomainModel\SkillScore\DataObject\SkillScoreReadDataObject', $rdo);
//print_r($rdo->toArray());
        }
    }

    function test_allSkillScoreReadDataObject_noSkillScoreInProperty_returnEmptyArray() {
        $this->leanSkillScore->remove();
        $rdos = $this->talent->allSkillScoreReadDataObject();
        $this->assertEmpty($rdos);
    }

}
