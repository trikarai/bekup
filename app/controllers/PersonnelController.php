<?php

use Phalcon\Tag;

use Personnel\ApplicationService\Personnel\AddPersonnelServiceAbstract;
use Personnel\ApplicationService\Personnel\AddDirectorService;
use Personnel\ApplicationService\Personnel\AddTrackCoordinatorService;
use Personnel\ApplicationService\Personnel\AddRegionCoordinatorService;
use Personnel\ApplicationService\Personnel\AddTutorService;
use Personnel\ApplicationService\Personnel\QueryPersonnelService;
use Personnel\ApplicationService\Personnel\RemovePersonnelService;
use Personnel\DomainModel\Personnel\DataObject\PersonnelWriteDataObject;
use Track\Definition\ApplicationService\Track\QueryTrackService;
use City\Profile\ApplicationService\City\QueryCityService;

class PersonnelController extends ManagerialControllerBase {

    public function indexAction(){
        $service = $this->_queryPersonnelService();
        $response = $service->showAll();
        if(false === $response->getStatus()){
            $this->displayErrorMessages($response->errorMessage()->getDetails());
        }
        $this->view->personnelRdos = $response->arrayOfReadDataObject();
        $this->view->sessionId = $this->_getPersonnelId();
    }
    
    public function newAction(){
        $roleList = array(
            "Director" => "Director",
            "TrackCoordinator" => "Track Coordinator",
            "RegionCoordinator" => "Region Coordinator",
            "Tutor" => "Tutor",
        );
        $this->view->roles = $roleList;
        $this->view->cityList = $this->_getCityList();
        $this->view->trackList= $this->_getTrackList();
    }

    public function addAction(){
        if(!$this->request->isPost()){
            return $this->forward('personnel/index');
        }
        $role = strip_tags($this->request->getPost("role"));
        $service = $this->_addPersonnelService($role);
        $response = $service->execute($this->_getPersonnelId(), $this->_getAddRequest($role));
        if(false === $response->getStatus()){
            $this->displayErrorMessages($response->errorMessage()->getDetails());
        }else{
            $this->flash->success("personnel created");
        }
        return $this->forward('personnel/index');
    }
    
    public function editAction($personnelId) {
    }
    
    public function updateAction () {
    }
    
    public function removeAction($personnelId){
        $service = new RemovePersonnelService($this->_personnelRepository());
        $response = $service->execute($this->_getPersonnelId(), $personnelId);
        if(false === $response->getStatus()){
            $this->displayErrorMessages($response->errorMessage()->getDetails());
        }else{
            $this->flash->success("personnel removed");
        }
        return $this->forward("Personnel/index");
    }
    
    protected function _personnelRepository(){
        return $this->em->getRepository('\Personnel\DomainModel\Personnel\Personnel');
    }
    protected function _cityRdoRepository(){
        return $this->em->getRepository('\Superclass\DomainModel\City\CityReadDataObject');
    }
    protected function _trackRdoRepository(){
        return $this->em->getRepository('\Superclass\DomainModel\Track\TrackReadDataObject');
    }
    
    protected function _getCityList(){
        $service = new QueryCityService($this->_cityRdoRepository());
        $response = $service->showAll();
        if(false === $response->getStatus()){
            $this->displayErrorMessages($response->errorMessage()->getDetails());
        }
        $cityList = [];
        foreach($response->arrayOfReadDataObject() as $cityRdo){
            $cityList[$cityRdo->getId()] = $cityRdo->getName();
        }
        return $cityList;
    }
    protected function _getTrackList(){
        $service = new QueryTrackService($this->_trackRdoRepository());
        $response = $service->showAll();
        if(false === $response->getStatus()){
            $this->displayErrorMessages($response->errorMessage()->getDetails());
        }
        $trackList = [];
        foreach($response->arrayOfReadDataObject() as $trackRdo){
            $trackList[$trackRdo->getId()] = $trackRdo->getName();
        }
        return $trackList;
    }
    
    /**
     * @param type $role
     * @return AddPersonnelServiceAbstract
     */
    protected function _addPersonnelService($role){
        switch($role){
            case "Director":
                return new AddDirectorService($this->_personnelRepository());
            case "TrackCoordinator":
                return new AddTrackCoordinatorService($this->_personnelRepository(), $this->_trackRdoRepository());
            case "RegionCoordinator":
                return new AddRegionCoordinatorService($this->_personnelRepository(), $this->_cityRdoRepository());
            case "Tutor":
                return new AddTutorService($this->_personnelRepository(), $this->_trackRdoRepository(), $this->_cityRdoRepository());
        }
    }
    protected function _queryPersonnelService(){
        return new QueryPersonnelService($this->_personnelRdoRepository());
    }
    
    protected function _getAddRequest($role){
        $name = strip_tags($this->request->getPost("name"));
        $email = strip_tags($this->request->getPost("email"));
        $password = strip_tags($this->request->getPost("password"));
        switch($role){
            case "Director":
                return PersonnelWriteDataObject::asDirectorRequest($name, $email, $password);
            case "TrackCoordinator":
                $trackId = strip_tags($this->request->getPost("track_id"));
                return PersonnelWriteDataObject::asTrackCoordinatorRequest($name, $email, $password, $trackId);
            case "RegionCoordinator":
                $cityId = strip_tags($this->request->getPost("city_id"));
                return PersonnelWriteDataObject::asRegionCoordinatorRequest($name, $email, $password, $cityId);
            case "Tutor":
                $trackId = strip_tags($this->request->getPost("track_id"));
                $cityId = strip_tags($this->request->getPost("city_id"));
                return PersonnelWriteDataObject::asTutorRequest($name, $email, $password, $cityId, $trackId);
        }
    }
}
     
