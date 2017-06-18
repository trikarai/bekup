<?php

namespace Talent;

use Phalcon\Tag;
use Talent\Entrepreneurship\ApplicationService\Entrepreneurship\CommandEntrepreneurshipService;
use Talent\Entrepreneurship\ApplicationService\Entrepreneurship\QueryEntrepreneurshipService;
use Talent\Entrepreneurship\DomainModel\Entrepreneurship\DataObject\EntrepreneurshipWriteDataObject;

class EntrepreneurshipController extends \TalentControllerBase{
    function indexAction(){
        $this->view->pick('talent/entrepreneurship/index');
        $service = $this->_queryEntrepreneurshipService();
        $response = $service->showAll($this->_getTalentId());
        $this->view->rdos = $response->arrayOfReadDataObject();
    }
    
    function newAction(){
        $this->view->pick('talent/entrepreneurship/new');
        $this->view->businessCategoryList = $this->_getCategoryList();
    }
    
    function addAction(){
        if(!$this->request->isPost()){
            return $this->forwardNamespace('talent/entrepreneurship/new');
        }
        $service = $this->_commandEntrepreneurshipService();
        $response = $service->add($this->_getTalentId(), $this->_getRequest());
        if(false === $response->getStatus()){
            $this->displayErrorMessages($response->errorMessage()->getDetails());
            return $this->forwardNamespace('talent/entrepreneurship/new');
        }
        $this->flash->success('entrepreneurship experience created');
        return $this->forwardNamespace('talent/entrepreneurship/index');
    }
    
    function editAction($id){
        $this->view->pick('talent/entrepreneurship/edit');
        $service = $this->_queryEntrepreneurshipService();
        $response = $service->showById($this->_getTalentId(), $id);
        if(false === $response->getStatus()){
            $this->displayErrorMessages($response->errorMessage()->getDetails());
            return $this->forwardNamespace('talent/entrepreneurship/index');
        }
        $this->view->businessCategoryList = $this->_getCategoryList();
        $rdo = $response->firstReadDataObject();
        Tag::displayTo('id', $rdo->getId());
        Tag::displayTo('name', $rdo->getName());
        Tag::displayTo('position', $rdo->getPosition());
        Tag::displayTo('business_field', $rdo->getBusinessField());
        Tag::displayTo('business_category', $rdo->getBusinessCategory());
        Tag::displayTo('start_year', $rdo->getStartYear());
        Tag::displayTo('end_year', $rdo->getEndYear());
    }
    
    function updateAction(){
        if(!$this->request->isPost()){
            return $this->forwardNamespace('talent/entrepreneurship/index');
        }
        $service = $this->_commandEntrepreneurshipService();
        $entrepreneurshipId = strip_tags($this->request->getPost('id'));
        $response = $service->update($this->_getTalentId(), $entrepreneurshipId, $this->_getRequest());
        if(false === $response->getStatus()){
            $this->displayErrorMessages($response->errorMessage()->getDetails());
        }else{
            $this->flash->success('entrepreneurship experience updated');
        }
        return $this->forwardNamespace('talent/entrepreneurship/index');
    }
    
    function removeAction($id){
        $service = $this->_commandEntrepreneurshipService();
        $response = $service->remove($this->_getTalentId(), $id);
        if(false === $response->getStatus()){
            $this->displayErrorMessages($response->errorMessage()->getDetails());
        }else{
            $this->flash->success('entrepreneurship experience removed');
        }
        return $this->forwardNamespace('talent/entrepreneurship/index');
    }
    
    protected function _commandEntrepreneurshipService(){
        $talentRepository = $this->em->getRepository('\Talent\Entrepreneurship\DomainModel\Talent\Talent');
        return new CommandEntrepreneurshipService($talentRepository);
    }
    protected function _queryEntrepreneurshipService(){
        $talentQueryRepository = $this->em->getRepository('\Talent\Entrepreneurship\DomainModel\Talent\TalentQuery');
        return new QueryEntrepreneurshipService($talentQueryRepository);
    }
    protected function _getRequest(){
        $name = strip_tags($this->request->getPost('name'));
        $businessField = strip_tags($this->request->getPost('business_field'));
        $businessCategory = strip_tags($this->request->getPost('business_category'));
        $position = strip_tags($this->request->getPost('position'));
        $startYear = strip_tags($this->request->getPost('start_year'));
        $endYear = strip_tags($this->request->getPost('end_year'));
        return EntrepreneurshipWriteDataObject::request($name, $businessField, $businessCategory, $position, $startYear, $endYear);
    }
    protected function _getCategoryList(){
        return array(
            'B2B' => 'B2B',
            'B2C' => 'B2C',
            'B2G' => 'B2G',
            'C2C' => 'C2C',
        );
    }
    
}
