<?php

namespace Tests\Team\Idea\DomainModel\Team;

use Team\Idea\DomainModel\Team\Team;
use Team\Idea\DomainModel\Idea\Idea;
use Team\Idea\DomainModel\Idea\DataObject\IdeaWriteDataObject;
use Team\Idea\DomainModel\Talent\Talent;
use Team\Idea\DomainModel\Superhero\Superhero;
use Team\Profile\DomainModel\Membership\Membership;

class TeamTest extends \PHPUnit_Framework_TestCase {

    protected $team;
    protected $talent;
    protected $membershipRDO;
    protected $maspoerIdea;
    protected $dartIdea;

    protected function setUp() {
        $this->team = new TestableTeam();
        $this->talent = new TestableTalent();
        $this->membershipRDO = new TestableTeamMemberReadDataObject(1, 'active', 'ceo', true, true, $this->talent->toReadDataObject());
//        $this->membershipRDO = (new TestableMembership(1, 'active', 'ceo', $this->talent->toReadDataObject(), $this->team, $isAdmin = true, $isCreator = false))->toTeamMemberReadDataObject();
        $this->team->addMembership($this->membershipRDO);

        $superheroRdo = (new TestableSuperhero())->toReadDataObject();
        $this->maspoerIdea = new Idea($this->team, 1, $this->_createRequest('maspoer'), $this->talent->toReadDataObject(), $superheroRdo);
        $this->dartIdea = new Idea($this->team, 2, $this->_createRequest('dart'), $this->talent->toReadDataObject());


        $this->team->addIdeaManually($this->maspoerIdea);
        $this->team->addIdeaManually($this->dartIdea);
    }

    protected function _createRequest($name) {
        return IdeaWriteDataObject::request($name, 'local problem', 'global trend relation', 'applied technology', 'ideal final result', 'value contradiction', 'used resource');
    }

    protected function _createSuperheroRdo() {
        return (new TestableSuperhero())->toReadDataObject();
    }

    function test_proposeIdea_firstIdeaToAdd_shouldAddIdeaToPropertyAndReturnTrue() {
        $this->assertEquals(2, $this->team->getCountOfIdea());
        $request = $this->_createRequest('formatic');
        $msg = $this->team->proposeIdea($this->membershipRDO->getId(), $request, $this->_createSuperheroRdo());

        $this->assertTrue($msg);
        $this->assertEquals(3, $this->team->getCountOfIdea());
        $idea = $this->team->lastIdea();
        $this->assertEquals(3, $idea->getId());
        $this->assertEquals($request->getName(), $idea->getName());
        print_r($idea->toReadDataObject()->toArray());
    }

    function test_proposeIdea_duplicateName_returnFalse() {
        $request = $this->_createRequest($this->maspoerIdea->getName());

        $msg = $this->team->proposeIdea($this->membershipRDO->getId(), $request);
        $this->assertInstanceOf('\Resources\ErrorMessage', $msg);
//print_r($msg->toArray());
    }

    function test_proposeIdea_duplicateNameWithRemovedIdea_processNormallyAndReturnTrue() {
        $this->maspoerIdea->remove();
        $request = $this->_createRequest($this->maspoerIdea->getName());
        $msg = $this->team->proposeIdea($this->membershipRDO->getId(), $request);
        $this->assertTrue($msg);
    }

    function test_proposeIdea_proposerInNotActive_returnErrorMessage() {
        $membershipRDO = new TestableTeamMemberReadDataObject(1, 'invited', 'cto', false, false, $this->talent->toReadDataObject());
//        $membershipRDO = new TestableTeamMemberReadDataObject(1, 'invited', 'cto', false, false, $this->team->toReadDataObject(), $this->talent->toReadDataObject());
//        $membershipRDO = TestableMembership::asInvited(1, 'ceo', $this->talent->toReadDataObject(), $this->team)->toTeamMemberReadDataObject();
        $this->team->addMembership($membershipRDO);
        $request = $this->_createRequest('formatic');
        $msg = $this->team->proposeIdea($membershipRDO->getId(), $request);
        $this->assertInstanceOf('\Resources\ErrorMessage', $msg);
//print_r($msg->toArray());
    }

    function test_updateIdea_shouldChangeIdeaInPropertyAndReturnTrue() {
        $request = IdeaWriteDataObject::request('formatic', 'formatic problem', 'formatic global', 'formatic tech', 'formatic final', 'formatic value', 'formatic resource');
        $msg = $this->team->updateIdea($this->membershipRDO->getId(), $this->dartIdea->getId(), $request);

        $this->assertTrue($msg);
        $rdo = $this->dartIdea->toReadDataObject();
        $this->assertEquals($request->getName(), $rdo->getName());
        $this->assertEquals($request->getIdealFinalResult(), $rdo->getIdealFinalResult());
//print_r($this->dartIdea->toReadDataObject()->toArray());
    }

    function test_updateIdea_ideaNotFound_returnFalse() {
        $request = $this->_createRequest('formatic');
        $msg = $this->team->updateIdea($this->membershipRDO->getId(), 13, $request);

        $this->assertInstanceOf('\Resources\ErrorMessage', $msg);
//print_r($msg->toArray());
    }

    function test_updateIdea_ideaAlreadyRemoved_returnFalse() {
        $this->dartIdea->remove();
        $request = $this->_createRequest('formatic');
        $msg = $this->team->updateIdea($this->membershipRDO->getId(), $this->dartIdea->getId(), $request);

        $this->assertInstanceOf('\Resources\ErrorMessage', $msg);
//print_r($msg->toArray());
    }

