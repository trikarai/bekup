<?php

namespace Tests\Team\Idea\DomainModel\Talent;

use Team\Idea\DomainModel\Superhero\DataObject\SuperheroWriteDataObject;
use Team\Idea\DomainModel\Talent\Talent;
use Team\Idea\DomainModel\Superhero\Superhero;

class TalentTest extends \PHPUnit_Framework_TestCase {

    protected $talent;
    protected $batman;

    protected function setUp() {
        $this->talent = new TestableTalent();
        $batmanWriteDataObject = SuperheroWriteDataObject::request('batman', 'main duty', 'special ability', 'daily activity', 'alternative technology');
        $this->talent->addSuperhero($batmanWriteDataObject);
        $this->batman = $this->talent->getLastSuperhero();
    }

    protected function _createRequest($name = 'goku') {
        return SuperheroWriteDataObject::request($name, 'fight', 'kamehameha', 'training', 'nuclear bomb');
    }

    function test_addSuperhero_shouldAddToProperty() {
        $this->assertEquals(1, $this->talent->getCountOfSuperhero());
        $request = $this->_createRequest();
        $msg = $this->talent->addSuperhero($request);

        $this->assertTrue($msg);
        $this->assertEquals(2, $this->talent->getCountOfSuperhero());
        $gokuRdo = $this->talent->getLastSuperhero()->toReadDataObject();
        $this->assertEquals(2, $gokuRdo->getId());
        $this->assertEquals('goku', $gokuRdo->getName());
        $this->assertEquals('fight', $gokuRdo->getMainDuty());
        $this->assertEquals('kamehameha', $gokuRdo->getSpecialAbility());
        $this->assertEquals('training', $gokuRdo->getDailyActivity());
        $this->assertEquals('nuclear bomb', $gokuRdo->getAlternativeTechnology());
    }

    function test_addSuperhero_duplicateName_cancelAddAndSetMessageObjectStatusFalse() {
        $this->assertEquals(1, $this->talent->getCountOfSuperhero());
        $request = $this->_createRequest($this->batman->getName());

        $msg = $this->talent->addSuperhero($request);
        $this->assertInstanceOf('\Resources\ErrorMessage', $msg);
        $this->assertEquals(1, $this->talent->getCountOfSuperhero());
//print_r($msg->toArray());
    }

    function test_addSuperhero_duplicateNameButAlreadyRemoved_AddNormally() {
        $this->batman->remove();
        $this->assertEquals(0, $this->talent->getCountOfSuperhero());

        $request = $this->_createRequest();
        $msg = $this->talent->addSuperhero($request);
        $this->assertTrue($msg);
        $this->assertEquals(1, $this->talent->getCountOfSuperhero());
    }

    function test_updateSuperhero_shouldUpdateDataInProperty() {
        $request = $this->_createRequest();
        $this->assertTrue($this->talent->updateSuperhero($this->batman->getId(), $request));

        $rdo = $this->batman->toReadDataObject();
        $this->assertEquals($request->getName(), $rdo->getName());
        $this->assertEquals($request->getAlternativeTechnology(), $rdo->getAlternativeTechnology());
        $this->assertEquals($request->getDailyActivity(), $rdo->getDailyActivity());
        $this->assertEquals($request->getMainDuty(), $rdo->getMainDuty());
        $this->assertEquals($request->getSpecialAbility(), $rdo->getSpecialAbility());
    }

    function test_updateSuperhero_superheroNotFound_throwDoNotCatchException() {
        $request = $this->_createRequest();
        $msg = $this->talent->updateSuperhero(13, $request);
        $this->assertInstanceOf('\Resources\ErrorMessage', $msg);
//print_r($msg->toArray());
    }

    function test_updateSuperhero_duplicateName_cancelUPdateAndSetMessageObjectStatusFalse() {
        $request = $this->_createRequest();
        $this->talent->addSuperhero($request);

        $msg = $this->talent->updateSuperhero($this->batman->getId(), $request);
        $this->assertInstanceOf('\Resources\ErrorMessage', $msg);
//print_r($msg->toArray());
    }

    function test_updateSuperhero_sameNameAsBefore_updateOtherArgumentNormally() {
        $request = $this->_createRequest($this->batman->getName());
        $msg = $this->talent->updateSuperhero($this->batman->getId(), $request);
        $rdo = $this->batman->toReadDataObject();
        $this->assertEquals($request->getName(), $rdo->getName());
        $this->assertEquals($request->getAlternativeTechnology(), $rdo->getAlternativeTechnology());
        $this->assertEquals($request->getDailyActivity(), $rdo->getDailyActivity());
        $this->assertEquals($request->getMainDuty(), $rdo->getMainDuty());
        $this->assertEquals($request->getSpecialAbility(), $rdo->getSpecialAbility());
    }

    function test_removeSuperhero_shouldChangeIsRemoveStatus() {
        $this->assertFalse($this->batman->getIsRemoved());
        $msg = $this->talent->removeSuperhero($this->batman->getId());

        $this->assertTrue($msg);
        $this->assertTrue($this->batman->getIsRemoved());
    }

    function test_superheroNotFound_returnErrorMEssage() {
        $msg = $this->talent->removeSuperhero(12);
        $this->assertInstanceOf('\Resources\ErrorMessage', $msg);
        print_r($msg->toArray());
    }

    function test_allSuperheroRDOs_shouldReturnArrayOfSuperheroRDO() {
        $request = $this->_createRequest();
        $this->talent->addSuperhero($request);

        $superheroRDOs = $this->talent->allSuperheroRdos();
        $this->assertEquals(2, count($superheroRDOs));
        foreach ($superheroRDOs as $rdo) {
            $this->assertInstanceOf('\Team\Idea\DomainModel\Superhero\DataObject\SuperheroReadDataObject', $rdo);
//print_r($rdo->toArray());            
        }
    }

    function test_getSuperheroRDOs_noActiveSuperhero_returnEmptyArray() {
        $this->batman->remove();
        $this->assertEmpty($this->talent->allSuperheroRdos());
    }

    function test_aSupeheroRDOOfId_shouldReturnSuperheroRDO() {
        $superheroRDO = $this->talent->aSuperheroRdoById($this->batman->getId());
        $this->assertInstanceOf('\Team\Idea\DomainModel\Superhero\DataObject\SuperheroReadDataObject', $superheroRDO);
    }

    function test_aSuperheroRDOOfId_superheroNotFound_returnNull() {
        $this->assertNull($this->talent->aSuperheroRdoById(12));
    }

}

class TestableSuperhero extends Superhero {

    public function __construct($id, SuperheroCommandObject $command) {
        parent::__construct($id, $command);
    }

}

use Doctrine\Common\Collections\Criteria;

class TestableTalent extends Talent {

    public function __construct() {
        parent::__construct();
    }

    function setSuperheroManually(Superhero $superhero) {
        $this->superheroes->set($superhero->getId(), $superhero);
    }

    function getCountOfSuperhero() {
        $criteria = Criteria::create()
                ->where(Criteria::expr()->eq('isRemoved', false));
        return $this->superheroes->matching($criteria)->count();
    }

    /**
     * @return TestableSuperhero
     */
    function getLastSuperhero() {
        return $this->superheroes->last();
    }

}
