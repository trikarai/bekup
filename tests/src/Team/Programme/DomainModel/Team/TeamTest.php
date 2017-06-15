<?php

namespace Tests\Team\Programme\DomainModel\Team;

use Team\Programme\DomainModel\Team\Team;
use Team\Programme\DomainModel\Programme\Programme;
use Programme\Description\DomainModel\Programme\ProgrammeRdo as MainProgrammeRdo;
use City\Programme\Description\DomainModel\Programme\ProgrammeRdo as CityProgrammeRdo;
use Superclass\DomainModel\City\CityReadDataObject;

class TeamTest extends \PHPUnit_Framework_TestCase {

    protected $team;
    protected $bandungRdo;

    protected function setUp() {
        $this->bandungRdo = $this->_createCityRdo();
        $this->team = new TestableTeam($this->bandungRdo);
    }

    protected function _createProgrammeRdo($registrationStartDate = '2017-06-01', $registrationEndDate = '2017-06-30') {
        $id = \Ramsey\Uuid\Uuid::uuid4()->toString();
        $name = 'programme 2017';
        $registrationStartDate = new \DateTime($registrationStartDate);
        $registrationEndDate = new \DateTime($registrationEndDate);
        $operationStartDate = new \DateTime('2017-07-01');
        $operationEndDate = new \DateTime('2017-12-31');
        return new TestableProgrammeRdo($id, $name, $registrationStartDate, $registrationEndDate, $operationStartDate, $operationEndDate, false);
    }

    protected function _createCityRdo() {
        $id = \Ramsey\Uuid\Uuid::uuid4()->toString();
        $name = 'bandung';
        return new TestableCityReadDataObject($id, $name, false);
    }

    protected function _createCityProgrammeRdo() {
        $id = 1;
        $referenceProgrammeRDO = $this->_createProgrammeRdo();
        $cityRdo = $this->bandungRdo;
        return new TestableCityProgrammeRdo($id, $referenceProgrammeRDO, TRUE, false, $cityRdo);
    }

    function test_applyProgramme_shouldAddProgrammeToPropertyAndReturnTrue() {
        $cityProgrammeRdo = $this->_createCityProgrammeRdo();

        $this->assertEmpty($this->team->getCountOfProgrammes());
        $msg = $this->team->applyProgramme($cityProgrammeRdo);
        $this->assertTrue($msg);
        $this->assertEquals(1, count($this->team->getCountOfProgrammes()));
        $lastProgramme = $this->team->lastAddedProgramme();
        $this->assertEquals($cityProgrammeRdo->getId(), $lastProgramme->getReferenceCityProgrammeId());
        $this->assertEquals('apply', $lastProgramme->getStatus());
    }

    function test_applyProgramme_alreadyHasActiveProgramme_returnErrorMessage() {
        $programme = new TestableProgramme(1, $this->_createCityProgrammeRdo(), $this->team, 'active');
        $this->team->addProgrammeManually($programme);

        $cityProgrammeRdo = new TestableCityProgrammeRdo(2, $this->_createProgrammeRdo(), true, false, $this->bandungRdo);
        $msg = $this->team->applyProgramme($cityProgrammeRdo);
        $this->assertInstanceOf('\Resources\ErrorMessage', $msg);
//print_r($msg->toArray());
    }

    function test_applyProgramme_referenceCityProgrammeAlreadyApplied_returnErrorMessage() {
        $this->team->applyProgramme($this->_createCityProgrammeRdo());
        $msg = $this->team->applyProgramme($this->_createCityProgrammeRdo());
        $this->assertInstanceOf('\Resources\ErrorMessage', $msg);
//print_r($msg->toArray());
    }

    function test_applyProgramme_appliedToCityProgrammeOfDifferentCity_returnErrorMessage() {
        $cityProgrammeRdo = new TestableCityProgrammeRdo(1, $this->_createProgrammeRdo(), true, false, $this->_createCityRdo());
        $msg = $this->team->applyProgramme($cityProgrammeRdo);
        $this->assertInstanceOf('\Resources\ErrorMessage', $msg);
//print_r($msg->toArray());
    }

    function test_applyProgramme_programmeRegistrationNotOpen_returnErrorMessage() {
        $referenceProgrammeRDO = $this->_createProgrammeRdo('2017-01-01', '2017-01-31');
        $cityProgrammeRdo = new TestableCityProgrammeRdo(1, $referenceProgrammeRDO, true, false, $this->bandungRdo);
        $msg = $this->team->applyProgramme($cityProgrammeRdo);
        $this->assertInstanceOf('\Resources\ErrorMessage', $msg);
//print_r($msg->toArray());
    }

