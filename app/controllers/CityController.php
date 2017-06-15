<?php

use Phalcon\Tag;

use City\Profile\ApplicationService\City\QueryCityService;
use City\Profile\ApplicationService\City\CommandCityService;

class CityController extends ManagerialControllerBase{

    function indexAction(){
        $service = $this->_queryCityService();
        $response = $service->showAll();
        if(false === $response->getStatus()){
            $this->displayErrorMessages($response->errorMessage()->getDetails());
        }
        $cityRdos = $response->arrayOfReadDataObject();
        $this->view->cities = $cityRdos;
    }
    
    function newAction(){
        
    }
    function addAction(){
        if(!$this->request->isPost()){
            return $this->forward('city/new');
        }
        $service = $this->_commandCityService();
        $name = strip_tags($this->request->getPost('name'));
        $response = $service->add($this->_getPersonnelId(), $name);
        if(false === $response->getStatus()){
            $this->displayErrorMessages($response->errorMessage()->getDetails());
            return $this->forward('city/new');
        }
        $this->flash->success('City Created');
        return $this->forward('city/index');
    }

    function editAction($cityId){
        $service = $this->_queryCityService();
        $response = $service->showById($cityId);
        if(false === $response->getStatus()){
            $this->displayErrorMessages($response->errorMessage()->getDetails());
            return $this->forward('city/index');
        }
        $cityRdo = $response->firstReadDataObject();
        Tag::displayTo('id',$cityRdo->getId());
        Tag::displayTo('name',$cityRdo->getName());
    }
    
    function updateAction(){
        if(!$this->request->isPost()){
            return $this->forward('city/index');
        }
        $id = strip_tags($this->request->getPost('id'));
        $name = strip_tags($this->request->getPost('name'));
        $service = $this->_commandCityService();
        $response = $service->update($this->_getPersonnelId(), $id, $name);
        if(false === $response->getStatus()){
            $this->displayErrorMessages($response->errorMessage()->getDetails());
        }else{
            $this->flash->success('City Updated');
        }
        return $this->forward('city/index');
    }
    
    function removeAction($cityId){
        $service = $this->_commandCityService();
        $response = $service->remove($this->_getPersonnelId(), $cityId);
        if(false === $response->getStatus()){
            $this->displayErrorMessages($response->errorMessage()->getDetails());
        } else{
            $this->flash->success('city removed');
        }
        return $this->forward('city/index');
    }
    
    protected function _cityRepository(){
        return $this->em->getRepository('City\Profile\DomainModel\City\City');
    }
    protected function _cityRdoRepository(){
        return $this->em->getRepository('\Superclass\DomainModel\City\CityReadDataObject');
    }
    protected function _queryCityService(){
        return new QueryCityService($this->_cityRdoRepository());
    }
    protected function _commandCityService(){
        return new CommandCityService($this->_cityRepository(), $this->_personnelRdoRepository());
    }
}