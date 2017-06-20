<?php

namespace Team;

use Phalcon\Tag;
use Team\Idea\ApplicationService\Idea\CommandIdeaService;
use Team\Idea\ApplicationService\Idea\ProposeIdeaService;
use Team\Idea\ApplicationService\Idea\QueryIdeaService;
use Team\Idea\DomainModel\Idea\DataObject\IdeaWriteDataObject;
use Team\Idea\ApplicationService\Superhero\QuerySuperheroService;

class IdeaController extends TeamControllerBase{
    protected function _queryIdeaService(){
        $teamQueryRepository = $this->em->getRepository('\Team\Idea\DomainModel\Team\TeamQuery');
        return new QueryIdeaService($teamQueryRepository, $this->_activeMembershipFinder());
    }
    protected function _teamRepository(){
        return $this->em->getRepository('\Team\Idea\DomainModel\Team\Team');
    }
    protected function _talentQueryRepository(){
        return $this->em->getRepository('\Team\Idea\DomainModel\Talent\TalentQuery');
    }
    protected function _getRequest(){
        $name = strip_tags($this->request->getPost('name'));
        $description = strip_tags($this->request->getPost('description'));
        $targetCustomer = strip_tags($this->request->getPost('target_customer'));
        $problemFaced = strip_tags($this->request->getPost('problem_faced'));
        $valueProposed = strip_tags($this->request->getPost('value_proposed'));
        $revenueModel = strip_tags($this->request->getPost('revenue_model'));
        return IdeaWriteDataObject::request($name, $description, $targetCustomer, $problemFaced, $valueProposed, $revenueModel);
    }
    protected function _getSuperheroList(){
        $service = new QuerySuperheroService($this->_talentQueryRepository());
        $response = $service->showAll($this->_getTalentId());
        return $response->toListSelectionArray();
    }
    protected function _commandIdeaService(){
        return new CommandIdeaService($this->_teamRepository(), $this->_talentQueryRepository(), $this->_activeMembershipFinder());
    }
    
    function indexAction(){
        $this->view->pick('team/idea/index');
        $service = $this->_queryIdeaService();
        $response = $service->showAllIdea($this->_getTalentId());
		if($false === $response->getStatus()){
			return $this->forwardNamespace('Team/dashboard/index');
		}
        $this->view->ideaRdos = $response->arrayOfReadDataObject();
    }
    
    function newAction(){
        $this->view->pick('team/idea/new');
        $service = new QuerySuperheroService($this->_talentQueryRepository());
        $response = $service->showAll($this->_getTalentId());
        $this->view->superheroList = $this->_getSuperheroList();
    }
    
    function addAction(){
        if(!$this->request->isPost()){
            return $this->forwardNamespace('Team/idea/new');
        }
        $service = new ProposeIdeaService($this->_teamRepository(), $this->_talentQueryRepository(), $this->_activeMembershipFinder());
        $superheroId = strip_tags($this->request->getPost('superhero_id'));
        $response = $service->execute($this->_getTalentId(), $this->_getRequest(), $superheroId);
        if(false === $response->getStatus()){
            $this->displayErrorMessages($response->errorMessage()->getDetails());
            return $this->forwardNamespace('Team/idea/new');
        }
        $this->flash->success('idea created');
        return $this->forwardNamespace('Team/idea/index');
    }
    
    function editAction($ideaId){
        $this->view->pick('team/idea/edit');
        $service = $this->_queryIdeaService();
        $response = $service->showIdeaById($this->_getTalentId(), $ideaId);
        if(false === $response->getStatus()){
            $this->displayErrorMessages($response->errorMessage()->getDetails());
            return $this->forwardNamespace('Team/idea/index');
        }
        $this->view->superheroList = $this->_getSuperheroList();
        $ideaRdo = $response->firstReadDataObject();
        Tag::displayTo('id', $ideaRdo->getId());
        Tag::displayTo('name', $ideaRdo->getName());
        Tag::displayTo('description', $ideaRdo->getDescription());
        Tag::displayTo('target_customer', $ideaRdo->getTargetCustomer());
        Tag::displayTo('problem_faced', $ideaRdo->getProblemFaced());
        Tag::displayTo('value_proposed', $ideaRdo->getValueProposed());
        Tag::displayTo('revenue_model', $ideaRdo->getRevenueModel());
		if($ideaRdo->superheroRdo()){
			Tag::displayTo('superhero_id', $ideaRdo->superheroRdo()->getId());
		}
        $this->view->talentInitiator = $ideaRdo->getTalentInitiatorRdo()->getName();
    }
    
    function updateAction(){
        if(!$this->request->isPost()){
            return $this->forwardNamespace('Team/idea/index');
        }
        $service = $this->_commandIdeaService();
        $ideaId = strip_tags($this->request->getPost('id'));
        $superheroId = strip_tags($this->request->getPost('superhero_id'));
        $response = $service->updateIdea($this->_getTalentId(), $ideaId, $this->_getRequest(), $superheroId);
        if(false === $response->getStatus()){
            $this->displayErrorMessages($response->errorMessage()->getDetails());
        }else{
            $this->flash->success('idea updated');
        }
        return $this->forwardNamespace('Team/idea/index');
    }
    
    function removeAction($ideaId){
        $service = $this->_commandIdeaService();
        $response = $service->removeIdea($this->_getTalentId(), $ideaId);
        if(false === $response->getStatus()){
            $this->displayErrorMessages($response->errorMessage()->getDetails());
        }else{
            $this->flash->success('idea removed');
        }
        return $this->forwardNamespace('Team/idea/index');
    }
    
}
