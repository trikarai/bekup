<?php

namespace Tests\Talent\Profile\DomainModel\Talent\Service;

use Talent\Profile\DomainModel\Talent\Service\TalentDataValidationService;
use Talent\Profile\DomainModel\Talent\DataObject\TalentWriteDataObject;

class TalentDataValidationServiceTest extends \PHPUnit_Framework_TestCase {
    protected $service;
    
    protected function setUp() {
        $this->service = new TalentDataValidationService();
    }
    
    function test_isValidToSignUp_returnTrue() {
        $request = TalentWriteDataObject::signUpRequest('name', 'username', 'mail@email.org', 'password', '08123123', 'cimahi', '1980-09-08', '123123', '12312312');
        $msg = $this->service->isValidToSignUp($request);
    }
    function test_isValidToSignUp_emptyName_returnErrorMessage() {
        $request = TalentWriteDataObject::signUpRequest('', 'username', 'mail@email.org', 'password', '08123123', 'cimahi', '1980-09-08', '123123', '12312312');
        $msg = $this->service->isValidToSignUp($request);
        $this->assertInstanceOf('\Resources\ErrorMessage', $msg);
    }
    function test_isValidToSignUp_emptyUserName_returnErrorMessage() {
        $request = TalentWriteDataObject::signUpRequest('name', '', 'mail@email.org', 'password', '08123123', 'cimahi', '1980-09-08', '123123', '12312312');
        $msg = $this->service->isValidToSignUp($request);
        $this->assertInstanceOf('\Resources\ErrorMessage', $msg);
    }
    function test_isValidToSignUp_invalidEmail_returnErrorMessage() {
        $request = TalentWriteDataObject::signUpRequest('name', 'username', 'badEmail', 'password', '08123123', 'cimahi', '1980-09-08', '123123', '12312312');
        $msg = $this->service->isValidToSignUp($request);
        $this->assertInstanceOf('\Resources\ErrorMessage', $msg);
    }
    function test_isValidToSignUp_emptyPassword_returnErrorMessage() {
        $request = TalentWriteDataObject::signUpRequest('name', 'username', 'mail@email.org', '', '08123123', 'cimahi', '1980-09-08', '123123', '12312312');
        $msg = $this->service->isValidToSignUp($request);
        $this->assertInstanceOf('\Resources\ErrorMessage', $msg);
    }
    function test_isValidToSignUp_emptyPhone_returnErrorMessage() {
        $request = TalentWriteDataObject::signUpRequest('name', 'username', 'mail@email.org', 'password', '', 'cimahi', '1980-09-08', '123123', '12312312');
        $msg = $this->service->isValidToSignUp($request);
        $this->assertInstanceOf('\Resources\ErrorMessage', $msg);
    }
    function test_isValidToSignUp_emptyCityOfOrigin_returnErrorMessage() {
        $request = TalentWriteDataObject::signUpRequest('name', 'username', 'mail@email.org', 'password', '08123123', '', '1980-09-08', '123123', '12312312');
        $msg = $this->service->isValidToSignUp($request);
        $this->assertInstanceOf('\Resources\ErrorMessage', $msg);
    }
    function test_isValidToSignUp_invalidBirthDateFormat_returnErrorMessage() {
        $request = TalentWriteDataObject::signUpRequest('name', 'username', 'mail@email.org', 'password', '08123123', 'cimahi', '123123123', '123123', '12312312');
        $msg = $this->service->isValidToSignUp($request);
        $this->assertInstanceOf('\Resources\ErrorMessage', $msg);
    }
    function test_isValidToSignUp_AgeBelow17_returnErrorMessage() {
        $request = TalentWriteDataObject::signUpRequest('name', 'username', 'mail@email.org', 'password', '08123123', 'cimahi', '2010-01-01', '123123', '12312312');
        $msg = $this->service->isValidToSignUp($request);
        $this->assertInstanceOf('\Resources\ErrorMessage', $msg);
    }
    function test_isValidToSignUp_multiInvalidArgument_returnErrorMessage() {
        $request = TalentWriteDataObject::signUpRequest('', '', 'bad email', '', '', '', '2010-01-01', '123123', '12312312');
        $msg = $this->service->isValidToSignUp($request);
        $this->assertInstanceOf('\Resources\ErrorMessage', $msg);
//print_r($msg->toArray());        
    }
    
    function test_isValidToUpdate_returnTrue() {
        $request = TalentWriteDataObject::updateRequest('name', 'email@email.org', '0812312', 'cimahi', '1990-09-08');
        $msg = $this->service->isValidToUpdate($request);
    }
    function test_isValidToUpdate_emptyName_returnErrorMessage() {
        $request = TalentWriteDataObject::updateRequest('', 'email@email.org', '0812312', 'cimahi', '1990-09-08');
        $msg = $this->service->isValidToUpdate($request);
        $this->assertInstanceOf('\Resources\ErrorMessage', $msg);
    }
    function test_isValidToUpdate_badEmail_returnErrorMessage() {
        $request = TalentWriteDataObject::updateRequest('name', 'bad mail', '0812312', 'cimahi', '1990-09-08');
        $msg = $this->service->isValidToUpdate($request);
        $this->assertInstanceOf('\Resources\ErrorMessage', $msg);
    }
    function test_isValidToUpdate_emptyPhone_returnErrorMessage() {
        $request = TalentWriteDataObject::updateRequest('name', 'email@email.org', '', 'cimahi', '1990-09-08');
        $msg = $this->service->isValidToUpdate($request);
        $this->assertInstanceOf('\Resources\ErrorMessage', $msg);
    }
    function test_isValidToUpdate_emptyCityOfOrigin_returnErrorMessage() {
        $request = TalentWriteDataObject::updateRequest('name', 'email@email.org', '0812312', '', '1990-09-08');
        $msg = $this->service->isValidToUpdate($request);
        $this->assertInstanceOf('\Resources\ErrorMessage', $msg);
    }
    function test_isValidToUpdate_invalidBirthDateFormat_returnErrorMessage() {
        $request = TalentWriteDataObject::updateRequest('name', 'email@email.org', '0812312', 'cimahi', 'zdfs123');
        $msg = $this->service->isValidToUpdate($request);
        $this->assertInstanceOf('\Resources\ErrorMessage', $msg);
    }
    function test_isValidToUpdate_ageBelow17_returnErrorMessage() {
        $request = TalentWriteDataObject::updateRequest('name', 'email@email.org', '0812312', 'cimahi', '2011-09-08');
        $msg = $this->service->isValidToUpdate($request);
        $this->assertInstanceOf('\Resources\ErrorMessage', $msg);
    }
    function test_isValidToUpdate_multiInvalidArgument_returnErrorMessage() {
        $request = TalentWriteDataObject::updateRequest('', 'bademail', '', '', '2011-09-08');
        $msg = $this->service->isValidToUpdate($request);
        $this->assertInstanceOf('\Resources\ErrorMessage', $msg);
print_r($msg->toArray());
    }
}
