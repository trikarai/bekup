<?php

use Phalcon\Tag;
use Talent\Skill\ApplicationService\SkillScore\AddSkillScoreService;
use Talent\Skill\ApplicationService\SkillScore\CommandSkillScoreService;
use Talent\Skill\ApplicationService\SkillScore\QuerySkillScoreService;
use Talent\Skill\ApplicationService\Skill\QuerySkillService;

class TalentskillController extends TalentControllerBase{
    protected function _talentRepository(){
        return $this->em->getRepository('\Talent\Skill\DomainModel\Talent\Talent');
    }
    protected function _skillRdoRepository(){
        return $this->em->getRepository('\Talent\Skill\DomainModel\Skill\DataObject\SkillReadDataObject');
    }
    protected function _querySkillScoreService(){
        return new QuerySkillScoreService($this->_talentRepository());
    }
    protected function _commandSkillScoreService(){
        return new CommandSkillScoreService($this->_talentRepository());
    }
    protected function _getSkillList(){
        $service = new QuerySkillService($this->_skillRdoRepository());
        $response = $service->showAll();
        if(false === $response->getStatus()){
            $this->displayErrorMessages($response->errorMessage()->getDetails());
        }
        return $response->toArrayOfSkillList();
    }
    
    function indexAction(){
        $service = $this->_querySkillScoreService();
        $response = $service->showAll($this->_getTalentId());
        if(false === $response->getStatus()){
            $this->displayErrorMessages($response->errorMessage()->getDetails());
        }
        $this->view->skillScoreRdos = $response->arrayOfReadDataObject();
    }
    
    function newAction(){
        $this->view->skillList = $this->_getSkillList();
    }
    
    function saveAction(){
        if(!$this->request->isPost()){
            return $this->forward('talentskill/new');
        }
        $service = new AddSkillScoreService($this->_talentRepository(), $this->_skillRdoRepository());
        $skillId = strip_tags($this->request->getPost('skill_id'));
        $scoreValue = strip_tags($this->request->getPost('score'));
        $response = $service->execute($this->_getTalentId(), $skillId, $scoreValue);
        if(false === $response->getStatus()){
            $this->displayErrorMessages($response->errorMessage()->getDetails());
            return $this->forward('talentskill/new');
        }
        $this->flash->success('skill score created');
        return $this->forward('talentskill/index');
    }
    
    function editAction($skillScoreId){
        $service = $this->_querySkillScoreService();
        $response = $service->showByid($this->_getTalentId(), $skillScoreId);
        if(false === $response->getStatus()){
            $this->displayErrorMessages($response->errorMessage()->getDetails());
            return $this->forward('talentskill/index');
        }
        $skillScoreRdo = $response->firstReadDataObject();
        Tag::displayTo("id", $skillScoreRdo->getId());
        Tag::displayTo("skill", $skillScoreRdo->skillRDO()->trackReadDataObject()->getName() . " - " . $skillScoreRdo->skillRDO()->getName());
        Tag::displayTo("score", $skillScoreRdo->getScoreValue());
    }
    
    function updateAction(){
        if(!$this->request->isPost()){
            return $this->forward('talentskill/index');
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
        return $this->forward('talentskill/index');
    }
    function removeAction($skillScoreId){
        $service = $this->_commandSkillScoreService();
        $response = $service->remove($this->_getTalentId(), $skillScoreId);
        if(false === $response){
            $this->displayErrorMessages($response->errorMessage()->getDetails());
        }else{
            $this->flash->success("skill score removed");
        }
        return $this->forward('talentskill/index');
    }
}
