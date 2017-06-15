<?php

namespace Tests\Personnel\ApplicationService\Personnel;

use Personnel\Infrastructure\Persistence\InMemory\Personnel\InMemoryPersonnelRepository;
use Personnel\ApplicationService\Personnel\PersonnelFinder;
use Personnel\DomainModel\Personnel\Personnel;
use Personnel\DomainModel\Personnel\DataObject\PersonnelWriteDataObject;
use Personnel\DomainModel\Personnel\ValueObject\PersonnelPassword;

class PreparedInMemoryPersonnelData {
    protected $repository;
    protected $rdoRepository;
    protected $director;
    protected $trackCoordinator;
    
    public function __construct() {
        $this->repository = new TestablePersonnelRepository();
        $this->_setDirector();
        $this->_setTrackCoordinator();
        $this->rdoRepository = new TestablePersonnelRdoRepository($this->repository);
    }
    protected function _setDirector(){
        $id = \Ramsey\Uuid\Uuid::uuid4()->toString();
        $request = PersonnelWriteDataObject::asDirectorRequest('apur', 'adi@email.org', '123');
        $password = PersonnelPassword::fromNative('123');
        $this->director = Personnel::createDirector($id, $request, $password);
        $this->repository->add($this->director);
    }
    protected function _setTrackCoordinator(){
        $id = \Ramsey\Uuid\Uuid::uuid4()->toString();
        $trackId = \Ramsey\Uuid\Uuid::uuid4()->toString();
        $request = PersonnelWriteDataObject::asTrackCoordinatorRequest('igun', 'inandar@email.org', 'abc', $trackId);
//        $request = PersonnelWriteDataObject::addDirectorDataObject('igun', 'inandar@email.org', 'abc');
        $password = PersonnelPassword::fromNative('abc');
        $trackRDO = new TestableTrackRDO();
        $this->trackCoordinator = Personnel::createTrackCoordinator($id, $request, $password, $trackRDO);
//        $this->igun = Personnel::createDirector($id, $request, $password);
        $this->repository->add($this->trackCoordinator);
    }
    
    /**
     * @return TestablePersonnelRepository
     */
    function getRepository(){
        return $this->repository;
    }
    /**
     * @return TestablePersonnelRdoRepository
     */
    function rdoRepository(){
        return $this->rdoRepository;
    }
    /**
     * @return Personnel
     */
    function getDirector(){
        return $this->director;
    }
    /**
     * @return Personnel
     */
    function getTrackCoordinator(){
        return $this->trackCoordinator;
    }
    /**
     * @return PersonnelFinder
     */
    function personnelFinder(){
        return new PersonnelFinder($this->getRepository());
    }
}

use Superclass\DomainModel\Track\TrackReadDataObject;
class TestableTrackRDO extends TrackReadDataObject{
    public function __construct() {
        
    }
}

class TestablePersonnelRepository extends InMemoryPersonnelRepository{
    /**
     * @return Personnel
     */
    function getLastPersonnel() {
        return $this->personnels->last();
    }
}

use Personnel\DomainModel\Personnel\DataObject\IPersonnelRdoRepository;
class TestablePersonnelRdoRepository implements IPersonnelRdoRepository{
    protected $personnelRepository;
    public function __construct(\Personnel\DomainModel\Personnel\IPersonnelRepository $personnelRepository) {
        $this->personnelRepository = $personnelRepository;
    }
    
    public function all() {
        $personnels = $this->personnelRepository->all();
        $personnelRdos = [];
        foreach($personnels as $personnel){
            $personnelRdos[] = $personnel->toReadDataObject();
        }
        return $personnelRdos;
    }

    public function ofId($id) {
        $personnel = $this->personnelRepository->ofId($id);
        if(empty($personnel)){
            return null;
        }
        return $personnel->toReadDataObject();
    }

}


