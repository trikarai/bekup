<?php

namespace Tests\Talent\Profile\ApplicationService\Talent;

use Talent\Profile\ApplicationService\Talent\QueryTalentService;

class QueryTalentServiceTest extends \PHPUnit_Framework_TestCase {

    protected $service;
    protected $apur;
    protected $igun;

    protected function setUp() {
        $talentData = new PreparedInMemoryTalentData();
        $this->service = new QueryTalentService($talentData->rdoRepository());
        $this->apur = $talentData->talentApur();
        $this->igun = $talentData->talentIgun();
    }

    function test_showOneById_shouldReturnTrueTalentMessageObjectContainOneTalentRDO() {
        $msg = $this->service->showOneById($this->apur->getId());
        $this->assertTrue($msg->getStatus());
        $this->assertInstanceOf('\Superclass\DomainModel\Talent\TalentReadDataObject', $msg->firstReadDataObject());
//print_r($msg->firstReadDataObject()->toArray());
    }

    function test_showOneById_talentNotFOund_throwException() {
        $msg = $this->service->showOneById(\Ramsey\Uuid\Uuid::uuid4()->toString());
        $this->assertFalse($msg->getStatus());
//print_r($msg->errorMessage()->toArray());
    }
}
