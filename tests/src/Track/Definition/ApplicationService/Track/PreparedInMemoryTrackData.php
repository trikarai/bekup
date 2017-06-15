<?php

namespace Tests\Track\Definition\ApplicationService\Track;

use Track\Definition\ApplicationService\Track\TrackFinder;

use Track\Definition\DomainModel\Track\Track;
use Track\Definition\DomainModel\Track\DataObject\TrackWriteDataObject;
use Track\Definition\Infrastructure\Persistence\InMemory\Track\InMemoryTrackRepository;


class PreparedInMemoryTrackData {
    protected $repository;
    protected $rdoRepository;
    protected $bisnis;
    protected $teknis;
    
    /** @return Track */
    function bisnis(){
        return $this->bisnis;
    }
    /** @return Track */
    function teknis(){
        return $this->teknis;
    }
    /** @return TestableTrackRepository */
    function repository(){
        return $this->repository;
    }
    /** @return TestableTrackRdoRespository */
    function rdoRepository(){
        return $this->rdoRepository;
    }
    function trackFinder(){
        return new TrackFinder($this->repository);
    }
    /**
     * @return \Superclass\ApplicationService\Track\BaseTrackFinder
     */
    function baseTrackFinder(){
        return new \Superclass\ApplicationService\Track\BaseTrackFinder($this->repository);
    }

    public function __construct() {
        $this->repository = new TestableTrackRepository();
        $this->_setBisnis();
        $this->_setTeknis();
        $this->rdoRepository = new TestableTrackRdoRespository($this->repository);
    }
    protected function _setBisnis(){
        $id = \Ramsey\Uuid\Uuid::uuid4()->toString();
        $request = TrackWriteDataObject::request('bisnis', 'track bisnis');
        $this->bisnis = new TestableTrack($id, $request);
        $this->repository->add($this->bisnis);
    }
    protected function _setTeknis(){
        $id = \Ramsey\Uuid\Uuid::uuid4()->toString();
        $request = TrackWriteDataObject::request('teknis', 'track teknis');
        $this->teknis = new TestableTrack($id, $request);
        $this->repository->add($this->teknis);
    }
}

class TestableTrack extends Track{
    
}
class TestableTrackRepository extends InMemoryTrackRepository{
    /**
     * @return Track
     */
    function getLastTrack(){
        return $this->tracks->last();
    }
}

use Superclass\DomainModel\Track\ITrackRdoRepository;

class TestableTrackRdoRespository implements ITrackRdoRepository{
    protected $trackRepository;
    
    public function __construct(\Track\Definition\DomainModel\Track\ITrackRepository $trackRepository) {
        $this->trackRepository = $trackRepository;
    }
    
    public function all() {
        $trackRdos = [];
        foreach($this->trackRepository->all() as $track){
            $trackRdos[] = $track->toReadDataObject();
        }
        return $trackRdos;
    }

    public function ofId($id) {
        $track = $this->trackRepository->ofId($id);
        if(empty($track)){
            return null;
        }
        return $track->toReadDataObject();
    }
}