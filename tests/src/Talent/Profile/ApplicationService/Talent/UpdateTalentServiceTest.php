<?php

namespace Tests\Talent\Profile\ApplicationService\Talent;

use Talent\Profile\ApplicationService\Talent\UpdateTalentService;
use Talent\Profile\DomainModel\Talent\DataObject\TalentWriteDataObject;

class UpdateTalentServiceTest extends \PHPUnit_Framework_TestCase {

    protected $apur;
    protected $igun;
    protected $service;

    protected function setUp() {
        $talentData = new PreparedInMemoryTalentData();
        $this->apur = $talentData->talentApur();
        $this->igun = $talentData->talentIgun();
        $this->service = new UpdateTalentService($talentData->repository());
    }

    protected function _createRequest($email = 'tri@email.org') {
        return TalentWriteDataObject::updateRequest('tri', $email, 'abcdefg', 'kab.bandung', '1989-01-01');
    }

    function test_execute_shouldChangeDataInRepository() {
//print_r($this->apur->toReadDataObject()->toArray());

        $request = $this->_createRequest();
        $msg = $this->service->execute($this->apur->getId(), $request);
        $this->assertTrue($msg->getStatus());

        $rdo = $this->apur->toReadDataObject();
        $this->assertEquals($request->getName(), $rdo->getName());
        $this->assertEquals($request->getEmail(), $rdo->getEmail());
        $this->assertEquals($request->getPhone(), $rdo->getPhone());
        $this->assertEquals($request->getCityOfOrigin(), $rdo->getCityOfOrigin());
        $this->assertEquals($request->getBirthDate(), $rdo->getBirthDate());
//print_r($this->apur->toReadDataObject()->toArray());
    }

    function test_execute_containInvalidArgument_stopOpAndReturnFalseMessage() {
//        $request = TalentWriteDataObject::updateRequest('', 'invalidEmail', '', '', '2010-01-01');
        $request = TalentWriteDataObject::updateRequest('', 'invalidEmail', '', '', 'abksljfals');
        $msg = $this->service->execute($this->apur->getId(), $request);
        $this->assertFalse($msg->getStatus());
        print_r($msg->errorMessage()->toArray());
    }

    function test_execute_duplicateEmail_stopOpAndReturnFalseMessage() {
        $request = $this->_createRequest($this->igun->getEmail());
        $msg = $this->service->execute($this->apur->getId(), $request);
        $this->assertFalse($msg->getStatus());
        print_r($msg->errorMessage()->toArray());
    }

    function test_execute_sameEmailAsBefore_updateNormally() {
        $request = $this->_createRequest($this->apur->getEmail());
        $msg = $this->service->execute($this->apur->getId(), $request);
        $this->assertTrue($msg->getStatus());
    }

    function test_execute_talentNotFound_throwException() {
        $this->setExpectedException('\Resources\Exception\DoNotCatchException');
        $request = $this->_createRequest();
        $msg = $this->service->execute(\Ramsey\Uuid\Uuid::uuid4()->toString(), $request);
    }

}
