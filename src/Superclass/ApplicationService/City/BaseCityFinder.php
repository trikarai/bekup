<?php

namespace Superclass\ApplicationService\City;

use Superclass\DomainModel\City\CityReadDataObject;

class BaseCityFinder {
    protected $repository;
    
    /**
     * @param \Superclass\DomainModel\City\IBaseCityRepository $cityRepository
     */
    public function __construct(\Superclass\DomainModel\City\IBaseCityRepository $cityRepository) {
        $this->repository = $cityRepository;
    }
    
    /**
     * @param type $id
     * @return CityReadDataObject||null
     */
    function findCityRDO($id){
        $city = $this->repository->ofId($id);
        if(empty($city)){
            return null;
        }
        return $city->toReadDataObject();
    }
}
