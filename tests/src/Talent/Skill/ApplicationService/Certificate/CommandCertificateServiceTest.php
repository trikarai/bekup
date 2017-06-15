<?php

namespace Tests\Talent\Skill\ApplicationService\Certificate;

use Talent\Skill\ApplicationService\Certificate\CommandCertificateService;
use Talent\Skill\DomainModel\Certificate\DataObject\CertificateWriteDataObject;

class CommandCertificateServiceTest extends \PHPUnit_Framework_TestCase {

    protected $service;
    protected $talent;
    protected $skillScore;
    protected $phpCertificate;
    protected $dddCertificate;

    protected function setUp() {
        $certificateData = new PreparedInMemoryCertificateData();
        $this->talent = $certificateData->talent();
        $this->skillScore = $certificateData->skillScore();
        $this->phpCertificate = $certificateData->phpCertificate();
        $this->dddCertificate = $certificateData->dddCertificate();

        $this->service = new CommandCertificateService($certificateData->repository());
    }

    protected function _createRequest() {
        return CertificateWriteDataObject::request('agile certificate', 'dilo', 2018);
    }

    function test_add_shouldAddCertificateToSkillScoreProperty() {
        $this->assertEquals(2, $this->skillScore->getCountOfCertificate());
        $request = $this->_createRequest();
        $msg = $this->service->add($this->talent->getId(), $this->skillScore->getId(), $request);

        $this->assertTrue($msg->getStatus());
        $this->assertEquals(3, $this->skillScore->getCountOfCertificate());
        $agileRdo = $this->skillScore->lastAddedCertificate()->toReadDataObject();
        $this->assertEquals(3, $agileRdo->getId());
        $this->assertEquals($request->getName(), $agileRdo->getName());
        $this->assertEquals($request->getOrganizer(), $agileRdo->getOrganizer());
        $this->assertEquals($request->getValidUntil(), $agileRdo->getValidUntil());
    }

    function test_add_containInvalidArgument_returnFalseResponseMessage() {
        $this->assertEquals(2, $this->skillScore->getCountOfCertificate());
        $request = CertificateWriteDataObject::request('', '', 123);
        $msg = $this->service->add($this->talent->getId(), $this->skillScore->getId(), $request);
        $this->assertEquals(2, $this->skillScore->getCountOfCertificate());
        $this->assertFalse($msg->getStatus());
//print_r($msg->errorMessage()->toArray());
    }

    function test_add_skillScoreNotFound_returnFalseResponseMessage() {
        $request = $this->_createRequest();
//        $msg = $this->service->add(\Ramsey\Uuid\Uuid::uuid4()->toString(), $this->skillScore->getId(), $request);
        $msg = $this->service->add($this->talent->getId(), 123, $request);
        $this->assertFalse($msg->getStatus());
//print_r($msg->errorMessage()->toArray());
    }

    function test_add_skillScoreAlreadyRemoved_returnFalseResponseMessage() {
        $request = $this->_createRequest();
        $this->skillScore->remove();
        $msg = $this->service->add($this->talent->getId(), $this->skillScore->getId(), $request);
        $this->assertFalse($msg->getStatus());
//print_r($msg->errorMessage()->toArray());
    }

    function test_update_shouldUpdateCertificateInSkillScore() {
        $request = $this->_createRequest();
        $msg = $this->service->update($this->talent->getId(), $this->skillScore->getId(), $this->phpCertificate->getId(), $request);

        $this->assertTrue($msg->getStatus());
        $rdo = $this->phpCertificate->toReadDataObject();
        $this->assertEquals($request->getName(), $rdo->getName());
        $this->assertEquals($request->getOrganizer(), $rdo->getOrganizer());
        $this->assertEquals($request->getValidUntil(), $rdo->getValidUntil());
    }

    function test_update_containInvalidArgument_returnFalseResponseMessage() {
        $request = CertificateWriteDataObject::request('', '', 12345);
        $msg = $this->service->update($this->talent->getId(), $this->skillScore->getId(), $this->phpCertificate->getId(), $request);
        $this->assertFalse($msg->getStatus());
//print_r($msg->errorMessage()->toArray());
    }

    function test_update_skillScoreNotFound_returnFalseResponseMessage() {
        $request = $this->_createRequest();
//        $msg = $this->service->update(\Ramsey\Uuid\Uuid::uuid4()->toString(), $this->skillScore->getId(), $this->phpCertificate->getId(), $request);
        $msg = $this->service->update($this->talent->getId(), 123, $this->phpCertificate->getId(), $request);
        $this->assertFalse($msg->getStatus());
//print_r($msg->errorMessage()->toArray());
    }

    function test_update_skillAlreadyRemoved_returnFalseResponseMessage() {
        $this->skillScore->remove();
        $request = $this->_createRequest();
        $msg = $this->service->update($this->talent->getId(), $this->skillScore->getId(), $this->phpCertificate->getId(), $request);
        $this->assertFalse($msg->getStatus());
//print_r($msg->errorMessage()->toArray());
    }

    function test_update_certificateNotFOund_returnFalseResponseMessage() {
        $request = $this->_createRequest();
        $msg = $this->service->update($this->talent->getId(), $this->skillScore->getId(), 123, $request);
        $this->assertFalse($msg->getStatus());
//print_r($msg->errorMessage()->toArray());
    }

    function test_update_certificateAlreadyRemoved_returnFalseResponseMessage() {
        $this->phpCertificate->remove();
        $request = $this->_createRequest();
        $msg = $this->service->update($this->talent->getId(), $this->skillScore->getId(), $this->phpCertificate->getId(), $request);
        $this->assertFalse($msg->getStatus());
//print_r($msg->errorMessage()->toArray());
    }

    function test_remove_shouldRemovedCertificateInSkillScore() {
        $this->assertEquals(2, $this->skillScore->getCountOfCertificate());
        $this->assertFalse($this->phpCertificate->getIsRemoved());
        $msg = $this->service->remove($this->talent->getId(), $this->skillScore->getId(), $this->phpCertificate->getId());

        $this->assertTrue($msg->getStatus());
        $this->assertEquals(1, $this->skillScore->getCountOfCertificate());
        $this->assertTrue($this->phpCertificate->getIsRemoved());
    }

    function test_remove_skillScoreNotFound_returnFalseResponseMessage() {
//        $msg = $this->service->remove(\Ramsey\Uuid\Uuid::uuid4()->toString(), $this->skillScore->getId(), $this->phpCertificate->getId());
        $msg = $this->service->remove($this->talent->getId(), 123, $this->phpCertificate->getId());
        $this->assertFalse($msg->getStatus());
//print_r($msg->errorMessage()->toArray());
    }

    function test_remove_skillScoreAlreadyRemoved_returnFalseResponseMessage() {
        $this->skillScore->remove();
        $msg = $this->service->remove($this->talent->getId(), $this->skillScore->getId(), $this->phpCertificate->getId());
        $this->assertFalse($msg->getStatus());
//print_r($msg->errorMessage()->toArray());
    }

    function test_remove_CertificateNotFound_returnFalseResponseMessage() {
        $msg = $this->service->remove($this->talent->getId(), $this->skillScore->getId(), 123);
        $this->assertFalse($msg->getStatus());
//print_r($msg->errorMessage()->toArray());
    }

    function test_remove_CertificateAlreadyRemoved_returnFalseResponseMessage() {
        $this->phpCertificate->remove();
        $msg = $this->service->remove($this->talent->getId(), $this->skillScore->getId(), $this->phpCertificate->getId());
        $this->assertFalse($msg->getStatus());
        print_r($msg->errorMessage()->toArray());
    }

}
