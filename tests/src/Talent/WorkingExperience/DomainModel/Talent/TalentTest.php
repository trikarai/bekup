<?php

namespace Tests\Talent\WorkingExperience\DomainModel\Talent;

use Resources\MessageObject;
use Talent\WorkingExperience\DomainModel\Talent\Talent;
use Talent\WorkingExperience\DomainModel\WorkingExperience\WorkingExperience;
use Talent\WorkingExperience\DomainModel\WorkingExperience\DataObject\WorkingExperienceWriteDataObject;

class TalentTest extends \PHPUnit_Framework_TestCase {

    protected $talent;
    protected $convergain;
    protected $barapraja;

    protected function setUp() {
        $this->talent = new TestableTalent();
        $this->_setConvergain();
        $this->_setBarapraja();
    }

    protected function _setConvergain() {
        $request = WorkingExperienceWriteDataObject::request('convergain', 'magang', 'ngahuleng', '2006', '2010');
        $this->convergain = new WorkingExperience(1, $request, $this->talent);
        $this->talent->addManuallyWorkingExperience($this->convergain);
    }

    protected function _setBarapraja() {
        $request = WorkingExperienceWriteDataObject::request('barapraja', 'programmer', 'ngoding', '2014');
        $this->barapraja = new WorkingExperience(2, $request, $this->talent);
        $this->talent->addManuallyWorkingExperience($this->barapraja);
    }

    protected function _createRequest($startYear = '2015', $endYear = '2016') {
        return WorkingExperienceWriteDataObject::request('kab', 'marketing', 'sales', $startYear, $endYear);
    }

    function test_addWorkingExperience_shouldAddWorkingExperienceToTalentPropertyAndReturnTrue() {
        $this->assertEquals(2, $this->talent->getWorkingExperienceCount());

        $request = $this->_createRequest();
        $msg = $this->talent->addWorkingExperience($request);

        $this->assertTrue($msg);
        $this->assertEquals(3, $this->talent->getWorkingExperienceCount());
        $kab = $this->talent->lastInsertedWorkingExperience();
        $rdo = $kab->toReadDataObject();
        $this->assertEquals(3, $rdo->getId());
        $this->assertEquals($request->getCompanyName(), $rdo->getCompanyName());
        $this->assertEquals($request->getPosition(), $rdo->getPosition());
        $this->assertEquals($request->getRole(), $rdo->getRole());
        $this->assertEquals($request->getStartYear(), $rdo->getStartYear());
        $this->assertEquals($request->getEndYear(), $rdo->getEndYear());
        print_r($rdo->toArray());
    }

    function test_addWorkingExperience_startYearInFuture_stopOpreturnFalseAndAppendMessage() {
        $this->assertEquals(2, $this->talent->getWorkingExperienceCount());
        $request = $this->_createRequest('2018');
        $msg = $this->talent->addWorkingExperience($request);
        $this->assertInstanceOf('\Resources\ErrorMessage', $msg);
        $this->assertEquals(2, $this->talent->getWorkingExperienceCount());
//print_r($msg->toArray());
    }

    function test_addWorkingExperience_endYearBeforeStartYear_stopOpreturnFalseAndAppendMessage() {
        $this->assertEquals(2, $this->talent->getWorkingExperienceCount());
        $request = $this->_createRequest('2016', '2015');
        $msg = $this->talent->addWorkingExperience($request);
        $this->assertInstanceOf('\Resources\ErrorMessage', $msg);
        $this->assertEquals(2, $this->talent->getWorkingExperienceCount());
//print_r($msg->toArray());
    }

    function test_updateWorkingExperience_shouldChangeWorkingExperienceDataInPropertyAndReturnTrue() {
        $request = $this->_createRequest();
        $msg = $this->talent->updateWorkingExperience($this->convergain->getId(), $request);

        $this->assertTrue($msg);
        $rdo = $this->convergain->toReadDataObject();
        $this->assertEquals($request->getCompanyName(), $rdo->getCompanyName());
        $this->assertEquals($request->getPosition(), $rdo->getPosition());
        $this->assertEquals($request->getRole(), $rdo->getRole());
        $this->assertEquals($request->getStartYear(), $rdo->getStartYear());
        $this->assertEquals($request->getEndYear(), $rdo->getEndYear());
        print_r($rdo->toArray());
    }

    function test_updateWorkingExperience_startYearinFuture_stopOpreturnFalseAndAppendMessage() {
        $request = $this->_createRequest('2018');
        $msg = $this->talent->updateWorkingExperience($this->convergain->getId(), $request);
        $this->assertInstanceOf('\Resources\ErrorMessage', $msg);
//print_r($msg->toArray());
    }

