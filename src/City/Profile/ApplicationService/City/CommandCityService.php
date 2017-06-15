<?php

namespace City\Profile\ApplicationService\City;

use Resources\ResponseObject;
use Resources\ErrorMessage;
use Resources\Exception\DoNotCatchException;

use City\Profile\DomainModel\City\City;
use City\Profile\DomainModel\City\Service\CityAuthorizationService;
use City\Profile\DomainModel\City\Service\CityDataValidationService;
use City\Profile\DomainModel\City\Service\PreventDuplicateCityService;

use Personnel\DomainModel\Personnel\DataObject\PersonnelReadDataObject;


class CommandCityService {
    protected $repository;
    protected $personnelRdoRepository;
    protected $authorizationService;
    
    /**
     * @param \City\Profile\DomainModel\City\ICityRepository $cityRepository
     * @param \Personnel\ApplicationService\Personnel\PersonnelFinder $personnelFinder
     */
    public function __construct(
            \City\Profile\DomainModel\City\ICityRepository $cityRepository,
            \Personnel\DomainModel\Personnel\DataObject\IPersonnelRdoRepository $personnelRdoRepository
    ) {
        $this->repository = $cityRepository;
        $this->personnelRdoRepository = $personnelRdoRepository;
        $this->authorizationService = new CityAuthorizationService();
    }
    
    /**
     * @param type $personnelId
     * @param type $name
     * @return ResponseObject
     */
    function add($personnelId, $name){
        $response = new ResponseObject();
        $personnelRDO = $this->_findPersonnelRDO_orDie($personnelId);
        
        if(true !== $msg = $this->authorizationService->isAuthorizedToAdd($personnelRDO)){
            $response->appendErrorMessage($msg);
        }else if(true !== $msg = $this->_dataValidationService()->isValidToAdd($name)){
            $response->appendErrorMessage($msg);
        }else if(true !== $msg = $this->_preventDuplicateService()->isNotDuplicateName($name)){
            $response->appendErrorMessage($msg);
        }else{
            $city = new City($this->repository->nextIdentity(), $name);
            $this->repository->add($city);
        }
        return $response;
    }
    
    /**
     * @param type $personnelId
     * @param type $cityId
     * @param type $name
     * @return ResponseObject
     */
    function update($personnelId, $cityId, $name){
        $response = new ResponseObject();
        $personnelRDO = $this->_findPersonnelRDO_orDie($personnelId);
        $city = $this->_findCity($cityId);
        
        if(empty($city)){
            $response->appendErrorMessage(ErrorMessage::error404_NotFound(['city not found or already removed']));
        }else if(true !== $msg = $this->authorizationService->isAuthorizedToUpdate($personnelRDO)){
            $response->appendErrorMessage($msg);
        }else if(true !== $msg = $this->_dataValidationService()->isValidToUpdate($name)){
            $response->appendErrorMessage($msg);
        }else if($name !== $city->getName() &&
                true !== $msg = $this->_preventDuplicateService()->isNotDuplicateName($name)
        ){
            $response->appendErrorMessage($msg);
        }else{
            $city->change($name);
            $this->repository->update();
        }
        return $response;
    }
    
    /**
     * @param type $personnelId
     * @param type $cityId
     * @return ResponseObject
     */
    function remove($personnelId, $cityId){
        $response = new ResponseObject();
        $personnelRDO = $this->_findPersonnelRDO_orDie($personnelId);
        $city = $this->_findCity($cityId);
        
        if(empty($city)){
            $response->appendErrorMessage(ErrorMessage::error404_NotFound(['city not found or already removed']));
        }else if(true !== $msg = $this->authorizationService->isAuthorizedToRemove($personnelRDO)){
            $response->appendErrorMessage($msg);
        }else{
            $city->remove();
            $this->repository->update();
        }
        return $response;
    }
    
    /**
     * @return CityValidationService
     */
    protected function _validationService(){
        return new CityValidationService();
    }
    /**
     * @return PreventDuplicateCityService
     */
    protected function _preventDuplicateService(){
        return new PreventDuplicateCityService($this->repository);
    }
    /**
     * @return CityDataValidationService
     */
    protected function _dataValidationService(){
        return new CityDataValidationService();
    }
    /**
     * @param type $personnelId
     * @return PersonnelReadDataObject
     * @throws DoNotCatchException
     */
    protected function _findPersonnelRDO_orDie($personnelId){
        $personnelRDO = $this->personnelRdoRepository->ofId($personnelId);
        if(empty($personnelRDO)){
            throw new DoNotCatchException('personnel not found');
        }
        return $personnelRDO;
    }
    /**
     * @param type $cityId
     * @return City
     * @throws DoNotCatchException
     */
    protected function _findCityOrDie($cityId){
        $city = $this->repository->ofId($cityId);
        if($city instanceof City){
            return $city;
        }
        throw new DoNotCatchException('personnel not found');
    }
    /**
     * @param type $id
     * @return City
     */
    protected function _findCity($id){
        $city = $this->repository->ofId($id);
        if(empty($city)){
            return null;
        }
        return $city;
    }
}
