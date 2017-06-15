<?php
use Phalcon\Tag;

use Talent\Education\ApplicationService\Education\CommandEducationService;
use Talent\Education\ApplicationService\Education\QueryEducationService;
use Talent\Education\DomainModel\Education\DataObject\EducationWriteDataObject;

class TalenteducationController extends TalentControllerBase{
    public function newAction(){
        $this->view->phaseList = $this->_getPhaseList();
    }

    public function saveAction(){
        if(!$this->request->isPost()){
            return $this->forward('talentprofile/index');
        }
        $service = $this->_commandEducationService();
        $response = $service->add($this->_getTalentId(), $this->_getRequest());
        if(false === $response->getStatus()){
            $this->displayErrorMessages($response->errorMessage()->getDetails());
            return $this->forward('talenteducation/new');
        }
        $this->flash->success('education created');
        return $this->forward('talentprofile/index');
    }
    
    public function editAction($educationId){
        $service = new QueryEducationService($this->_talentRepository());
        $response = $service->showById($this->_getTalentId(), $educationId);
        if(false === $response->getStatus()){
            $this->displayErrorMessages($response->errorMessage()->getDetails());
            return $this->forward('talentprofile/index');
        }
        $educationRdo = $response->firstReadDataObject();
        Tag::displayTo('id', $educationRdo->getId());
        Tag::displayTo('phase', $educationRdo->getPhase());
        Tag::displayTo('institution', $educationRdo->getInstitution());
        Tag::displayTo('major', $educationRdo->getMajor());
        Tag::displayTo('start_year', $educationRdo->getStartYear());
        Tag::displayTo('end_year', $educationRdo->getEndYear());
        Tag::displayTo('note', $educationRdo->getNote());
    }
    
    public function updateAction(){
        if(!$this->request->isPost()){
            return $this->forward('talentprofile/index');
        }
        $service = $this->_commandEducationService();
        $educationId = strip_tags($this->request->getPost('id'));
        $response = $service->update($this->_getTalentId(), $educationId, $this->_getRequest('update'));
        
        if(false === $response->getStatus()){
            $this->displayErrorMessages($response->errorMessage()->getDetails());
        }else{
            $this->flash->success('education history updated');
        }
        return $this->forward('talentprofile/index');
    }
    
    public function removeAction($educationId){
        $service = $this->_commandEducationService();
        $response = $service->remove($this->_getTalentId(), $educationId);
        if(false === $response->getStatus()){
            $this->displayErrorMessages($response->errorMessage()->getDetails());
        }else{
            $this->flash->success('education history removed');
        }
        return $this->forward('talentprofile/index');
    }
    
    protected function _talentRepository(){
        return $this->em->getRepository('Talent\Education\DomainModel\Talent\Talent');
    }
    protected function _commandEducationService(){
        return new CommandEducationService($this->_talentRepository());
    }
    protected function _getPhaseList(){
        return array(
            "SMA/SMK" => "SMA/SMK",
            "D1" => "D1",
            "D3" => "D3",
            "S1" => "S1",
            "S2" => "S2",
            "S3" => "S3",
        );
    }
    protected function _getRequest($type = "add"){
        $institution = strip_tags($this->request->getPost('institution'));
        $major = strip_tags($this->request->getPost('major'));
        $note = strip_tags($this->request->getPost('note'));
        $startYear = strip_tags($this->request->getPost('start_year'));
        $endYear = strip_tags($this->request->getPost('end_year'));
        if(empty($endYear)){
            $endYear = null;
        }
        switch ($type) {
            case "update":
                return EducationWriteDataObject::updateRequest($institution, $major, $note, $startYear, $endYear);
            default :
                $phase = strip_tags($this->request->getPost('phase'));
                return EducationWriteDataObject::addRequest($phase, $institution, $major, $note, $startYear, $endYear);
        }
    }
}