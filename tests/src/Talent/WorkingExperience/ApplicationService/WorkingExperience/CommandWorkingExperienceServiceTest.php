<?php

namespace Tests\Talent\WorkingExperience\ApplicationService\WorkingExperience;

use Talent\WorkingExperience\DomainModel\WorkingExperience\DataObject\WorkingExperienceWriteDataObject;
use Talent\WorkingExperience\ApplicationService\WorkingExperience\CommandWorkingExperienceService;

class CommandWorkingExperienceServiceTest extends \PHPUnit_Framework_TestCase {

    protected $service;
    protected $talent;
    protected $convergain;
    protected $barapraja;

    protected function setUp() {
        $workingExperienceData = new PreparedInMemoryWorkingExperienceData();
        $this->talent = $workingExperienceData->talent();
        $this->convergain = $workingExperienceData->convergain();
        $this->barapraja = $workingExperienceData->barapraja();
        $this->service = new CommandWorkingExperienceService($workingExperienceData->repository());
    }

    protected function _createRequest($startYear = '2014', $endYear = '2016') {
        return WorkingExperienceWriteDataObject::request('kab', 'maketing', 'sales', $startYear, $endYear);
    }

    function test_add_shouldAddWorkingExperienceToTalentProperty() {
        $this->assertEquals(2, $this->talent->getWorkingExperienceCount());
        $request = $this->_createRequest();
        $msg = $this->service->add($this->talent->getId(), $request);

        $this->assertTrue($msg->getStatus());
        $this->assertEquals(3, $this->talent->getWorkingExperienceCount());
        $kab = $this->talent->lastAddedWorkingExperience();
        $this->assertEquals(3, $kab->getId());
print_r($kab->toReadDataObject()->toArray());
    }

    function test_add_containInvalidArgument_returnFalse() {
        $request = WorkingExperienceWriteDataObject::request('', '', '', 'asdfas', 'asdf');
        $msg = $this->service->add($this->talent->getId(), $request);
        $this->assertFalse($msg->getStatus());
//print_r($msg->errorMessage()->toArray());
    }

    function test_add_StartTimeInFuture_returnFalse() {
        $request = $this->_createRequest('2018');
        $msg = $this->service->add($this->talent->getId(), $request);
        $this->assertFalse($msg->getStatus());
//print_r($msg->errorMessage()->toArray());
    }

    function test_add_EndTimeLessThanStartTime_returnFalse() {
        $request = $this->_createRequest('2016', '2014');
        $msg = $this->service->add($this->talent->getId(), $request);
        $this->assertFalse($msg->getStatus());
//print_r($msg->errorMessage()->toArray());
    }

    function test_add_talentNotFound_throwException() {
        $this->setExpectedException('\Resources\Exception\DoNotCatchException');
        $request = $this->_createRequest();
        $this->service->add(\Ramsey\Uuid\Uuid::uuid4()->toString(), $request);
    }

    function test_update_shouldChangeWorkingExperienceDataInTalent() {
        $request = $this->_createRequest();
        $msg = $this->service->update($this->talent->getId(), $this->convergain->getId(), $request);

        $this->assertTrue($msg->getStatus());
print_r($this->convergain->toReadDataObject()->toArray());
    }

    function test_update_containInvalidArgument_returnFalse() {
        $request = WorkingExperienceWriteDataObject::request('', '', '', 'asdfas', 'asdf');
        $msg = $this->service->update($this->talent->getId(), $this->convergain->getId(), $request);
        $this->assertFalse($msg->getStatus());
//print_r($msg->errorMessage()->toArray());
    }

    function test_update_WorkingExperienceNotFOund_returnFalse() {
        $request = $this->_createRequest();
        $msg = $this->service->update($this->talent->getId(), 123, $request);
        $this->assertFalse($msg->getStatus());
//print_r($msg->errorMessage()->toArray());
    }

    function test_update_WorkingExperienceAlreadyRemoved_returnFalse() {
        $this->convergain->remove();
        $request = $this->_createRequest();
        $msg = $this->service->update($this->talent->getId(), $this->convergain->getId(), $request);
        $this->assertFalse($msg->getStatus());
//print_r($msg->errorMessage()->toArray());
    }

    function test_update_TalentNotFOund_throwExcpetion() {
        $this->setExpectedException('\Resources\Exception\DoNotCatchException');
        $request = $this->_createRequest();
        $msg = $this->service->update(\Ramsey\Uuid\Uuid::uuid4()->toString(), $this->convergain->getId(), $request);
    }

    function test_remove_shouldRemoveWorkingExperienceFromTalent() {
        $this->assertEquals(2, $this->talent->getWorkingExperienceCount());
        $this->assertFalse($this->convergain->getIsRemoved());
        $msg = $this->service->remove($this->talent->getId(), $this->convergain->getId());

        $this->assertTrue($msg->getStatus());
        $this->assertTrue($this->convergain->getIsRemoved());
        $this->assertEquals(1, $this->talent->getWorkingExperienceCount());
    }

    function test_remove_WorkingExperienceNotFound_returnFalse() {
        $msg = $this->service->remove($this->talent->getId(), 123);
        $this->assertFalse($msg->getStatus());
        print_r($msg->errorMessage()->toArray());
    }

    function test_remove_WorkingExperienceAlreadyRemoved_returnFalse() {
        $this->barapraja->remove();
        $msg = $this->service->remove($this->talent->getId(), $this->barapraja->getId());
        $this->assertFalse($msg->getStatus());
        print_r($msg->errorMessage()->toArray());
    }

    function test_remove_talentNotFound_throwExcpetion() {
        $this->setExpectedException('\Resources\Exception\DoNotCatchException');
        $this->service->remove(\Ramsey\Uuid\Uuid::uuid4()->toString(), $this->convergain->getId());
    }

}
