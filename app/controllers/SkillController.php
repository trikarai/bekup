<?php

use Phalcon\Tag;
use Talent\Skill\ApplicationService\Skill\CommandSkillService;
use Talent\Skill\ApplicationService\Skill\RemoveSkillService;
use Talent\Skill\ApplicationService\Skill\QuerySkillService;
use Track\Definition\ApplicationService\Track\QueryTrackService;

class SkillController extends ManagerialControllerBase{
    protected function _skillRepository(){
        return $this->em->getRepository('\Talent\Skill\DomainModel\Skill\Skill');
    }
    protected function _trackRdoRepository(){
        return $this->em->getRepository('\Superclass\DomainModel\Track\TrackReadDataObject');
    }
    protected function _querySkillService(){
        $skillRdoRepository = $this->em->getRepository('Talent\Skill\DomainModel\Skill\DataObject\SkillReadDataObject');
        return new QuerySkillService($skillRdoRepository);
    }
    protected function _commandSkillService(){
        return new CommandSkillService($this->_skillRepository(), $this->_personnelRdoRepository(), $this->_trackRdoRepository());
    }
    protected function _getTrackList(){
        $service = new QueryTrackService($this->_trackRdoRepository());
        $response = $service->showAll();
        if(false === $response->getStatus()){
            $this->displayErrorMessages($response->errorMessage()->getDetails());
        }
        $trackList = [];
        foreach($response->arrayOfReadDataObject() as $trackRdo){
            $trackList[$trackRdo->getId()] = $trackRdo->getName();
        }
        return $trackList;
    }
    
    public function indexAction(){
        $service = $this->_querySkillService();
        $response = $service->showAll();
        if(false === $response->getStatus()){
            $this->displayErrorMessages($response->errorMessage()->getDetails());
        }
        $this->view->skillRdos = $response->arrayOfReadDataObject();
    }

    public function newAction() {
        if($this->request->isPost()){
            Tag::displayTo('name', $this->request->getPost('name'));
        }
        $this->view->trackList = $this->_getTrackList();
    }
    
    public function addAction(){
        if(!$this->request->isPost()){
            return $this->forward('skill/new');
        }
        $trackId = strip_tags($this->request->getPost('track_id'));
        $name = strip_tags($this->request->getPost('name'));
        
        $service = $this->_commandSkillService();
        $response = $service->add($this->_getPersonnelId(), $name, $trackId);
        if(false === $response->getStatus()){
            $this->displayErrorMessages($response->errorMessage()->getDetails());
            return $this->forward('skill/new');
        }
        $this->flash->success("skill created");
        return $this->forward('skill/index');
    }


    public function editAction($skillId){
        $service = $this->_querySkillService();
        $response = $service->showById($skillId);
        if(false === $response){
            $this->displayErrorMessages($response->errorMessage()->getDetails());
            return $this->forward('skill/index');
        }
        $skillRdo = $response->firstReadDataObject();
        Tag::displayTo('id', $skillRdo->getId());
        Tag::displayTo('name', $skillRdo->getName());
        $this->view->trackList = $this->_getTrackList();
    }

    public function updateAction(){
        if(!$this->request->isPost()){
            return $this->forward('skill/index');
        }
        
        $id = strip_tags($this->request->getPost('id'));
        $trackId = strip_tags($this->request->getPost('track_id'));
        $name = strip_tags($this->request->getPost('name'));
        $service = $this->_commandSkillService();
        $response = $service->update($this->_getPersonnelId(), $id, $name, $trackId);
        if(false === $response->getStatus()){
            $this->displayErrorMessages($response->errorMessage()->getDetails());
        }else{
            $this->flash->success("skill updated");
        }
        return $this->forward('skill/index');
    }
    
    function removeAction($skillId){
        $service = new RemoveSkillService($this->_skillRepository(), $this->_personnelRdoRepository());
        $response = $service->execute($this->_getPersonnelId(), $skillId);
        if(false === $response->getStatus()){
            $this->displayErrorMessages($response->errorMessage()->getDetails());
        }else{
            $this->flash->success('skill removed');
        }
        return $this->forward('skill/index');
    }
}

?>