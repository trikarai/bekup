<?php

namespace Tests\Talent\Education\ApplicationService\Education;

use Talent\Education\ApplicationService\Education\CommandEducationService;
use Talent\Education\DomainModel\Education\DataObject\EducationWriteDataObject;

class CommandEducationServiceTest extends \PHPUnit_Framework_TestCase {

    protected $repository;
    protected $talent;
    protected $sd;
    protected $smp;
    protected $service;

    protected function setUp() {
        $educationData = new PreparedInMemoryEducationData();
        $this->repository = $educationData->repository();
        $this->talent = $educationData->talentApur();
        $this->sd = $educationData->educationSD();
        $this->smp = $educationData->educationSMP();
        $this->service = new CommandEducationService($this->repository);
    }

    protected function _createAddRequest() {
        return EducationWriteDataObject::addRequest('SMA', 'SMA 3 Bandung', 'IPA', '', '1995', '1998');
    }

    function test_add_shouldAddEducationToTalentProperty() {
        $this->assertEquals(2, $this->talent->getEducationCount());
        $request = $this->_createAddRequest();
        $msg = $this->service->add($this->talent->getId(), $request);

        $this->assertTrue($msg->getStatus());
        $this->assertEquals(3, $this->talent->getEducationCount());
        $sma = $this->talent->lastAddedEducation();
        $rdo = $sma->toReadDataObject();
        $this->assertEquals(3, $rdo->getId());
        $this->assertEquals($request->getPhase(), $rdo->getPhase());
        $this->assertEquals($request->getInstitution(), $rdo->getInstitution());
        $this->assertEquals($request->getMajor(), $rdo->getMajor());
        $this->assertEquals($request->getNote(), $rdo->getNote());
        $this->assertEquals($request->getStartYear(), $rdo->getStartYear());
        $this->assertEquals($request->getEndYear(), $rdo->getEndYear());
    }

    function test_add_containInvalidArgument_stopOpAndReturnFalseStatus() {
        $request = EducationWriteDataObject::addRequest('', '', '', '', '123123', '12312312');
        $msg = $this->service->add($this->talent->getId(), $request);
        $this->assertFalse($msg->getStatus());
//print_r($msg->errorMessage()->toArray());
    }

    function test_add_talentNotFOund_throwException() {
        $this->setExpectedException('\Resources\Exception\DoNotCatchException');
        $this->service->add(\Ramsey\Uuid\Uuid::uuid4()->toString(), $this->_createAddRequest());
    }

    protected function _createUpdateRequest() {
        return EducationWriteDataObject::updateRequest('SD Tunas Mekar', 'IPS', 'notes', '1986');
    }

    function test_update_sholdChangeEducationDataInTalentProperty() {
        $request = $this->_createUpdateRequest();
        $msg = $this->service->update($this->talent->getId(), $this->sd->getId(), $request);
        $this->assertTrue($msg->getStatus());
        $rdo = $this->sd->toReadDataObject();
        $this->assertEquals($request->getInstitution(), $rdo->getInstitution());
        $this->assertEquals($request->getMajor(), $rdo->getMajor());
        $this->assertEquals($request->getNote(), $rdo->getNote());
        $this->assertEquals($request->getStartYear(), $rdo->getStartYear());
        $this->assertEquals($request->getEndYear(), $rdo->getEndYear());
//print_r($this->sd->toReadDataObject()->toArray());
    }

    function test_update_containInvalidArgument_stopOpAndReturnFalseStatus() {
        $request = EducationWriteDataObject::updateRequest('', '', '', '1231231', 'asdfsdf');
        $msg = $this->service->update($this->talent->getId(), $this->sd->getId(), $request);
        $this->assertFalse($msg->getStatus());
//print_r($msg->errorMessage()->toArray());
    }

    function test_update_educationNotFound_stopOpAndReturnFalseStatus() {
        $request = $this->_createUpdateRequest();
        $msg = $this->service->update($this->talent->getId(), 123, $request);
        $this->assertFalse($msg->getStatus());
//print_r($msg->errorMessage()->toArray());
    }

    function test_update_talentNOtFOund_throwException() {
        $this->setExpectedException('\Resources\Exception\DoNotCatchException');
        $msg = $this->service->update(\Ramsey\Uuid\Uuid::uuid4()->toString(), $this->sd->getId(), $this->_createUpdateRequest());
    }

    function test_remove_shouldRemoveEducationInTalentProperty() {
        $this->assertEquals(2, $this->talent->getEducationCount());
        $this->assertFalse($this->sd->getIsRemoved());

        $msg = $this->service->remove($this->talent->getId(), $this->sd->getId());
        $this->assertTrue($msg->getStatus());
        $this->assertEquals(1, $this->talent->getEducationCount());
        $this->assertTrue($this->sd->getIsRemoved());
    }

    function test_remove_educationNotFound_stopOpAndReturnFalseStatus() {
        $msg = $this->service->remove($this->talent->getId(), 123);
        $this->assertFalse($msg->getStatus());
        print_r($msg->errorMessage()->toArray());
    }

    function test_remove_talentNotFound_throwException() {
        $this->setExpectedException('\Resources\Exception\DoNotCatchException');
        $msg = $this->service->remove(\Ramsey\Uuid\Uuid::uuid4()->toString(), $this->sd->getId());
    }

}
