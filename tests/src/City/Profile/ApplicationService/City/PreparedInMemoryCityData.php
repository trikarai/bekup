<?php

namespace Tests\City\Profile\ApplicationService\City;

use City\Profile\ApplicationService\City\CityFinder;
use City\Profile\DomainModel\City\City;
use City\Profile\Infrastructure\Persistence\InMemory\City\InMemoryCityRepository;

class PreparedInMemoryCityData {
    protected $repository;
    protected $rdoRepository;
    protected $bandung;
    protected $jakarta;
    
    /** @return TestableCityRepository */
    function repository(){
        return $this->repository;
    }
    /** @return TestableCityRdoRepository */
    function rdoRepository(){
        return $this->rdoRepository;
    }
    /** @return City */
    function bandung(){
        return $this->bandung;
    }
    /** @return City */
    function jakarta(){
        return $this->jakarta;
    }
    /** @return CityFinder */
    function cityFinder(){
        return new CityFinder($this->repository);
    }
    /**
     * @return \Superclass\ApplicationService\City\BaseCityFinder
     */
    function baseCityFinder(){
        return new \Superclass\ApplicationService\City\BaseCityFinder($this->repository);
    }
    
    public function __construct() {
        $this->repository = new TestableCityRepository();
        $this->_setBandung();
        $this->_setJakarta();
        $this->rdoRepository = new TestableCityRdoRepository($this->repository);
    }
    protected function _setBandung(){
        $id = \Ramsey\Uuid\Uuid::uuid4()->toString();
        $name = 'bandung';
        $this->bandung = new City($id, $name);
        $this->repository->add($this->bandung);
    }
    protected function _setJakarta(){
        $id = \Ramsey\Uuid\Uuid::uuid4()->toString();
        $name = 'jakarta';
        $this->jakarta = new City($id, $name);
        $this->repository->add($this->jakarta);
    }
}

class TestableCityRepository extends InMemoryCityRepository{
    /**
     * @return City
     */
    function lastInsertedCity(){
        return $this->cities->last();
    }
}

use Superclass\DomainModel\City\ICityRdoRepository;

class TestableCityRdoRepository implements ICityQueryRepository{
    protected $cityRepository;
    public function __construct(\City\Profile\DomainModel\City\ICityRepository $cityRepository) {
        $this->cityRepository = $cityRepository;
    }
    public function all() {
        $cities = $this->cityRepository->all();
        $cityRdos = [];
        foreach($cities as $city){
            $cityRdos[] = $city->toReadDataObject();
        }
        return $cityRdos;
    }

    public function ofId($id) {
        $city = $this->cityRepository->ofId($id);
        if(empty($city)){
            return null;
        }
        return $city->toReadDataObject();
    }

}

