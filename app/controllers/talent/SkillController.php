<?php

namespace Talent;

use Phalcon\Tag;
use Talent\Skill\ApplicationService\SkillScore\AddSkillScoreService;
use Talent\Skill\ApplicationService\SkillScore\CommandSkillScoreService;
use Talent\Skill\ApplicationService\SkillScore\QuerySkillScoreService;
use Talent\Skill\ApplicationService\Skill\QuerySkillService;

use Talent\Skill\ApplicationService\Certificate\QueryCertificateService;
use Talent\Skill\ApplicationService\Certificate\CommandCertificateService;
use Talent\Skill\DomainModel\Certificate\DataObject\CertificateWriteDataObject;

class SkillController extends \TalentControllerBase{
        
    function indexAction(){
        $this->view->pick('talent/skill/index');
        $service = $this->_querySkillScoreService();
        $response = $service->showAll($this->_getTalentId());
        $serviceCert = $this->_queryCertificateService();
        if(false === $response->getStatus()){
            $this->displayErrorMessages($response->errorMessage()->getDetails());
        }
        $skillScoreRdos = [];
        foreach($response->arrayOfReadDataObject() as $index => $skillScore){
            $skillScoreRdos[$index] = $skillScore->toArray();
            foreach($serviceCert->showAll($this->_getTalentId(), $skillScore->getId())->arrayOfReadDataObject() as $cert){
               $skillScoreRdos[$index]['certificates'][] = $cert->toArray();
            }
		} 
        $this->view->skillScoreRdos = $skillScoreRdos;
    }
 
    function newAction(){
        $this->view->pick('talent/skill/new');
        $this->view->skillList = $this->_getSkillList();
    }
    
    function saveAction(){
        if(!$this->request->isPost()){
            return $this->forward('skill/new');
        }
        $service = new AddSkillScoreService($this->_talentRepository(), $this->_skillRdoRepository());
        $skillId = strip_tags($this->request->getPost('skill_id'));
        $scoreValue = strip_tags($this->request->getPost('score'));
        $response = $service->execute($this->_getTalentId(), $skillId, $scoreValue);
        if(false === $response->getStatus()){
            $this->displayErrorMessages($response->errorMessage()->getDetails());
            return $this->forward('skill/new');
        }
        $this->flash->success('skill score created');
        return $this->forward('skill/index');
    }
    
    function editAction($skillScoreId){
        $this->view->pick('talent/skill/edit');
        $service = $this->_querySkillScoreService();
        $response = $service->showByid($this->_getTalentId(), $skillScoreId);
        if(false === $response->getStatus()){
            $this->displayErrorMessages($response->errorMessage()->getDetails());
            return $this->forward('skill/index');
        }
        $skillScoreRdo = $response->firstReadDataObject();
        Tag::displayTo("id", $skillScoreRdo->getId());
        Tag::displayTo("skill", $skillScoreRdo->skillRDO()->getType() . " - " . $skillScoreRdo->skillRDO()->getName());
        Tag::displayTo("score", $skillScoreRdo->getScoreValue());
    }
    
    function updateAction(){
        if(!$this->request->isPost()){
            return $this->forward('skill/index');
        }
        $service = $this->_commandSkillScoreService();
        $skillScoreId = strip_tags($this->request->getPost('id'));
        $scoreValue = strip_tags($this->request->getPost('score'));
        $response = $service->update($this->_getTalentId(), $skillScoreId, $scoreValue);
        if(false === $response->getStatus()){
            $this->displayErrorMessages($response->errorMessage()->getDetails());
        }else{
            $this->flash->success("skill score updated");
        }
        return $this->forward('skill/index');
    }
    function removeAction($skillScoreId){
        $service = $this->_commandSkillScoreService();
        $response = $service->remove($this->_getTalentId(), $skillScoreId);
        if(false === $response){
            $this->displayErrorMessages($response->errorMessage()->getDetails());
        }else{
            $this->flash->success("skill score removed");
        }
        return $this->forward('skill/index');
    }
    
