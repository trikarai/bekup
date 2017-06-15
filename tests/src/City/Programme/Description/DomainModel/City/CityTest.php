<?php

namespace Tests\City\Programme\Description\DomainModel\City;

use City\Programme\Description\DomainModel\City\City;
use City\Programme\Description\DomainModel\Programme\Programme;
use Programme\Description\DomainModel\Programme\DataObject\ProgrammeReadDataObject;

class CityTest extends \PHPUnit_Framework_TestCase {

    protected $city;
    /** @var TestableProgramme */
    protected $cityProgramme2017;
    /** @var TestableProgramme */
    protected $cityProgramme2018;

    protected function setUp() {
        $this->city = new TestableCity();
        $this->_setProgramme2017();
        $this->_setProgramme2018();
    }

    protected function _setProgramme2017() {
        $referenceProgrammeId = \Ramsey\Uuid\Uuid::uuid4()->toString();
        $this->cityProgramme2017 = new TestableProgramme($this->city, 1, $referenceProgrammeId);
        $this->city->addProgrammeManually($this->cityProgramme2017);
    }

    protected function _setProgramme2018() {
        $referenceProgrammeId = \Ramsey\Uuid\Uuid::uuid4()->toString();
        $this->cityProgramme2018 = new TestableProgramme($this->city, 2, $referenceProgrammeId);
        $this->city->addProgrammeManually($this->cityProgramme2018);
    }

    function test_addProgramme_shouldAddProgrammeToCollectionAndReturnTrue() {
        $this->assertEquals(2, $this->city->getCountOfActiveProgramme());
        $msg = $this->city->addProgramme(\Ramsey\Uuid\Uuid::uuid4()->toString());
        $this->assertTrue($msg);
        $this->assertEquals(3, $this->city->getCountOfActiveProgramme());
    }
    function test_addProgramme_referenceProgrammeAlreadyUsed_returnErrorMessage() {
        $msg = $this->city->addProgramme($this->cityProgramme2017->getReferenceProgrammeId());
        $this->assertInstanceOf('\Resources\ErrorMessage', $msg);
        $this->assertEquals(2, $this->city->getCountOfActiveProgramme());
//print_r($msg->toArray());
    }
    function test_udpateProgramme_shouldChangeProgrammeIsOfflineStatusAndReturTrue() {
        $this->assertFalse($this->cityProgramme2018->getIsOffline());
        $msg = $this->city->updateProgramme($this->cityProgramme2018->getId(), $isOffline = true);
        $this->assertTrue($msg);
        $this->assertTrue($this->cityProgramme2018->getIsOffline());
    }

    function test_udpateProgramme_programmeNotFound_returnErrorMessage() {
        $msg = $this->city->updateProgramme(123, $isOffline = true);
        $this->assertInstanceOf('\Resources\ErrorMessage', $msg);
//print_r($msg->toArray());
    }

    function test_removeProgramme_shouldMarkProgrammeAsRemovedAndReturnTrue() {
        $this->assertEquals(2, $this->city->getCountOfActiveProgramme());
        $this->assertFalse($this->cityProgramme2017->getIsRemoved());
        $msg = $this->city->removeProgramme($this->cityProgramme2017->getId());

        $this->assertTrue($msg);
        $this->assertTrue($this->cityProgramme2017->getIsRemoved());
        $this->assertEquals(1, $this->city->getCountOfActiveProgramme());
    }

    function test_removeProgramme_programmeNotFOund_returnErrorMessage() {
        $msg = $this->city->removeProgramme(123);
        $this->assertInstanceOf('\Resources\ErrorMessage', $msg);
        $this->assertEquals(2, $this->city->getCountOfActiveProgramme());
//print_r($msg->toArray());
    }
}

use Doctrine\Common\Collections\Criteria;

class TestableCity extends City {

    public function __construct() {
        parent::__construct();
    }

    function getCountOfActiveProgramme() {
        $criteria = Criteria::create()
                ->where(Criteria::expr()->eq('isRemoved', false));
        return $this->programmes->matching($criteria)->count();
    }

    /**
     * @return Programme
     */
    function lastInsertedProgramme() {
        return $this->programmes->last();
    }

    function addProgrammeManually(Programme $programme) {
        $this->programmes->set($programme->getId(), $programme);
    }

}

class TestableProgramme extends Programme{
    function getIsOffline(){
        return $this->isOffline;
    }
}
