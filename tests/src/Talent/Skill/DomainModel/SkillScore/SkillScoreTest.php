<?php

namespace Tests\Talent\Skill\DomainModel\SkillScore;

use Talent\Skill\DomainModel\Certificate\Certificate;
use Talent\Skill\DomainModel\Certificate\DataObject\CertificateWriteDataObject;

class SkillScoreTest extends \PHPUnit_Framework_TestCase {

    protected $skillScore;
    protected $cert1;
    protected $cert2;

    protected function setUp() {
        $this->skillScore = new TestableSkillScore();
        $this->_setCertificate1();
        $this->_setCertificate2();
    }

    protected function _setCertificate1() {
        $request = CertificateWriteDataObject::request('certificate 1', 'bdv', 2020);
        $this->cert1 = new Certificate(1, $request, $this->skillScore);
        $this->skillScore->addManually($this->cert1);
    }

    protected function _setCertificate2() {
        $request = CertificateWriteDataObject::request('certificate 2', 'dilo');
        $this->cert2 = new Certificate(2, $request, $this->skillScore);
        $this->skillScore->addManually($this->cert2);
    }

    protected function _createRequest() {
        return CertificateWriteDataObject::request('pehape', 'bedepeh', 2018);
    }

    function test_addCertificate_shouldAddCertificateToSkillScorePropertyAndReturnTrue() {
        $this->assertEquals(2, $this->skillScore->getCountOfCertificates());
        $request = $this->_createRequest();
        $this->assertTrue($this->skillScore->addCertificate($request));

        $this->assertEquals(3, $this->skillScore->getCountOfCertificates());
        $newCert = $this->skillScore->lastAddedCertificate();
        $rdo = $newCert->toReadDataObject();
        $this->assertEquals(3, $rdo->getId());
        $this->assertEquals($request->getName(), $rdo->getName());
        $this->assertEquals($request->getOrganizer(), $rdo->getOrganizer());
        $this->assertEquals($request->getValidUntil(), $rdo->getValidUntil());
//print_r($newCert->toReadDataObject()->toArray());
    }

    function test_udpateCertificate_shouldUpdateCertificateDataInSkillScorePropertyAndReturnTrue() {
        $request = $this->_createRequest();
        $msg = $this->skillScore->updateCertificate($this->cert1->getId(), $request);
        $this->assertTrue($msg);
        $rdo = $this->cert1->toReadDataObject();
        $this->assertEquals($request->getName(), $rdo->getName());
        $this->assertEquals($request->getOrganizer(), $rdo->getOrganizer());
        $this->assertEquals($request->getValidUntil(), $rdo->getValidUntil());
//print_r($this->cert1->toReadDataObject()->toArray());
    }

    function test_udpateCertificate_certificateNotFound_returnErrorMessage() {
        $request = $this->_createRequest();
        $msg = $this->skillScore->updateCertificate(123, $request);
        $this->assertInstanceOf('\Resources\ErrorMessage', $msg);
//print_r($msg->toArray());
    }

    function test_udpateCertificate_certificateAlreadyRemoved_returnErrorMessage() {
        $request = $this->_createRequest();
        $this->cert1->remove();
        $msg = $this->skillScore->updateCertificate($this->cert1->getId(), $request);
        $this->assertInstanceOf('\Resources\ErrorMessage', $msg);
//print_r($msg->toArray());
    }

    function test_removeCertificate_shouldRemovedCertificateFromSkillScorePropertyAndReturnTrue() {
        $this->assertEquals(2, $this->skillScore->getCountOfCertificates());
        $this->assertFalse($this->cert1->getIsRemoved());
        $this->skillScore->removeCertificate($this->cert1->getId());
        $this->assertEquals(1, $this->skillScore->getCountOfCertificates());
        $this->assertTrue($this->cert1->getIsRemoved());
    }

    function test_removeCertificate_certificateNotFound_returnErrorMessage() {
        $msg = $this->skillScore->removeCertificate(123);
        $this->assertInstanceOf('\Resources\ErrorMessage', $msg);
//print_r($msg->toArray());
    }

    function test_removeCertificate_certificateAlreadyRemoved_returnErrorMessage() {
        $this->cert1->remove();
        $msg = $this->skillScore->removeCertificate($this->cert1->getId());
        $this->assertInstanceOf('\Resources\ErrorMessage', $msg);
//print_r($msg->toArray());
    }

    function test_showById_returnCertificateRDO() {
        $rdo = $this->skillScore->aCertificateReadDataObjectOfId($this->cert1->getId());
        $this->assertInstanceOf('\Talent\Skill\DomainModel\Certificate\DataObject\CertificateReadDataObject', $rdo);
//print_r($rdo->toArray());
    }

    function test_showById_certificateNotFound_returnNUll() {
        $rdo = $this->skillScore->aCertificateReadDataObjectOfId(123);
        $this->assertNull($rdo);
    }

    function test_showById_certificateAlreadyRemoved_returnNUll() {
        $this->cert1->remove();
        $rdo = $this->skillScore->aCertificateReadDataObjectOfId($this->cert1->getId());
        $this->assertNull($rdo);
    }

    function test_showAll_returnArrayOfCertificateRDO() {
        $rdos = $this->skillScore->allCertificateReadDataObject();
        $this->assertEquals(2, count($rdos));
        foreach ($rdos as $rdo) {
            $this->assertInstanceOf('\Talent\Skill\DomainModel\Certificate\DataObject\CertificateReadDataObject', $rdo);
//print_r($rdo->toArray());
        }
    }

    function test_showAll_noCertificateAvailable_returnEmptyArray() {
        $this->cert1->remove();
        $this->cert2->remove();
        $rdos = $this->skillScore->allCertificateReadDataObject();
        $this->assertEmpty($rdos);
    }

}