    function test_cancelApplication_shouldChangeStatusFromApplyToCancelAndReturnTrue() {
        $this->team->applyProgramme($this->_createCityProgrammeRdo());
        $lastProgramme = $this->team->lastAddedProgramme();
        $this->assertEquals('apply', $lastProgramme->getStatus());
        $msg = $this->team->cancelApplication($lastProgramme->getId());
        $this->assertTrue($msg);
        $this->assertEquals('cancel', $lastProgramme->getStatus());
    }

    function test_cancelApplication_currentStatusNotApply_returnErrorMessage() {
        $programme = new TestableProgramme(1, $this->_createCityProgrammeRdo(), $this->team, 'active');
        $this->team->addProgrammeManually($programme);
        $lastProgramme = $this->team->lastAddedProgramme();
        $this->assertEquals('active', $lastProgramme->getStatus());

        $msg = $this->team->cancelApplication($lastProgramme->getId());
        $this->assertInstanceOf('\Resources\ErrorMessage', $msg);
//print_r($msg->toArray());
    }

    function test_cancelApplication_programmeNotFound_returnErrorMessage() {
        $msg = $this->team->cancelApplication(123);
        $this->assertInstanceOf('\Resources\ErrorMessage', $msg);
//print_r($msg->toArray());
    }

    function test_resignProgramme_shouldChangeStatusFromActiveToResign() {
        $programme = new TestableProgramme(1, $this->_createCityProgrammeRdo(), $this->team, 'active');
        $this->team->addProgrammeManually($programme);
        $lastProgramme = $this->team->lastAddedProgramme();
        $this->assertEquals('active', $lastProgramme->getStatus());

        $msg = $this->team->resignFromProgramme($lastProgramme->getId());
        $this->assertTrue($msg);
        $this->assertEquals('resign', $lastProgramme->getStatus());
    }

    function test_resignProgramme_currentStatusNotActive_returnErrorMessage() {
        $programme = new TestableProgramme(1, $this->_createCityProgrammeRdo(), $this->team, 'apply');
        $this->team->addProgrammeManually($programme);
        $lastProgramme = $this->team->lastAddedProgramme();

        $msg = $this->team->resignFromProgramme($lastProgramme->getId());
        $this->assertInstanceOf('\Resources\ErrorMessage', $msg);
//print_r($msg->toArray());
    }

    function test_resignProgramme_programmeNotFound_returnErrorMessage() {
        $msg = $this->team->resignFromProgramme(213);
        $this->assertInstanceOf('\Resources\ErrorMessage', $msg);
//print_r($msg->toArray());
    }

}

class TestableProgrammeRdo extends MainProgrammeRdo {

    public function __construct($id, $name, $registrationStartDate, $registrationEndDate, $operationStartDate, $operationEndDate, $isRemoved) {
        parent::__construct($id, $name, $registrationStartDate, $registrationEndDate, $operationStartDate, $operationEndDate, $isRemoved);
    }

}

class TestableCityReadDataObject extends CityReadDataObject {

    public function __construct($id, $name, $isRemoved) {
        parent::__construct($id, $name, $isRemoved);
    }

}

class TestableCityProgrammeRdo extends CityProgrammeRdo {

    public function __construct($id, \Programme\Description\DomainModel\Programme\ProgrammeRdo $referenceProgrammeRDO, $isOffline, $isRemoved, \Superclass\DomainModel\City\CityReadDataObject $cityRdo) {
        parent::__construct($id, $referenceProgrammeRDO, $isOffline, $isRemoved, $cityRdo);
    }

}

class TestableProgramme extends Programme {

    public function __construct($id, \City\Programme\Description\DomainModel\Programme\ProgrammeRdo $cityProgrammeRdo, Team $team, $status) {
        parent::__construct($id, $cityProgrammeRdo, $team);
        $this->status = $status;
    }

}

class TestableTeam extends Team {

    public function __construct(CityReadDataObject $cityRdo) {
        parent::__construct();
        $this->cityRDO = $cityRdo;
    }

    function getCountOfProgrammes() {
        return $this->programmes->count();
    }

    /**
     *
     * @return Programme
     */
    function lastAddedProgramme() {
        return $this->programmes->last();
    }

    function addProgrammeManually(TestableProgramme $programme) {
        $this->programmes->set($programme->getId(), $programme);
    }

}
