<?php

namespace Tests\Personnel\ApplicationService\Personnel;

use Personnel\ApplicationService\Personnel\LoginPersonnelService;

class LoginPersonnelServiceTest extends \PHPUnit_Framework_TestCase {
    protected $director;
    
    protected function setUp() {
        $personnelData = new PreparedInMemoryPersonnelData();
        $this->director = $personnelData->getDirector();
        $this->service = new LoginPersonnelService($personnelData->getRepository());
    }
    function test_login_shouldReturnTrueResponseWithOneRDO() {
        $msg = $this->service->execute($this->director->getEmail(), '123');
        $this->assertTrue($msg->getStatus());
        $this->assertInstanceOf('\Personnel\DomainModel\Personnel\DataObject\PersonnelReadDataObject', $msg->firstReadDataObject());
        print_r($msg->firstReadDataObject()->toArray());
    }

    function test_login_emailNotFound_returnFalseResponse() {
        $msg = $this->service->execute('badmail@email.org', '123');
        $this->assertFalse($msg->getStatus());
        print_r($msg->errorMessage()->toArray());
    }

    function test_login_passwordNotMatch_returnFalseResponse() {
        $msg = $this->service->execute($this->director->getEmail(), 'sdf');
        $this->assertFalse($msg->getStatus());
        print_r($msg->errorMessage()->toArray());
    }
}
