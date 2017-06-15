<?php

namespace Tests\Team\Profile\DomainModel\Membership\Service;

use Team\Profile\DomainModel\Membership\Service\MembershipDataValidationService;

class MembershipDataValidationServiceTest extends \PHPUnit_Framework_TestCase {
    protected $service;
    
    protected function setUp() {
        $this->service = new MembershipDataValidationService();
    }
    
    function test_isValidToProcess_scenario_resultExpected() {
        $msg = $this->service->isValidToProcees('position', true);
        $this->assertTrue($msg);
    }
    function test_isValidToProcess_emptyPosition_returnErrorMessage() {
        $msg = $this->service->isValidToProcees('', true);
        $this->assertInstanceOf('\Resources\ErrorMessage', $msg);
print_r($msg->toArray());
    }
    function test_isValidToProcess_isAdminNotBoolan_returnErrorMessage() {
        $msg = $this->service->isValidToProcees('position', 'asdfs');
        $this->assertInstanceOf('\Resources\ErrorMessage', $msg);
print_r($msg->toArray());
    }
    function test_isValidToProcess_multiInvalidArgument_returnErrorMessage() {
        $msg = $this->service->isValidToProcees('', 12313);
        $this->assertInstanceOf('\Resources\ErrorMessage', $msg);
print_r($msg->toArray());
    }
}
