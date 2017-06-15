<?php

namespace Tests\Talent\Skill\ApplicationService\Skill;

use Talent\Skill\ApplicationService\Skill\QuerySkillService;

class QuerySkillServiceTest extends \PHPUnit_Framework_TestCase {

    protected $service;
    protected $phpSkill;
    protected $leanSkill;
    protected $cssSkill;

    protected function setUp() {
        $skillData = new PreparedInMemorySkillData();
        $this->phpSkill = $skillData->phpSkill();
        $this->leanSkill = $skillData->leanSkill();
        $this->cssSkill = $skillData->cssSkill();
        $this->service = new QuerySkillService($skillData->rdoRepository());
    }

    function test_showById_shouldReturnSkillMoWithASkillRDO() {
        $msg = $this->service->showById($this->phpSkill->getId());
        $this->assertTrue($msg->getStatus());
        $this->assertInstanceOf('\Talent\Skill\DomainModel\Skill\DataObject\SkillReadDataObject', $msg->firstReadDataObject());
        print_r($msg->firstReadDataObject()->toArray());
    }

    function test_showById_skillNotFound_returnFalse() {
        $msg = $this->service->showById(\Ramsey\Uuid\Uuid::uuid4()->toString());
        $this->assertFalse($msg->getStatus());
        print_r($msg->errorMessage()->toArray());
    }

    function test_showById_skillAlreadyRemoved_returnFalse() {
        $this->phpSkill->remove();
        $msg = $this->service->showById($this->phpSkill->getId());
        $this->assertFalse($msg->getStatus());
        print_r($msg->errorMessage()->toArray());
    }

    function test_showAll_shouldReturnSkillMoWithAllSkillRDOs() {
        $msg = $this->service->showAll();
        $this->assertTrue($msg->getStatus());
        $this->assertEquals(3, count($msg->arrayOfReadDataObject()));
        foreach ($msg->arrayOfReadDataObject() as $rdo) {
            $this->assertInstanceOf('\Talent\Skill\DomainModel\Skill\DataObject\SkillReadDataObject', $rdo);
            print_r($rdo->toArray());
        }
    }

    function test_showAll_emptyData_returnFalse() {
        $this->phpSkill->remove();
        $this->leanSkill->remove();
        $this->cssSkill->remove();
        $msg = $this->service->showAll();
        $this->assertFalse($msg->getStatus());
        print_r($msg->errorMessage()->toArray());
    }

}
