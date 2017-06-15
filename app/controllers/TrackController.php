<?php
use Phalcon\Tag as Tag;

use Track\Definition\ApplicationService\Track\QueryTrackService;
use Track\Definition\ApplicationService\Track\CommandTrackService;
use Track\Definition\DomainModel\Track\DataObject\TrackWriteDataObject;

class TrackController extends ManagerialControllerBase{
    
    function indexAction(){
        $service = $this->_queryTrackService();
        $response = $service->showAll();
        if(false === $response->getStatus()){
            $this->displayErrorMessages($response->errorMessage()->getDetails());
        }
        $this->view->trackRdos = $response->arrayOfReadDataObject();
    }
    
    function newAction(){
        if($this->request->isPost()){
            Tag::displayTo('name', $this->request->getPost('name'));
            Tag::displayTo('description', $this->request->getPost('description'));
        }
    }
    function addAction(){
        if(!$this->request->isPost()){
            return $this->forward('track/new');
        }
        $service = $this->_commandTrackService();
        $response = $service->add($this->_getPersonnelId(), $this->_getRequest());
        if(false === $response->getStatus()){
            $this->displayErrorMessages($response->errorMessage()->getDetails());
            return $this->forward('track/new');
        }
        $this->flash->success('track created');
        return $this->forward('track/index');
    }

    function editAction($trackId){
        $service = $this->_queryTrackService();
        $response = $service->showById($trackId);
        if(false === $response->getStatus()){
            $this->displayErrorMessages($response->errorMessage()->getDetails());
            return $this->forward('track/index');
        }
        $trackRdo = $response->firstReadDataObject();
        Tag::displayTo('id',$trackRdo->getId());
        Tag::displayTo('name',$trackRdo->getName());
        Tag::displayTo('description',$trackRdo->getDescription());
    }
    
    function updateAction(){
        if(!$this->request->isPost()){
            return $this->forward('track/index');
        }
        $trackId = strip_tags($this->request->getPost('id'));
        
        $service = $this->_commandTrackService();
        $response = $service->update($this->_getPersonnelId(), $trackId, $this->_getRequest());
        if(false === $response->getStatus()){
            $this->displayErrorMessages($response->errorMessage()->getDetails());
        }else{
            $this->flash->success('track updated');
        }
        return $this->forward('track/index');
    }
    
    function removeAction($trackId){
        $service = $this->_commandTrackService();
        $response = $service->remove($this->_getPersonnelId(), $trackId);
        if(false === $response->getStatus()){
            $this->displayErrorMessages($response->errorMessage()->getDetails());
        }else{
            $this->flash->success('Track Removed');
        }
        return $this->forward('track/index');
    }
    
    protected function _queryTrackService(){
        $trackRdoRepository = $this->em->getRepository('\Superclass\DomainModel\Track\TrackReadDataObject');
        return new QueryTrackService($trackRdoRepository);
    }
    protected function _commandTrackService(){
        $trackRepository = $this->em->getRepository('\Track\Definition\DomainModel\Track\Track');
        return new CommandTrackService($trackRepository, $this->_personnelRdoRepository());
    }
    protected function _getRequest(){
        $name = strip_tags($this->request->getPost('name'));
        $description = strip_tags($this->request->getPost('description'));
        return TrackWriteDataObject::request($name, $description);
    }
}
