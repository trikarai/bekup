<?php

namespace Talent;

use Phalcon\Tag;
use Talent\Organizational\ApplicationService\Organizational\CommandOrganizationalService;
use Talent\Organizational\ApplicationService\Organizational\QueryOrganizationalService;
use Talent\Organizational\DomainModel\Organizational\DataObject\OrganizationalWriteDataObject;

class OrganizationalController extends \TalentControllerBase{
//    function indexAction(){
//        $this->view->pick('talent/organizational/index');
//        $service = $this->_queryOrganizationalService();
//        $response = $service->showAll($this->_getTalentId());
//        $this->view->rdos = $response->arrayOfReadDataObject();
//    }
    
    function newAction(){
        $this->view->pick('talent/organizational/new');
    }
    
    function addAction(){
        if(!$this->request->isPost()){
            return $this->forwardNamespace('Talent/organizational/new');
        }
        $service = $this->_commandOrganizationalService();
        $response = $service->add($this->_getTalentId(), $this->_createRequest());
        if(false === $response->getStatus()){
            $this->displayErrorMessages($response->errorMessage()->getDetails());
            return $this->forwardNamespace('Talent/organizational/new');
        }
        $this->flash->success('organizational experience created');
        return $this->forwardNamespace('Talent/profile/index');
    }
    
    function editAction($organizationalId){
        $this->view->pick('talent/organizational/edit');
        $service = $this->_queryOrganizationalService();
        $response = $service->showById($this->_getTalentId(), $organizationalId);
        if(false === $response->getStatus()){
            $this->displayErrorMessages($response->errorMessage()->getDetails());
            return $this->forwardNamespace('Talent/profile/index');
        }
        $rdo = $response->firstReadDataObject();
        Tag::displayTo('id', $rdo->getId());
        Tag::displayTo('name', $rdo->getName());
        Tag::displayTo('position', $rdo->getPosition());
        Tag::displayTo('start_year', $rdo->getStartYear());
        Tag::displayTo('end_year', $rdo->getEndYear());
    }
    
    function updateAction(){
        if(!$this->request->isPost()){
            return $this->forwardNamespace('Talent/profile/index');
        }
        $service = $this->_commandOrganizationalService();
        $organizationalId = strip_tags($this->request->getPost('id'));
        $response = $service->update($this->_getTalentId(), $organizationalId, $this->_createRequest());
        if(false === $response->getStatus()){
            $this->displayErrorMessages($response->errorMessage()->getDetails());
        }else{
            $this->flash->success('organizational experience updated');
        }
        return $this->forwardNamespace('Talent/profile/index');
    }
    
    function removeAction($organizationalId){
        $service = $this->_commandOrganizationalService();
        $response = $service->remove($this->_getTalentId(), $organizationalId);
        if(false === $response->getStatus()){
            $this->displayErrorMessages($response->errorMessage()->getDetails());
        }else{
            $this->flash->success('organizational experience removed');
        }
        return $this->forwardNamespace('Talent/profile/index');
    }
    
    protected function _commandOrganizationalService(){
        $talentRepository = $this->em->getRepository('\Talent\Organizational\DomainModel\Talent\Talent');
        return new CommandOrganizationalService($talentRepository);
    }
    protected function _queryOrganizationalService(){
        $talentQueryRepository = $this->em->getRepository('\Talent\Organizational\DomainModel\Talent\TalentQuery');
        return new QueryOrganizationalService($talentQueryRepository);
    }
    protected function _createRequest(){
        $name = strip_tags($this->request->getPost('name'));
        $position = strip_tags($this->request->getPost('position'));
        $startYear = strip_tags($this->request->getPost('start_year'));
        $endYear = strip_tags($this->request->getPost('end_year'));
        return OrganizationalWriteDataObject::request($name, $position, $startYear, $endYear);
    }
}