    function test_updateWorkingExperience_endYearBeforeStartYear_stopOpreturnFalseAndAppendMessage() {
        $request = $this->_createRequest('2016', '2015');
        $msg = $this->talent->updateWorkingExperience($this->convergain->getId(), $request);
        $this->assertInstanceOf('\Resources\ErrorMessage', $msg);
//print_r($msg->toArray());
    }

    function test_updateWorkingExperience_workingExperienceNotFound_stopOpreturnFalseAndAppendMessage() {
        $request = $this->_createRequest();
        $msg = $this->talent->updateWorkingExperience(123, $request);
        $this->assertInstanceOf('\Resources\ErrorMessage', $msg);
//print_r($msg->toArray());
    }

    function test_updateWorkingExperience_workingExperienceAlreadyRemoved_stopOpreturnFalseAndAppendMessage() {
        $this->convergain->remove();
        $request = $this->_createRequest();
        $msg = $this->talent->updateWorkingExperience($this->convergain->getId(), $request);
        $this->assertInstanceOf('\Resources\ErrorMessage', $msg);
//print_r($msg->toArray());
    }

    function test_removeWorkingExperience_shouldRemoveWorkingExperienceInTalentPropertyAndReturnTrue() {
        $this->assertEquals(2, $this->talent->getWorkingExperienceCount());
        $this->assertFalse($this->convergain->getIsRemoved());
        $msg = $this->talent->removeWorkingExperience($this->convergain->getId());

        $this->assertTrue($msg);
        $this->assertEquals(1, $this->talent->getWorkingExperienceCount());
        $this->assertTrue($this->convergain->getIsRemoved());
    }

    function test_removeWorkingExperience_workingExperienceNotFound_stopOpReturnFalseAndAppendMessage() {
        $msg = $this->talent->removeWorkingExperience(123);
        $this->assertInstanceOf('\Resources\ErrorMessage', $msg);
        $this->assertEquals(2, $this->talent->getWorkingExperienceCount());
//print_r($msg->toArray());
    }

    function test_removeWorkingExperience_workingExperienceAlreadyRemoved_stopOpReturnFalseAndAppendMessage() {
        $this->convergain->remove();
        $msg = $this->talent->removeWorkingExperience($this->convergain->getId());
        $this->assertEquals(1, $this->talent->getWorkingExperienceCount());
        print_r($msg->toArray());
    }

    function test_aWorkingExperienceReadDataObjetOfId_shouldReturnWorkingExperienceReadDataObject() {
        $rdo = $this->talent->aWorkingExperienceReadDataObjectOfId($this->convergain->getId());
        $this->assertInstanceOf('\Talent\WorkingExperience\DomainModel\WorkingExperience\DataObject\WorkingExperienceReadDataObject', $rdo);
//print_r($rdo->toArray());
    }

    function test_aWorkingExperienceReadDataObjetOfId_WorkingExperienceNotFound_returnNull() {
        $this->assertNull($this->talent->aWorkingExperienceReadDataObjectOfId(123));
    }

    function test_aWorkingExperienceReadDataObjetOfId_WorkingExperienceAlreadyRemoved_returnNull() {
        $this->convergain->remove();
        $this->assertNull($this->talent->aWorkingExperienceReadDataObjectOfId($this->convergain->getId()));
    }

    function test_allWorkingExperienceReadDataObjet_shouldReturnArrayOfWorkingExperienceReadDataObject() {
        $rdos = $this->talent->allWorkingExperienceReadDataObject();
        $this->assertEquals(2, count($rdos));
        foreach ($rdos as $rdo) {
            $this->assertInstanceOf('\Talent\WorkingExperience\DomainModel\WorkingExperience\DataObject\WorkingExperienceReadDataObject', $rdo);
//print_r($rdo->toArray());
        }
    }

    function test_allWorkingExperienceReadDataObjet_NoWorkingExperience_returnEmptyArray() {
        $this->convergain->remove();
        $this->barapraja->remove();
        $this->assertEmpty($this->talent->allWorkingExperienceReadDataObject());
    }

}

use Doctrine\Common\Collections\Criteria;

class TestableTalent extends Talent {

    public function __construct() {
        $this->id = \Ramsey\Uuid\Uuid::uuid4()->toString();
        parent::__construct();
    }

    /**
     * @return WorkingExperience
     */
    function lastInsertedWorkingExperience() {
        return $this->workingExperiences->last();
    }

    function getWorkingExperienceCount() {
        $criteria = Criteria::create()
                ->where(Criteria::expr()->eq('isRemoved', false));
        return $this->workingExperiences->matching($criteria)->count();
    }

    function addManuallyWorkingExperience(WorkingExperience $workingExperience) {
        $this->workingExperiences->set($workingExperience->getId(), $workingExperience);
    }

}