    function test_updateIdea_duplicateName_returnFalse() {
        $request = $this->_createRequest($this->maspoerIdea->getName());
        $msg = $this->team->updateIdea($this->membershipRDO->getId(), $this->dartIdea->getId(), $request);

        $this->assertInstanceOf('\Resources\ErrorMessage', $msg);
//print_r($msg->toArray());
    }

    function test_updateIdea_duplicateNameWithRemovedIdea_updateNormally() {
        $this->maspoerIdea->remove();
        $request = $this->_createRequest($this->maspoerIdea->getName());
        $msg = $this->team->updateIdea($this->membershipRDO->getId(), $this->dartIdea->getId(), $request);
        $this->assertTrue($msg);
    }

    function test_updateIdea_proposerNotActive_returnErrorMessage() {
        $membershipRDO = new TestableTeamMemberReadDataObject(1, 'invited', 'cco', false, false, $this->talent->toReadDataObject());
//        $membershipRDO = new TestableTeamMemberReadDataObject(1, 'invited', 'cco', false, false, $this->team->toReadDataObject(), $this->talent->toReadDataObject());
        $this->team->addMembership($membershipRDO);
        $request = $this->_createRequest($this->maspoerIdea->getName());
        $msg = $this->team->updateIdea($membershipRDO->getId(), $this->dartIdea->getId(), $request);

        $this->assertInstanceOf('\Resources\ErrorMessage', $msg);
//print_r($msg->toArray());
    }

    function test_removeIdea_shouldRemoveIdeaFromProperty() {
        $this->assertFalse($this->maspoerIdea->getIsRemoved());
        $msg = $this->team->removeIdea($this->membershipRDO->getId(), $this->maspoerIdea->getId());
        $this->assertEquals(1, $this->team->getCountOfIdea());
        $this->assertTrue($this->maspoerIdea->getIsRemoved());
    }

    function test_removeIdea_ideaNotFound_returnFalse() {
        $msg = $this->team->removeIdea($this->membershipRDO->getId(), 13);
        $this->assertInstanceOf('\Resources\ErrorMessage', $msg);
//print_r($msg->toArray());
    }

    function test_removeIdea_activeMemberhipNotFound_returnErrorMessage() {
        $membershipRDO = new TestableTeamMemberReadDataObject(1, 'invited', 'ceo', false, false, $this->talent->toReadDataObject());
//        $membershipRDO = new TestableTeamMemberReadDataObject(1, 'invited', 'ceo', false, false, $this->team->toReadDataObject(), $this->talent->toReadDataObject());
        $this->team->addMembership($membershipRDO);
        $msg = $this->team->removeIdea($membershipRDO->getId(), 13);
        $this->assertInstanceOf('\Resources\ErrorMessage', $msg);
//print_r($msg->toArray());
    }

    function test_removeIdea_ideaAlreadyRemoved_returnFalse() {
        $this->maspoerIdea->remove();
        $msg = $this->team->removeIdea($this->membershipRDO->getId(), $this->maspoerIdea->getId());
        $this->assertInstanceOf('\Resources\ErrorMessage', $msg);
//print_r($msg->toArray());
    }

    function test_anIdeaRdoOfId_returnIDeaRDO() {
        $rdo = $this->team->anIdeaRdoOfId($this->maspoerIdea->getId());
        $this->assertInstanceOf('\Team\Idea\DomainModel\Idea\DataObject\IdeaReadDataObject', $rdo);
//print_r($rdo->toArray());
    }

    function test_anIdeaRdoOfId_ideaNotFound_returnNull() {
        $rdo = $this->team->anIdeaRdoOfId(12);
        $this->assertNull($rdo);
    }

    function test_anIdeaRdoOfId_ideaAlreadyRemoved_returnFalseAndSetMessage() {
        $this->maspoerIdea->remove();
        $rdo = $this->team->anIdeaRdoOfId($this->maspoerIdea->getId());
        $this->assertNull($rdo);
    }

    function test_allIdeaRdo_shouldReturnArrayOfIdeaRdos() {
        $rdos = $this->team->allIdeaRdo();
        $this->assertEquals(2, count($rdos));
        foreach ($rdos as $rdo) {
            $this->assertInstanceOf('\Team\Idea\DomainModel\Idea\DataObject\IdeaReadDataObject', $rdo);
            print_r($rdo->toArray());
        }
    }

}

class TestableSuperhero extends Superhero {

    public function __construct() {
        
    }

}

use City\Profile\DomainModel\City\City;
use Track\Definition\DomainModel\Track\Track;
use Track\Definition\DomainModel\Track\DataObject\TrackWriteDataObject;

class TestableTalent extends Talent {

    public function __construct() {
        $this->id = \Ramsey\Uuid\Uuid::uuid4()->toString();
        $this->birthDate = new \DateTime("now");
        $this->cityRDO = (new City(\Ramsey\Uuid\Uuid::uuid4()->toString(), 'bandung'))->toReadDataObject();
        $this->trackRDO = (new Track(\Ramsey\Uuid\Uuid::uuid4()->toString(), TrackWriteDataObject::request('teknis', 'track description')))->toReadDataObject();
        parent::__construct();
    }

}

use Superclass\DomainModel\Team\TeamMemberReadDataObject;

class TestableTeamMemberReadDataObject extends TeamMemberReadDataObject {

    public function __construct($id, $status, $position, $isAdmin, $isCreator, \Superclass\DomainModel\Talent\TalentReadDataObject $talentRDO) {
        parent::__construct($id, $status, $position, $isAdmin, $isCreator, $talentRDO);
    }

}

class TestableMembership extends Membership {

    protected function __construct($id, $status, $position, \Team\Profile\DomainModel\Talent\Talent $talent, \Team\Profile\DomainModel\Team\Team $team, $isAdmin = false, $isCreator = false) {
        parent::__construct($id, $status, $position, $talent, $team, $isAdmin, $isCreator);
    }

}
