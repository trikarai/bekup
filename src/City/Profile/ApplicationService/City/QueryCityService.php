<?php

namespace City\Profile\ApplicationService\City;

use Resources\ErrorMessage;

class QueryCityService {
    protected $repository;
    
    public function __construct(\Superclass\DomainModel\City\ICityRdoRepository $cityRdoRepository) {
        $this->repository = $cityRdoRepository;
    }
    
    /**
     * @param type $cityId
     * @return \City\Profile\ApplicationService\City\CityQueryResponseObject
     */
    function showById($cityId){
        $response = new CityQueryResponseObject();
        $cityRdo = $this->repository->ofId($cityId);
        if(empty($cityRdo)){
            $response->appendErrorMessage(ErrorMessage::error404_NotFound(['city not found or already removed']));
        }else{
            $response->setReadDataObject($cityRdo);
        }
        return $response;
    }
    
    /**
     * @return CityMessageObject
     */
    function showAll(){
        $response = new CityQueryResponseObject();
        $cityRdos = $this->repository->all();
        if(empty($cityRdos)){
            $response->appendErrorMessage(ErrorMessage::error404_NotFound(['no city found']));
        }else{
            $response->setBulkReadDataObject($cityRdos);
        }
        return $response;
    }
}
