<?php

namespace Tests\City\Programme\Description\DomainModel\City\Event;
use City\Programme\Description\DomainModel\City\Event\ProgrammeWasCreatedSubscriber;
use City\Programme\Description\DomainModel\City\ICityRepository;
use City\Programme\Description\DomainModel\City\City;
use Doctrine\Common\Collections\Criteria;

class ProgrammeWasCreatedSubscriberTest extends \PHPUnit_Framework_TestCase {
    protected $subscriber;
    protected $cityRepository;
    /** @var TestableCity */
    protected $bandung;
    /** @var TestableCity */
    protected $jakarta;
    
    protected function setUp() {
        $this->cityRepository = new TestableInMemoryCityRepository();
        $this->_setBandung();
        $this->_setJakarta();
        $this->subscriber = new ProgrammeWasCreatedSubscriber($this->cityRepository);
    }
    protected function _setBandung(){
        $this->bandung = new TestableCity(\Ramsey\Uuid\Uuid::uuid4()->toString());
        $this->cityRepository->addManually($this->bandung);
    }
    protected function _setJakarta(){
        $this->jakarta = new TestableCity(\Ramsey\Uuid\Uuid::uuid4()->toString());
        $this->cityRepository->addManually($this->jakarta);
    }
    protected function _generateProgrammeWasCreatedEvent(){
        $id = \Ramsey\Uuid\Uuid::uuid4()->toString();
        $name = 'programme 2018';
        $registrationStartDate = '2018-01-01';
        $registrationEndDate = '2018-01-31';
        $operationStartDate = '2018-02-01';
        $operationEndDate = '2018-12-31';
        $isRemoved = false;
        $programmeRDO = new \Programme\Description\DomainModel\Programme\DataObject\ProgrammeReadDataObject($id, $name, $registrationStartDate, $registrationEndDate, $operationStartDate, $operationEndDate, $isRemoved);
        return new \Programme\Description\DomainModel\Programme\Event\ProgrammeWasCreatedEvent($programmeRDO);
    }
    
    function test_handle_shouldAddProgrammeToEachCity() {
        $this->assertEquals(0, $this->bandung->getCountOfProgramme());
        $this->assertEquals(0, $this->jakarta->getCountOfProgramme());
        
        $this->subscriber->handle($this->_generateProgrammeWasCreatedEvent());
        $this->assertEquals(1, $this->bandung->getCountOfProgramme());
        $this->assertEquals(1, $this->jakarta->getCountOfProgramme());
    }
    function test_handle_ErrorWhenAddCityProgramme_throwException() {
        $this->setExpectedException('\Exception', 'Error When Add Programme');
        $this->jakarta->markAddProgrammeError = true;
        $this->subscriber->handle($this->_generateProgrammeWasCreatedEvent());
    }
}

class TestableCity extends City{
    public $markAddProgrammeError = false;
    
    public function __construct($id) {
        $this->id = $id;
        parent::__construct();
    }
    function addProgramme(\Programme\Description\DomainModel\Programme\DataObject\ProgrammeReadDataObject $referenceProgrammeRDO, $isOffline = false) {
        if($this->markAddProgrammeError){
            return \Resources\ErrorMessage::error500_InternalServerError(['Error When Add Programme']);
        }
        return parent::addProgramme($referenceProgrammeRDO, $isOffline);
    }
    function getCountOfProgramme(){
        $criteria = Criteria::create()
                ->where(Criteria::expr()->eq('isRemoved', false));
        return $this->programmes->matching($criteria)->count();
    }
}

class TestableInMemoryCityRepository implements ICityRepository{
    protected $cities = [];
    
    public function __construct() {
        $this->cities = new \Doctrine\Common\Collections\ArrayCollection();
    }
    public function addManually(City $city) {
        $this->cities->set($city->getId(), $city);
    }
    
    /**
     * @return City
     */
    public function all() {
        $criteria = Criteria::create()
                ->where(Criteria::expr()->eq('isRemoved', false));
        return $this->cities->matching($criteria)->toArray();
    }

    public function ofId($id) {
        
    }

    public function update() {
        
    }
}