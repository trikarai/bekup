<?php

namespace Tests\Talent\Skill\ApplicationService\Certificate;

use Talent\Skill\ApplicationService\Certificate\QueryCertificateService;

class QueryCertificateServiceTest extends \PHPUnit_Framework_TestCase {
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
        
        $this->service = new QueryCertificateService($certificateData->repository());
    }
    
    function test_showById_shouldReturnTrueResponseWithCertificateRDO() {
        $msg = $this->service->showByid($this->talent->getId(), $this->skillScore->getId(), $this->phpCertificate->getId());
        $this->assertTrue($msg->getStatus());
        $this->assertInstanceOf('\Talent\Skill\DomainModel\Certificate\DataObject\CertificateReadDataObject', $msg->firstReadDataObject());
//print_r($msg->firstReadDataObject()->toArray());
    }
    function test_showById_skillScoreNotFound_returnFalseResponse() {
//        $msg = $this->service->showByid(\Ramsey\Uuid\Uuid::uuid4()->toString(), $this->skillScore->getId(), $this->phpCertificate->getId());
        $msg = $this->service->showByid($this->talent->getId(), 123, $this->phpCertificate->getId());
        $this->assertFalse($msg->getStatus());
//print_r($msg->errorMessage()->toArray());
    }
    function test_showById_skillScoreAlreadyRemoved_returnFalseResponse() {
        $this->skillScore->remove();
        $msg = $this->service->showByid($this->talent->getId(), $this->skillScore->getId(), $this->phpCertificate->getId());
        $this->assertFalse($msg->getStatus());
//print_r($msg->errorMessage()->toArray());
    }
    function test_showById_CertificateNotFound_returnFalseResponse() {
        $msg = $this->service->showByid($this->talent->getId(), $this->skillScore->getId(), 123);
        $this->assertFalse($msg->getStatus());
//print_r($msg->errorMessage()->toArray());
    }
    function test_showById_CertificateAlreadyRemoved_returnFalseResponse() {
        $this->phpCertificate->remove();
        $msg = $this->service->showByid($this->talent->getId(), $this->skillScore->getId(), $this->phpCertificate->getId());
        $this->assertFalse($msg->getStatus());
//print_r($msg->errorMessage()->toArray());
    }
    
    function test_showAll_scenario_shouldReturnTrueResponseContainAllCertificateRDO() {
        $msg = $this->service->showAll($this->talent->getId(), $this->skillScore->getId());
        $this->assertTrue($msg->getStatus());
        $this->assertEquals(2, count($msg->arrayOfReadDataObject()));
        foreach($msg->arrayOfReadDataObject() as $rdo){
            $this->assertInstanceOf('\Talent\Skill\DomainModel\Certificate\DataObject\CertificateReadDataObject', $rdo);
//print_r($rdo->toArray());
        }
    }
    function test_showAll_skillScoreNotFound_returnFalseREsponse() {
//        $msg = $this->service->showAll(\Ramsey\Uuid\Uuid::uuid4()->toString(), $this->skillScore->getId());
        $msg = $this->service->showAll($this->talent->getId(), 123);
        $this->assertFalse($msg->getStatus());
//print_r($msg->errorMessage()->toArray());
    }
    function test_showAll_skillScoreAlreadyRemoved_returnFalseREsponse() {
        $this->skillScore->remove();
        $msg = $this->service->showAll($this->talent->getId(), $this->skillScore->getId());
        $this->assertFalse($msg->getStatus());
//print_r($msg->errorMessage()->toArray());
    }
    function test_showAll_noCertificateAvailable_returnFalseREsponse() {
        $this->phpCertificate->remove();
        $this->dddCertificate->remove();
        $msg = $this->service->showAll($this->talent->getId(), $this->skillScore->getId());
        $this->assertFalse($msg->getStatus());
//print_r($msg->errorMessage()->toArray());
    }
}
