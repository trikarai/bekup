<?php

namespace Talent;

use Phalcon\Tag;

use Talent\WorkingExperience\ApplicationService\WorkingExperience\CommandWorkingExperienceService;
use Talent\WorkingExperience\ApplicationService\WorkingExperience\QueryWorkingExperienceService;
use Talent\WorkingExperience\DomainModel\WorkingExperience\DataObject\WorkingExperienceWriteDataObject;

class WorkexperienceController extends \TalentControllerBase{
    public function newAction(){
        $this->view->pick('talent/workexperience/new');
    }

    public function saveAction(){
        if(!$this->request->isPost()){
            return $this->forward("profile/index");
        }
        $service = $this->_commandWorkingExperienceService();
        $response = $service->add($this->_getTalentId(), $this->_getRequest());
        
        if(false === $response->getStatus()){
            $this->displayErrorMessages($response->errorMessage()->getDetails());
            return $this->forward('workexperience/add');
        }
        $this->flash->success("work experience created");
        return $this->forward('profile/index');
    }
    public function editAction($workingExperienceId){
        $this->view->pick('talent/workexperience/edit');
        $service = new QueryWorkingExperienceService($this->_talentRepository());
        $response = $service->showById($this->_getTalentId(), $workingExperienceId);
        if(false === $response->getStatus()){
            $this->displayErrorMessages($response->errorMessage()->getDetails());
            return $this->forward('profile/index');
        }
        $workingExperienceRdo = $response->firstReadDataObject();
        Tag::displayTo('id',$workingExperienceRdo->getId());
        Tag::displayTo('companyName',$workingExperienceRdo->getCompanyName());
        Tag::displayTo('position',$workingExperienceRdo->getPosition());
        Tag::displayTo('startYear',$workingExperienceRdo->getStartYear());
        Tag::displayTo('endYear',$workingExperienceRdo->getEndYear());
        Tag::displayTo('role',$workingExperienceRdo->getRole());
    }
    
    public function updateAction(){
        if(!$this->request->isPost()){
            return $this->forward('profile/index');
        }
        
        $service = $this->_commandWorkingExperienceService();
        $workingExperienceId = strip_tags($this->request->getPost('id'));
        $response = $service->update($this->_getTalentId(), $workingExperienceId, $this->_getRequest());
        if(false === $response->getStatus()){
            $this->displayErrorMessages($response->errorMessage()->getDetails());
        }else{
            $this->flash->success("work experience created");
        }
        return $this->forward('profile/index');
    }
    
    public function removeAction($workingExperienceId){
        $service = $this->_commandWorkingExperienceService();
        $response = $service->remove($this->_getTalentId(), $workingExperienceId);
        if(false === $response->getStatus()){
            $this->displayErrorMessages($response->errorMessage()->getDetails());
        }else{
            $this->flash->success("work experience removed");
        }
        return $this->forward('profile/index');
    }
    
    protected function _talentRepository(){
        return $this->em->getRepository('\Talent\WorkingExperience\DomainModel\Talent\Talent');
    }
    protected function _commandWorkingExperienceService(){
        return new CommandWorkingExperienceService($this->_talentRepository());
    }
    protected function _getRequest(){
        $companyName = strip_tags($this->request->getPost('companyName'));
        $position = strip_tags($this->request->getPost('position'));
        $role = strip_tags($this->request->getPost('role'));
        $startYear = strip_tags($this->request->getPost('startYear'));
        $endYear = strip_tags($this->request->getPost('endYear'));
        return WorkingExperienceWriteDataObject::request($companyName, $position, $role, $startYear, $endYear);
    }
}

