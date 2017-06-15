<?php

namespace Tests\Talent\Education\DomainModel\Talent\Talent;

use Talent\Education\DomainModel\Talent\Talent;
use Talent\Education\DomainModel\Education\Education;
use Talent\Education\DomainModel\Education\DataObject\EducationWriteDataObject;
use Doctrine\Common\Collections\Criteria;

class TalentTest extends \PHPUnit_Framework_TestCase {

    protected $talent;

    /** @var TestableEducation */
    protected $sd;

    /** @var TestableEducation */
    protected $smp;

    protected function setUp() {
        $this->talent = new TestableTalent();
        $this->_setSD();
        $this->_setSMP();
    }

    protected function _setSD() {
        $id = 1;
        $request = EducationWriteDataObject::addRequest('SD', 'YWKA', '', '', '1990', '1992');
        $this->sd = new TestableEducation($id, $request, $this->talent);
        $this->talent->setManually($this->sd);
    }

    protected function _setSMP() {
        $id = 2;
        $request = EducationWriteDataObject::addRequest('SMP', 'SMPN 9 Bandung', '', '', '1992', '1995');
        $this->smp = new TestableEducation($id, $request, $this->talent);
        $this->talent->setManually($this->smp);
    }

    protected function _makeAddRequest($startYear = '1995', $endYear = '1998') {
        return EducationWriteDataObject::addRequest('SMA', 'SMA 3 Bandung', 'IPA', '', $startYear, $endYear);
    }

    function test_addEducation_shouldAddToProperty() {
        $this->assertEquals(2, count($this->talent->arrayOfEducation()));
        $request = $this->_makeAddRequest();
        $msg = $this->talent->addEducation($request);

        $this->assertTrue($msg);
        $this->assertEquals(3, count($this->talent->arrayOfEducation()));
        $sma = $this->talent->lastAddedEducation();
        $rdo = $sma->toReadDataObject();
        $this->assertEquals(3, $rdo->getId());
        $this->assertEquals($request->getPhase(), $rdo->getPhase());
        $this->assertEquals($request->getInstitution(), $rdo->getInstitution());
        $this->assertEquals($request->getNote(), $rdo->getNote());
        $this->assertEquals($request->getStartYear(), $rdo->getStartYear());
        $this->assertEquals($request->getEndYear(), $rdo->getEndYear());
    }

    function test_addEducation_startYearInFuture_returnErrorMessage() {
        $this->assertEquals(2, count($this->talent->arrayOfEducation()));
        $request = $this->_makeAddRequest('2020', '2021');
        $msg = $this->talent->addEducation($request);

        $this->assertInstanceOf('\Resources\ErrorMessage', $msg);
//print_r($msg->toArray());
    }

    function test_addEducationn_endYearBeforeStartYear_returnErrorMessage() {
        $this->assertEquals(2, count($this->talent->arrayOfEducation()));
        $request = $this->_makeAddRequest(1995, 1990);
        $msg = $this->talent->addEducation($request);

        $this->assertInstanceOf('\Resources\ErrorMessage', $msg);
//print_r($msg->toArray());
    }

    protected function _createUpdateRequest($startYear = '1986', $endYear = '1990') {
        return EducationWriteDataObject::updateRequest('Tunas Mekar', '', 'sampai kls 4', $startYear, $endYear);
    }

    function test_updateEducation_shouldAddToProperty() {
        $request = $this->_createUpdateRequest();
        $msg = $this->talent->updateEducation($this->sd->getId(), $request);
        $this->assertTrue($msg);

        $rdo = $this->sd->toReadDataObject();
        $this->assertEquals($request->getInstitution(), $rdo->getInstitution());
        $this->assertEquals($request->getNote(), $rdo->getNote());
        $this->assertEquals($request->getStartYear(), $rdo->getStartYear());
        $this->assertEquals($request->getEndYear(), $rdo->getEndYear());
    }

    function test_updateEducation_educationNotFound_returnFalse() {
        $request = $this->_createUpdateRequest();
        $msg = $this->talent->updateEducation(11, $request);
//print_r($msg->toArray());
    }

    function test_update_startTimeInFuture_returnErrorMessage() {
        $request = $this->_createUpdateRequest(2020);
        $msg = $this->talent->updateEducation($this->sd->getId(), $request);
        $this->assertInstanceOf('\Resources\ErrorMessage', $msg);
        print_r($msg->toArray());
    }

    function test_update_EndTimeBeforeStartTime_returnErrorMessage() {
        $request = $this->_createUpdateRequest(1990, 1989);
        $msg = $this->talent->updateEducation($this->sd->getId(), $request);
        $this->assertInstanceOf('\Resources\ErrorMessage', $msg);
        print_r($msg->toArray());
    }

    function test_removeEducation_shouldRemoveFromProperty() {
        $this->assertFalse($this->sd->getIsRemoved());
        $msg = $this->talent->removeEducation($this->sd->getId());
        $this->assertTrue($msg);
        $this->assertTrue($this->sd->getIsRemoved());
    }

    function test_removeEducation_educationNotFound_returnFalse() {
        $msg = $this->talent->removeEducation(11);
        $this->assertInstanceOf('\Resources\ErrorMessage', $msg);
//print_r($msg->toArray());
    }

    function test_anEducationReadDataObjectOfId_shouldReturnEducationRDO() {
        $educationRDO = $this->talent->anEducationReadDataObjectOfId($this->sd->getId());
        $this->assertInstanceOf('\Talent\Education\DomainModel\Education\DataObject\EducationReadDataObject', $educationRDO);
//print_r($educationRDO->toArray());
    }

    function test_anEducationReadDataObjectOfId_educationNotFound_returnNull() {
        $this->sd->remove();
        $this->assertNull($this->talent->anEducationReadDataObjectOfId($this->sd->getId()));
    }

    function test_allEducationReadDataObjectOfId_shouldReturnArrayOfEducationRDO() {
        $RDOs = $this->talent->allEducationReadDataobject();
        $this->assertEquals(2, count($RDOs));
        foreach ($RDOs as $RDO) {
            $this->assertInstanceOf('\Talent\Education\DomainModel\Education\DataObject\EducationReadDataObject', $RDO);
//print_r($RDO->toArray());
        }
    }

    function test_allEducationReadDataObjectOfId_emptyEducation_returnEmptyArray() {
        $this->sd->remove();
        $this->smp->remove();
        $this->assertEmpty($this->talent->allEducationReadDataobject());
    }

}

class TestableEducation extends Education {

    public function __construct($id, EducationWriteDataObject $request, Talent $talent) {
        parent::__construct($id, $request, $talent);
    }

}

class TestableTalent extends Talent {

    public function __construct() {
        parent::__construct();
    }

    function setManually(Education $education) {
        $this->educations->set($education->getId(), $education);
    }

    /**
     * @return Education
     */
    function lastAddedEducation() {
        return $this->educations->last();
    }

    /**
     * @return Education[]
     */
    function arrayOfEducation() {
        $criteria = Criteria::create()
                ->where(Criteria::expr()->eq('isRemoved', false));
        return $this->educations->matching($criteria)->toArray();
    }

}
