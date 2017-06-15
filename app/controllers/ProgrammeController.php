<?php

use Phalcon\Tag;
use Programme\Description\ApplicationService\Programme\AddProgrammeService;
use Programme\Description\ApplicationService\Programme\CommandProgrammeService;
use Programme\Description\ApplicationService\Programme\QueryProgrammeService;
use Programme\Description\ApplicationService\Programme\TransactionalAddProgrammeService;
use Programme\Description\DomainModel\Programme\DataObject\ProgrammeWriteDataObject;
use City\Programme\Description\DomainModel\City\Event\ProgrammeWasCreatedSubscriber;

class ProgrammeController extends ManagerialControllerBase{
    protected function _queryProgrammeService(){
        $programmeRdoRepository = $this->em->getRepository('Programme\Description\DomainModel\Programme\ProgrammeRdo');
        return new QueryProgrammeService($programmeRdoRepository);
    }
    protected function _programmeRepository(){
        return $this->em->getRepository('Programme\Description\DomainModel\Programme\Programme');
    }
    protected function _personnelRdoRepository(){
        return $this->em->getRepository('Personnel\DomainModel\Personnel\DataObject\PersonnelReadDataObject');
    }
    protected function _createRequest(){
        $name = strip_tags($this->request->getPost('name'));
        $registrationStartDate = strip_tags($this->request->getPost('registration_start_date'));
        $registrationEndDate = strip_tags($this->request->getPost('registration_end_date'));
        $operationStartDate = strip_tags($this->request->getPost('operation_start_date'));
        $operationEndDate = strip_tags($this->request->getPost('operation_end_date'));
        return ProgrammeWriteDataObject::request($name, $registrationStartDate, $registrationEndDate, $operationStartDate, $operationEndDate);
    }
    
    function indexAction(){
        $service = $this->_queryProgrammeService();
        $response = $service->showAll();
        if(false === $response->getStatus()){
            $this->displayWarningMessages($response->errorMessage()->getDetails());
        }
        $this->view->programmeRdos = $response->arrayOfReadDataObject();
    }
    
    function newAction(){
        
    }
    
    function addAction(){
        if(!$this->request->isPost()){
            return $this->forward('programme/new');
        }
        
        $publisher = \Resources\DomainEventPublisher::instance();
        $cityRepository = $this->em->getRepository('City\Programme\Description\DomainModel\City\City');
        $aDomainEventSubscriber = new ProgrammeWasCreatedSubscriber($cityRepository);
        $publisher->subscribe($aDomainEventSubscriber);
        
        $service = new AddProgrammeService($this->_programmeRepository(), $this->_personnelRdoRepository());
        $session = new Resources\Doctrine\DoctrineTransactionalSession($this->em);
        $transactionalService = new TransactionalAddProgrammeService($service, $session);
        $response = $transactionalService->execute($this->_getPersonnelId(), $this->_createRequest());
        
        if(false === $response->getStatus()){
            $this->displayErrorMessages($response->errorMessage()->getDetails());
            return $this->forward('programme/new');
        }
        $this->flash->success('programme created');
        return $this->forward('programme/index');
    }
    
    function editAction($programmeId){
        $service = $this->_queryProgrammeService();
        $response = $service->showById($programmeId);
        if(false === $response->getStatus()){
            $this->displayWarningMessages($response->errorMessage()->getDetails());
            return $this->forward('programme/index');
        }
        $programmeRdo = $response->firstReadDataObject();
        Tag::displayTo('id', $programmeRdo->getId());
        Tag::displayTo('name', $programmeRdo->getName());
        Tag::displayTo('registration_start_date', $programmeRdo->getRegistrationStartDate());
        Tag::displayTo('registration_end_date', $programmeRdo->getRegistrationEndDate());
        Tag::displayTo('operation_start_date', $programmeRdo->getOperationStartDate());
        Tag::displayTo('operation_end_date', $programmeRdo->getOperationEndDate());
    }
    
    function updateAction(){
        if(!$this->request->isPost()){
            return $this->forward('programme/index');
        }
        $service = new CommandProgrammeService($this->_programmeRepository(), $this->_personnelRdoRepository());
        $programmeId = strip_tags($this->request->getPost('id'));
        $response = $service->update($this->_getPersonnelId(), $programmeId, $this->_createRequest());
        if(false === $response->getStatus()){
            $this->displayErrorMessages($response->errorMessage()->getDetails());
        }else{
            $this->flash->success('programme updated');
        }
        return $this->forward('programme/index');
        
    }
    
    function removeAction($programmeId){
        $service = new CommandProgrammeService($this->_programmeRepository(), $this->_personnelRdoRepository());
        $response = $service->remove($this->_getPersonnelId(), $programmeId);
        if(false === $response->getStatus()){
            $this->displayErrorMessages($response->errorMessage()->getDetails());
        }else{
            $this->flash->success('programme removed');
        }
        return $this->forward('programme/index');
    }
    
}