    function addCertificateAction($id){   
        $this->view->pick('talent/skill/addcertificate');
        Tag::displayTo("skill", $id);
        $this->view->skill_id = $id;
        
    }
    function saveCertificateAction(){
        if(!$this->request->isPost()){
            return $this->forward('talent/skill/index');
        }
        $service = new CommandCertificateService($this->_skillScoreRepository());
        $skillId = strip_tags($this->request->getPost('skill_id'));
          
        $response = $service->add($this->_getTalentId(), $skillId, $this->_getRequest());
        
        //$response = $service->execute($this->_getTalentId(), $skillId, $scoreValue);
        if(false === $response->getStatus()){
            $this->displayErrorMessages($response->errorMessage()->getDetails());
            return $this->forward('talent/skill/index');
        }
        $this->flash->success('skill certificate created');
        return $this->forward('skill/index');
    }
    function editCertificateAction($certificateId, $skillScoreId){
        $this->view->pick('talent/skill/editcertificate');
        $service = $this->_queryCertificateService();
        $response = $service->showByid($this->_getTalentId(), $skillScoreId, $certificateId);
        
        if(false === $response->getStatus()){
            $this->displayErrorMessages($response->errorMessage()->getDetails());
            return $this->forward('skill/index');
        }
        $certificateRdo = $response->firstReadDataObject();
        Tag::displayTo('skill_id', $skillScoreId);
        Tag::displayTo('certificate_id', $certificateRdo->getId());
        Tag::displayTo('name', $certificateRdo->getName());
        Tag::displayTo('organizer', $certificateRdo->getOrganizer());
        Tag::displayTo('year', $certificateRdo->getValidUntil());
 
    }
    function updateCertificateAction(){
        if(!$this->request->isPost()){
            return $this->forward('skill/index');
        }
        $service = $this->_commandCertificateService();

        $skillScoreid  = strip_tags($this->request->getPost('skill_id'));
        $certificateId  = strip_tags($this->request->getPost('certificate_id'));
              
        $response = $service->update($this->_getTalentId(), $skillScoreid, $certificateId, $this->_getRequest());
        
        if(false === $response->getStatus()){
            $this->displayErrorMessages($response->errorMessage()->getDetails());
        }else{
            $this->flash->success("certificate updated");
        }
        return $this->forward('skill/index');
    }
    function removeCertificateAction($skillScoreid,$certificateId){
        $service = $this->_commandCertificateService();
        $response = $service->remove($this->_getTalentId(), $skillScoreid, $certificateId);
        if(false === $response){
            $this->displayErrorMessages($response->errorMessage()->getDetails());
        }else{
            $this->flash->success("certificate removed");
        }
        return $this->forward('skill/index');
    }
    
    protected function _talentRepository(){
        return $this->em->getRepository('\Talent\Skill\DomainModel\Talent\Talent');
    }
    protected function _skillRepository(){
        return $this->em->getRepository('\Talent\Skill\DomainModel\Skill\Skill');
    }
    protected function _skillScoreRepository(){
        return $this->em->getRepository('\Talent\Skill\DomainModel\SkillScore\SkillScore');
    }
    protected function _skillRdoRepository(){
        return $this->em->getRepository('\Talent\Skill\DomainModel\Skill\DataObject\SkillReadDataObject');
    }
    protected function _querySkillScoreService(){
        return new QuerySkillScoreService($this->_talentRepository());
    }
    protected function _queryCertificateService(){
        return new QueryCertificateService($this->_skillScoreRepository());
    }
    protected function _commandSkillScoreService(){
        return new CommandSkillScoreService($this->_talentRepository());
    }
    protected function _commandCertificateService(){
        return new CommandCertificateService($this->_skillScoreRepository());
    }
    protected function _getSkillList(){
        $service = new QuerySkillService($this->_skillRdoRepository());
        $response = $service->showAll();
        if(false === $response->getStatus()){
            $this->displayErrorMessages($response->errorMessage()->getDetails());
        }
        return $response->toArrayOfSkillList();
    }
        protected function _getRequest(){
        $name = strip_tags($this->request->getPost('name'));
        $organizer = strip_tags($this->request->getPost('organizer'));
        $validYear = strip_tags($this->request->getPost('year'));
        
        if(empty($validYear)){
            $validYear = null;
        }   
                return CertificateWriteDataObject::request($name,$organizer,$validYear); 
    }
}
