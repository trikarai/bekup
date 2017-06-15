<?php

namespace Tests\Talent\Skill\ApplicationService\Skill;

use Talent\Skill\ApplicationService\Skill\CommandSkillService;
use Tests\Track\Definition\ApplicationService\Track\PreparedInMemoryTrackData;
use Tests\Personnel\ApplicationService\Personnel\PreparedInMemoryPersonnelData;

class CommandSkillServiceTest extends \PHPUnit_Framework_TestCase {

    protected $repository;
    protected $phpSkill;
    protected $leanSkill;
    protected $service;
    protected $personnelDirector;
    protected $personnelTrackCoordinator;
    protected $trackBisnis;
    protected $trackTeknis;

    protected function setUp() {
        $trackData = new PreparedInMemoryTrackData();
        $skillData = new PreparedInMemorySkillData();
        $personnelData = new PreparedInMemoryPersonnelData();

        $this->repository = $skillData->repository();
        $this->phpSkill = $skillData->phpSkill();
        $this->leanSkill = $skillData->leanSkill();
        $this->trackBisnis = $trackData->bisnis();
        $this->trackTeknis = $trackData->teknis();
        $this->personnelDirector = $personnelData->getDirector();
        $this->personnelTrackCoordinator = $personnelData->getTrackCoordinator();

        $this->service = new CommandSkillService($this->repository, $personnelData->rdoRepository(), $trackData->rdoRepository());
    }

    function test_add_shouldAddSkillToRepository() {
        $this->assertEquals(3, $this->repository->getSkillCount());
        $name = 'ddd skill';
        $msg = $this->service->add($this->personnelDirector->getId(), $name, $this->trackTeknis->getId());

        $this->assertEquals(4, $this->repository->getSkillCount());
        $this->assertTrue($msg->getStatus());
        $dddSkill = $this->repository->lastAddedSkill();
        $this->assertEquals($name, $dddSkill->getName());
//print_r($dddSkill->toReadDataObject()->toArray());
    }

    function test_add_emptyName_returnFalse() {
        $name = '';
        $msg = $this->service->add($this->personnelDirector->getId(), $name, $this->trackTeknis->getId());
        $this->assertFalse($msg->getStatus());
//print_r($msg->errorMessage()->toArray());
    }

    function test_add_duplicateName_returnFalse() {
        $name = $this->phpSkill->getName();
        $msg = $this->service->add($this->personnelDirector->getId(), $name, $this->trackTeknis->getId());
        $this->assertFalse($msg->getStatus());
//print_r($msg->errorMessage()->toArray());
    }

    function test_add_trackNotFound_returnFalse() {
        $name = 'ddd skill';
        $msg = $this->service->add($this->personnelDirector->getId(), $name, \Ramsey\Uuid\Uuid::uuid4()->toString());
        $this->assertFalse($msg->getStatus());
//print_r($msg->errorMessage()->toArray());
    }

    function test_add_personnelNotFound_throwException() {
        $this->setExpectedException('\Resources\Exception\DoNotCatchException', 'personnel not found');
        $name = 'ddd skill';
        $msg = $this->service->add(\Ramsey\Uuid\Uuid::uuid4()->toString(), $name, $this->trackTeknis->getId());
    }

    function test_add_personnelNotAuthorized_throwException() {
        $name = 'ddd skill';
        $msg = $this->service->add($this->personnelTrackCoordinator->getId(), $name, $this->trackTeknis->getId());
        $this->assertFalse($msg->getStatus());
//print_r($msg->errorMessage()->toArray());
    }

    function test_update_shouldChangeDataInRepository() {
        $name = 'agile skill';
        $msg = $this->service->update($this->personnelDirector->getId(), $this->phpSkill->getId(), $name, $this->trackBisnis->getId());
        $this->assertTrue($msg->getStatus());
        $this->assertEquals($name, $this->phpSkill->getName());
        print_r($this->phpSkill->toReadDataObject()->toArray());
    }

    function test_update_emptyName_returnFalse() {
        $name = '';
        $msg = $this->service->update($this->personnelDirector->getId(), $this->phpSkill->getId(), $name, $this->trackBisnis->getId());
        $this->assertFalse($msg->getStatus());
        print_r($msg->errorMessage()->toArray());
    }

    function test_update_duplicateName_returnFalse() {
        $name = $this->leanSkill->getName();
        $msg = $this->service->update($this->personnelDirector->getId(), $this->phpSkill->getId(), $name, $this->trackBisnis->getId());
        $this->assertFalse($msg->getStatus());
        print_r($msg->errorMessage()->toArray());
    }

    function test_update_sameNameAsBefore_updateNormally() {
        $name = $this->phpSkill->getName();
        $msg = $this->service->update($this->personnelDirector->getId(), $this->phpSkill->getId(), $name, $this->trackBisnis->getId());
        $this->assertTrue($msg->getStatus());
        print_r($this->phpSkill->toReadDataObject()->toArray());
    }

    function test_update_trackNotFOund_returnFalse() {
        $name = 'agile skill';
        $msg = $this->service->update($this->personnelDirector->getId(), $this->phpSkill->getId(), $name, \Ramsey\Uuid\Uuid::uuid4()->toString());
        $this->assertFalse($msg->getStatus());
        print_r($msg->errorMessage()->toArray());
    }

    function test_update_skillNotFOund_returnFalse() {
        $name = 'agile skill';
        $msg = $this->service->update($this->personnelDirector->getId(), \Ramsey\Uuid\Uuid::uuid4()->toString(), $name, $this->trackBisnis->getId());
        $this->assertFalse($msg->getStatus());
        print_r($msg->errorMessage()->toArray());
    }

    function test_update_skillAlreadyRemoved_returnFalse() {
        $this->phpSkill->remove();
        $name = 'agile skill';
        $msg = $this->service->update($this->personnelDirector->getId(), $this->phpSkill->getId(), $name, $this->trackBisnis->getId());
        $this->assertFalse($msg->getStatus());
        print_r($msg->errorMessage()->toArray());
    }

    function test_update_personnelNotFound_throwException() {
        $this->setExpectedException('\Resources\Exception\DoNotCatchException');
        $name = 'agile skill';
        $this->service->update(\Ramsey\Uuid\Uuid::uuid4()->toString(), $this->phpSkill->getId(), $name, $this->trackBisnis->getId());
    }

    function test_update_personnelNotAuthorized_throwException() {
        $name = 'agile skill';
        $msg = $this->service->update($this->personnelTrackCoordinator->getId(), $this->phpSkill->getId(), $name, $this->trackBisnis->getId());
        $this->assertFalse($msg->getStatus());
        print_r($msg->errorMessage()->toArray());
    }

}
