<?php

namespace Tests\Talent\Profile\ApplicationService\Talent;

use Tests\City\Profile\ApplicationService\City\PreparedInMemoryCityData;
use Tests\Track\Definition\ApplicationService\Track\PreparedInMemoryTrackData;
use Talent\Profile\ApplicationService\Talent\SignUpTalentService;
use Talent\Profile\DomainModel\Talent\DataObject\TalentWriteDataObject;
use Talent\Profile\DomainModel\Talent\ValueObject\TalentPassword;

class SignUpTalentServiceTest extends \PHPUnit_Framework_TestCase {

    protected $repository;
    protected $service;
    protected $apur;
    protected $bandungId;
    protected $teknisId;

    protected function setUp() {
        $talentData = new PreparedInMemoryTalentData();
        $cityData = new PreparedInMemoryCityData();
        $trackData = new PreparedInMemoryTrackData();

        $this->repository = $talentData->repository();
        $this->apur = $talentData->talentApur();
        $this->bandungId = $cityData->bandung()->getId();
        $this->teknisId = $trackData->teknis()->getId();
        $this->service = new SignUpTalentService($this->repository, $cityData->rdoRepository(), $trackData->rdoRepository());
    }

    protected function _createRequest($cityId, $trackId, $userName = 'tri', $email = 'tri@email.org') {
        return TalentWriteDataObject::signUpRequest('tri', $userName, $email, '123', '123123', 'cimahi', '1990-01-01', $cityId, $trackId);
    }

    function test_execute_shouldAddInRepository() {
        $this->assertEquals(2, count($this->repository->all()));

        $request = $this->_createRequest($this->bandungId, $this->teknisId);
        $msg = $this->service->execute($request);
        $this->assertTrue($msg->getStatus());

        $this->assertEquals(3, count($this->repository->all()));
        $tri = $this->repository->lastInsertedTalent();
        $rdo = $tri->toReadDataObject();
        $this->assertEquals($request->getName(), $rdo->getName());
        $this->assertEquals($request->getUserName(), $rdo->getUserName());
        $this->assertEquals($request->getEmail(), $rdo->getEmail());
        $this->assertEquals($request->getPhone(), $rdo->getPhone());
        $this->assertEquals($request->getCityOfOrigin(), $rdo->getCityOfOrigin());
        $this->assertEquals($request->getBirthDate(), $rdo->getBirthDate());
        $this->assertEquals($this->bandungId, $rdo->cityRDO()->getId());
        $this->assertEquals($this->teknisId, $rdo->trackRDO()->getId());
        $this->assertTrue($tri->password()->sameValueAs(TalentPassword::fromNative($request->getPassword())));
        print_r($rdo);
    }

    function test_execute_containInvalidArgument_stopOPAndReturnFalseStatus() {
//        $request = TalentWriteDataObject::signUpRequest('', '', 'badEmail', '', '', '', '2000-05-08', '', '');
        $request = TalentWriteDataObject::signUpRequest('', '', 'badEmail', '', '', '', 'sdfasdf2w', '', '');
        $msg = $this->service->execute($request);

        $this->assertEquals(2, count($this->repository->all()));
        $this->assertFalse($msg->getStatus());
        print_r($msg->errorMessage()->toArray());
    }

    function test_execute_duplicateUserName_stopOPAndReturnFalseStatus() {
        $request = $this->_createRequest($this->bandungId, $this->teknisId, $this->apur->getUserName());
        $msg = $this->service->execute($request);

        $this->assertEquals(2, count($this->repository->all()));
        $this->assertFalse($msg->getStatus());
        print_r($msg->errorMessage()->toArray());
    }

    function test_execute_duplicateUserEmail_stopOPAndReturnFalseStatus() {
        $request = $this->_createRequest($this->bandungId, $this->teknisId, 'tri', $this->apur->getEmail());
        $msg = $this->service->execute($request);

        $this->assertEquals(2, count($this->repository->all()));
        $this->assertFalse($msg->getStatus());
        print_r($msg->errorMessage()->toArray());
    }

    function test_execute_cityNotFound_throwException() {
        $request = $this->_createRequest(\Ramsey\Uuid\Uuid::uuid4()->toString(), $this->teknisId);
        $msg = $this->service->execute($request);

        $this->assertEquals(2, count($this->repository->all()));
        $this->assertFalse($msg->getStatus());
        print_r($msg->errorMessage()->toArray());
    }

    function test_execute_TrackNotFound_throwException() {
        $request = $this->_createRequest($this->bandungId, \Ramsey\Uuid\Uuid::uuid4()->toString());
        $msg = $this->service->execute($request);

        $this->assertEquals(2, count($this->repository->all()));
        $this->assertFalse($msg->getStatus());
        print_r($msg->errorMessage()->toArray());
    }

}
