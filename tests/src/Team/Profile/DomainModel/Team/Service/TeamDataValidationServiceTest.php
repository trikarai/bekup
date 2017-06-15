<?php

namespace Tests\Team\Profile\DomainModel\Team\Service;

use Team\Profile\DomainModel\Team\Service\TeamDataValidationService;
use Team\Profile\DomainModel\Team\DataObject\TeamWriteDataObject;

class TeamDataValidationServiceTest extends \PHPUnit_Framework_TestCase {
    protected $service;
    
    protected function setUp() {
        $this->service = new TeamDataValidationService();
    }
    
    function test_isValidToCreate_shouldReturnTrue() {
        $request = TeamWriteDataObject::request('name', 'vision', 'mission', 'culture', 'founder agreement');
        $this->assertTrue($this->service->isValidToCreate($request));
    }
    function test_isValidToCreate_emptyName_returnErrorMessage() {
        $request = TeamWriteDataObject::request('', 'vision', 'mission', 'culture', 'founder agreement');
        $msg = $this->service->isValidToCreate($request);
        $this->assertInstanceOf('\Resources\ErrorMessage', $msg);
print_r($msg->toArray());
    }
    function test_isValidToCreate_emptyVision_returnErrorMessage() {
        $request = TeamWriteDataObject::request('name', '', 'mission', 'culture', 'founder agreement');
        $msg = $this->service->isValidToCreate($request);
        $this->assertInstanceOf('\Resources\ErrorMessage', $msg);
print_r($msg->toArray());
    }
    function test_isValidToCreate_emptyMission_returnErrorMessage() {
        $request = TeamWriteDataObject::request('name', 'vision', '', 'culture', 'founder agreement');
        $msg = $this->service->isValidToCreate($request);
        $this->assertInstanceOf('\Resources\ErrorMessage', $msg);
print_r($msg->toArray());
    }
    function test_isValidToCreate_emptyCulture_returnErrorMessage() {
        $request = TeamWriteDataObject::request('name', 'vision', 'mission', '', 'founder agreement');
        $msg = $this->service->isValidToCreate($request);
        $this->assertInstanceOf('\Resources\ErrorMessage', $msg);
print_r($msg->toArray());
    }
    function test_isValidToCreate_emptyFounderAgreement_returnErrorMessage() {
        $request = TeamWriteDataObject::request('name', 'vision', 'mission', 'culture', '');
        $msg = $this->service->isValidToCreate($request);
        $this->assertInstanceOf('\Resources\ErrorMessage', $msg);
print_r($msg->toArray());
    }
    function test_isValidToCreate_multiEmptyArgument_returnErrorMessage() {
        $request = TeamWriteDataObject::request('', '', '', '', '');
        $msg = $this->service->isValidToCreate($request);
        $this->assertInstanceOf('\Resources\ErrorMessage', $msg);
print_r($msg->toArray());
    }
}
