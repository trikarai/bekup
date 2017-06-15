<?php

namespace Tests\Talent\Skill\ApplicationService\Skill;

use Talent\Skill\ApplicationService\Skill\RemoveSkillService;
use Tests\Personnel\ApplicationService\Personnel\PreparedInMemoryPersonnelData;

class RemoveSkillServiceTest extends \PHPUnit_Framework_TestCase {

    protected $repository;
    protected $phpSkill;
    protected $leanSkill;
    protected $service;
    protected $personnelDirector;
    protected $personnelTrackCoordinator;

    protected function setUp() {
        $skillData = new PreparedInMemorySkillData();
        $personnelData = new PreparedInMemoryPersonnelData();

        $this->repository = $skillData->repository();
        $this->phpSkill = $skillData->phpSkill();
        $this->leanSkill = $skillData->leanSkill();
        $this->personnelDirector = $personnelData->getDirector();
        $this->personnelTrackCoordinator = $personnelData->getTrackCoordinator();

        $this->service = new RemoveSkillService($this->repository, $personnelData->rdoRepository());
    }

    function test_remove_shouldRemoveDataFromRepository() {
        $this->assertEquals(3, $this->repository->getSkillCount());
        $this->assertFalse($this->phpSkill->getIsRemoved());
        $msg = $this->service->execute($this->personnelDirector->getId(), $this->phpSkill->getId());

        $this->assertTrue($msg->getStatus());
        $this->assertEquals(2, $this->repository->getSkillCount());
        $this->assertTrue($this->phpSkill->getIsRemoved());
    }

    function test_remove_skillNotFound_returnFalse() {
        $msg = $this->service->execute($this->personnelDirector->getId(), \Ramsey\Uuid\Uuid::uuid4()->toString());
        $this->assertFalse($msg->getStatus());
        $this->assertEquals(3, $this->repository->getSkillCount());
        print_r($msg->errorMessage()->toArray());
    }

    function test_remove_skillAlreadyRemoved_returnFalse() {
        $this->phpSkill->remove();
        $msg = $this->service->execute($this->personnelDirector->getId(), $this->phpSkill->getId());
        $this->assertFalse($msg->getStatus());
        $this->assertEquals(2, $this->repository->getSkillCount());
        print_r($msg->errorMessage()->toArray());
    }

    function test_remove_PersonnelNotFound_throwException() {
        $this->setExpectedException('\Resources\Exception\DoNotCatchException');
        $this->service->execute(\Ramsey\Uuid\Uuid::uuid4()->toString(), $this->phpSkill->getId());
    }

    function test_remove_unauthorizedPersonnel_throwException() {
        $msg = $this->service->execute($this->personnelTrackCoordinator->getId(), $this->phpSkill->getId());
        $this->assertFalse($msg->getStatus());
        print_r($msg->errorMessage()->toArray());
    }

}
