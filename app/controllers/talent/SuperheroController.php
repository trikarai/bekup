<?php

namespace Talent;

use Phalcon\Tag;
use Team\Idea\ApplicationService\Superhero\CommandSuperheroService;
use Team\Idea\ApplicationService\Superhero\QuerySuperheroService;
use Team\Idea\DomainModel\Superhero\DataObject\SuperheroWriteDataObject;

class SuperheroController extends \TalentControllerBase{

    function indexAction(){
        $this->view->pick('talent/superhero/index');
        $service = $this->_querySuperheroService();
        $response = $service->showAll($this->_getTalentId());
        $this->view->superheroRdos = $response->arrayOfReadDataObject();
    }
    
    function newAction(){
        $this->view->pick('talent/superhero/new');
    }
    
    function addAction(){
        if(!$this->request->isPost()){
            return $this->forwardNamespace('Talent/superhero/new');
        }
        $service = $this->_commandSuperheroService();
        $response = $service->add($this->_getTalentId(), $this->_getRequest());
        if(false === $response->getStatus()){
            $this->displayErrorMessages($response->errorMessage()->getDetails());
            return $this->forwardNamespace('Talent/superhero/new');
        }
        $this->flash->success('superhero created');
        return $this->forwardNamespace('Talent/superhero/index');
    }
    
    function editAction($superheroId){
        $this->view->pick('talent/superhero/edit');
        $service = $this->_querySuperheroService();
        $response = $service->showById($this->_getTalentId(), $superheroId);
        if(false === $response->getStatus()){
            $this->displayErrorMessages($response->errorMessage()->getDetails());
            return $this->forward('superhero/index');
        }
        $superheroRdo = $response->firstReadDataObject();
        Tag::displayTo('id', $superheroRdo->getId());
        Tag::displayTo('name', $superheroRdo->getName());
        Tag::displayTo('main_duty', $superheroRdo->getMainDuty());
        Tag::displayTo('special_ability', $superheroRdo->getSpecialAbility());
        Tag::displayTo('daily_activity', $superheroRdo->getDailyActivity());
        Tag::displayTo('alternative_technology', $superheroRdo->getAlternativeTechnology());
    }
    
    function updateAction(){
        if(!$this->request->isPost()){
            return $this->forward('superhero/index');
        }
        $service = $this->_commandSuperheroService();
        $superheroId = strip_tags($this->request->getPost('id'));
        $response = $service->update($this->_getTalentId(), $superheroId, $this->_getRequest());
        if(false === $response->getStatus()){
            $this->displayErrorMessages($response->errorMessage()->getDetails());
        }else{
            $this->flash->success('superhero updated');
        }
        return $this->forward('superhero/index');
    }
    
    function removeAction($superheroId){
        $service = $this->_commandSuperheroService();
        $response = $service->remove($this->_getTalentId(), $superheroId);
        if(false === $response->getStatus()){
            $this->displayErrorMessages($response->errorMessage()->getDetails());
        }else{
            $this->flash->success('superhero removed');
        }
        return $this->forward('superhero/index');
    }
    
    protected function _commandSuperheroService(){
        $talentRepository = $this->em->getRepository('\Team\Idea\DomainModel\Talent\Talent');
        return new CommandSuperheroService($talentRepository);
    }
    protected function _querySuperheroService(){
        $talentQueryRepository = $this->em->getRepository('\Team\Idea\DomainModel\Talent\TalentQuery');
        return new QuerySuperheroService($talentQueryRepository);
    }
    protected function _getRequest(){
        $name = strip_tags($this->request->getPost('name'));
        $mainDuty = strip_tags($this->request->getPost('main_duty'));
        $specialAbility = strip_tags($this->request->getPost('special_ability'));
        $dailyActivity = strip_tags($this->request->getPost('daily_activity'));
        $alternativeTechnology = strip_tags($this->request->getPost('alternative_technology'));
        return SuperheroWriteDataObject::request($name, $mainDuty, $specialAbility, $dailyActivity, $alternativeTechnology);
    }
}
