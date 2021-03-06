<?php

namespace Talent;

use Phalcon\Tag;

use Talent\Training\ApplicationService\Training\CommandTrainingService;
use Talent\Training\ApplicationService\Training\QueryTrainingService;
use Talent\Training\DomainModel\Training\DataObject\TrainingWriteDataObject;

class TrainingController extends \TalentControllerBase{
    public function newAction(){
        $this->view->pick('talent/training/new');
    }
    
    public function saveAction(){
        if(!$this->request->isPost()){
            return $this->forward('profile/index');
        }
        $service = $this->_commandTrainingService();
        $response = $service->add($this->_getTalentId(), $this->_getRequest());
        if(false === $response->getStatus()){
            $this->displayErrorMessages($response->errorMessage()->getDetails());
            return $this->forward('training/new');
        }
        $this->flash->success('Training Experience Added');
        return $this->forward('profile/index');
    }
    
    public function editAction($trainingId){
        $this->view->pick('talent/training/edit');
        $service = new QueryTrainingService($this->_talentRepository());
        $response = $service->showById($this->_getTalentId(), $trainingId);
        if(false === $response->getStatus()){
            $this->displayErrorMessages($response->errorMessage()->getDetails());
            return $this->forward('profile/index');
        }
        $trainingRdo = $response->firstReadDataObject();
        Tag::displayTo('id',$trainingRdo->getId());
        Tag::displayTo('name',$trainingRdo->getName());
        Tag::displayTo('organizer',$trainingRdo->getOrganizer());
        Tag::displayTo('year',$trainingRdo->getYear());
    }
    
    public function updateAction(){
        if(!$this->request->isPost()){
            return $this->forward('profile/index');
        }
        $service = $this->_commandTrainingService();
        $trainingId = strip_tags($this->request->getPost('id'));
        $response = $service->update($this->_getTalentId(), $trainingId, $this->_getRequest());
        if(false === $response->getStatus()){
            $this->displayErrorMessages($response->errorMessage()->getDetails());
        }else{
            $this->flash->success('Training History Updated');
        }
        return $this->forward('profile/index');
    }
    public function removeAction($trainingId){
        $service = $this->_commandTrainingService();
        $response = $service->remove($this->_getTalentId(), $trainingId);
        if(false === $response->getStatus()){
            $this->displayErrorMessages($response->errorMessage()->getDetails());
        }else{
            $this->flash->success('Talent History Deleted');
        }
        return $this->forward('profile/index');
    }
    
    protected function _talentRepository(){
        return $this->em->getRepository('\Talent\Training\DomainModel\Talent\Talent');
    }
    protected function _commandTrainingService(){
        return new CommandTrainingService($this->_talentRepository());
    }
    protected function _getRequest(){
        $name = strip_tags($this->request->getPost('name'));
        $organizer = strip_tags($this->request->getPost('organizer'));
        $year = strip_tags($this->request->getPost('year'));
        return TrainingWriteDataObject::request($name, $organizer, $year);
    }
}

