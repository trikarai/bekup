<?php

namespace Tests\Talent\Profile\ApplicationService\Talent;

use Talent\Profile\ApplicationService\Talent\LoginTalentService;

class LoginTalentServiceTest extends \PHPUnit_Framework_TestCase {
    protected $apur;
    protected $service;
    
    protected function setUp() {
        $talentData = new PreparedInMemoryTalentData();
        $this->apur = $talentData->talentApur();
        $this->service = new LoginTalentService($talentData->repository());
    }
    
    function test_login_shouldReturnTrueResponseContainOneTalentRDO() {
        $msg = $this->service->execute($this->apur->getUserName(), '123');
        $this->assertTrue($msg->getStatus());
        $this->assertInstanceOf('\Superclass\DomainModel\Talent\TalentReadDataObject', $msg->firstReadDataObject());
//print_r($msg->firstReadDataObject()->toArray());
    }

    function test_login_userNameNotFound_returnFalseTalentMO() {
        $msg = $this->service->execute('badUser', '123');
        $this->assertFalse($msg->getStatus());
//print_r($msg->errorMessage()->toArray());
    }

    function test_login_passwordNotMatch_returnFalseTalentMO() {
        $msg = $this->service->execute($this->apur->getUserName(), 'badPassword');
        $this->assertFalse($msg->getStatus());
//print_r($msg->errorMessage()->toArray());
    }
}
