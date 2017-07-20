<?php

namespace Team;

use Phalcon\Tag;
use Team\Profile\ApplicationService\Talent\CreateTeamService;
use Team\Profile\ApplicationService\Team\UpdateTeamService;
use Team\Profile\DomainModel\Team\DataObject\TeamWriteDataObject;
use Team\Profile\ApplicationService\Talent\QueryMembershipService;

class ProfileController extends \TalentControllerBase{

    function newAction(){
        $this->view->pick('team/profile/new');
    }
    
    function saveAction(){
        if(!$this->request->isPost()){
            return $this->forward('profile/new');
        }
        $service = new CreateTeamService($this->_talentRepository(), $this->_teamRepository());
        
        if(false === $founderAgreementPath = $this->_uploadFounderAgreementAndGetPath()){
            return $this->forward('profile/new');
        }
        $position = strip_tags($this->request->getPost('position'));
        $response = $service->execute($this->_getTalentId(), $this->_getRequest($founderAgreementPath), $position);
        
        if(false === $response->getStatus()){
            $this->displayErrorMessages($response->errorMessage()->getDetails());
        }else{
            $this->flash->success('team created');
        }
        return $this->forward('dashboard/index');
    }
        
    function editAction(){
        $this->view->pick('team/profile/edit');
        $service = new QueryMembershipService($this->_talentRepository());
        $response = $service->showActiveMembership($this->_getTalentId());
        if(false === $response->getStatus()){
            $this->displayErrorMessages($response->errorMessage()->getDetails());
            return $this->forward('dashboard/index');
        }
        $teamRdo = $response->firstReadDataObject()->teamRDO();
        Tag::displayTo("name", $teamRdo->getName());
        Tag::displayTo("vision", $teamRdo->getVision());
        Tag::displayTo("mission", $teamRdo->getMission());
        Tag::displayTo("culture", $teamRdo->getCulture());
        $this->view->founderAgreement = $teamRdo->getFounderAgreement();
    }
    
    function updateAction(){
        if(!$this->request->isPost()){
            return $this->forward('dashboard/index');
        }
        $service = new UpdateTeamService($this->_teamRepository(), $this->_talentRepository());
        
        if(isset($_POST['previous_founder_agreement'])){
            $founderAgreement = strip_tags($this->request->getPost('previous_founder_agreement'));
            $request = $this->_getRequest($founderAgreement);
        }else if(false === $founderAgreementPath = $this->_uploadFounderAgreementAndGetPath()){
            return $this->forward('profile/edit');
        }else{
            $request = $this->_getRequest($founderAgreementPath);
        }
        
        $response = $service->execute($this->_getTalentId(), $request);
        if(false === $response->getStatus()){
            $this->displayErrorMessages($response->errorMessage()->getDetails());
        }else{
            $this->flash->success('team updated');
        }
        return $this->forward('dashboard/index');
    }
    
    protected function _talentRepository(){
        return $this->em->getRepository('\Team\Profile\DomainModel\Talent\Talent');
    }
    protected function _teamRepository(){
        return $this->em->getRepository('\Team\Profile\DomainModel\Team\Team');
    }
    protected function _getRequest($founderAgreement){
        $name = strip_tags($this->request->getPost('name'));
        $vision = strip_tags($this->request->getPost('vision'));
        $mission = strip_tags($this->request->getPost('mission'));
        $culture = strip_tags($this->request->getPost('culture'));
        return TeamWriteDataObject::request($name, $vision, $mission, $culture, $founderAgreement);
    }
    protected function _uploadFounderAgreementAndGetPath(){
        if(true != $this->request->hasFiles() || 4 == $_FILES["founder_agreement"]["error"]){
            return "";
        }
        
        $targetDir = BASE_PATH . "/public/uploads/";
        $upload = $this->request->getUploadedFiles()[0];
        $acceptedType = array(
            "application/pdf",
            "application/msword",
            "application/vnd.openxmlformats-officedocument.wordprocessingml.document"
        );
//getRealType() More secure but require finfo in php.ini to be enable
//        if(!in_array($upload->getRealType(), $acceptedType)){}
        if(!in_array($upload->getType(), $acceptedType)){
            $this->flash->warning('File Must be PDF / DOC / DOCX');
            return false;
        } else if($upload->getSize()>1000000){
            $this->flash->warning('File must not more than 1 MB');
            return false;
        }
        $fileName = md5(uniqid(mt_rand(),true)).'-'.$upload->getName();
        $path = $targetDir.$fileName;
        $founderAgreement = ($upload->moveTo($path)) ? $fileName : "";
        return $founderAgreement;
    }
}
