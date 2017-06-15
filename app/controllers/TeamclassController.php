<?php
use Phalcon\Tag;
use Managerial\Application\Service\TeamClass\DTO\CommandTeamClassDTO;
use Managerial\Application\Service\TeamClass\CommandTeamClassService;
use Managerial\Application\Service\TeamClass\QueryTeamClassService;
use Managerial\Domain\Model\TeamClass\Exception\TeamClassNotFoundException;
use Talent\Domain\Model\TeamClass\Exception\TeamClassParticipationNotFoundException;

class TeamclassController extends ControllerBase{
    
    public function indexAction(){
        $service = new QueryTeamClassService($this->_teamClassRepository(), $this->_internalPersonnelFinderHelper(), $this->_cityRepository());
        $teamClassDTOs = $service->showAll($this->_getSessionId());
        $this->view->teamClassDTOs = $teamClassDTOs;
    }
    public function newAction(){}
    public function addAction(){
        if(!$this->request->isPost()){$this->forward('teamclass/new');}
        
        $name = strip_tags($this->request->getPost('teamclassname'));
        $startRegistrationDate = strip_tags($this->request->getPost('start_registration_date'));
        $endRegistrationDate = strip_tags($this->request->getPost('end_registration_date'));
        $startOperationDate = strip_tags($this->request->getPost('start_operational_date'));
        $endOperationDate = strip_tags($this->request->getPost('end_operational_date'));
        
        $request = CommandTeamClassDTO::addRequest($name, $startRegistrationDate, $endRegistrationDate, $startOperationDate, $endOperationDate);
        $service = new CommandTeamClassService($this->_teamClassRepository(), $this->_internalPersonnelFinderHelper(), $this->_cityRepository());
        
        try {
            $service->add($request, $this->_getSessionId());
            $this->flash->success('Save OK');
            return $this->forward('teamclass/index');
        
        } catch (TeamClassNotFoundException $ex) {
            $this->flash->error('Fail');
            return $this->forward('teamclass/add');
        }       
    }
    public function editAction($teamClassIdString){
        $service = new QueryTeamClassService($this->_teamClassRepository(), $this->_internalPersonnelFinderHelper(), $this->_cityRepository());
        $teamClassDTO = $service->showById($teamClassIdString, $this->_getSessionId());
        $this->view->teamClassDTOs = $teamClassDTO;
        Tag::displayTo('id',$teamClassDTO->id());
        Tag::displayTo('teamclassname',$teamClassDTO->name());
        Tag::displayTo('start_registration_date',$teamClassDTO->startRegistrationDate());
        Tag::displayTo('end_registration_date',$teamClassDTO->endRegistrationDate());
        Tag::displayTo('start_operational_date',$teamClassDTO->startOperationDate());
        Tag::displayTo('end_operational_date',$teamClassDTO->endOperationDate());
    }
    public function updateAction(){
        if(!$this->request->isPost()){$this->forward('teamclass/index');}
        
        $id = strip_tags($this->request->getPost('id'));
        $name = strip_tags($this->request->getPost('teamclassname'));
        $startRegistrationDate = strip_tags($this->request->getPost('start_registration_date'));
        $endRegistrationDate = strip_tags($this->request->getPost('end_registration_date'));
        $startOperationDate = strip_tags($this->request->getPost('start_operational_date'));
        $endOperationDate = strip_tags($this->request->getPost('end_operational_date'));
        
        $request = CommandTeamClassDTO::updateRequest($id, $name, $startRegistrationDate, $endRegistrationDate, $startOperationDate, $endOperationDate);
        $service = new CommandTeamClassService($this->_teamClassRepository(), $this->_internalPersonnelFinderHelper(), $this->_cityRepository());
        
        try {
            $service->update($request, $this->_getSessionId());
            $this->flash->success('Update OK');
            return $this->forward('teamclass/index');
        
        } catch (TeamClassNotFoundException $ex) {
            $this->flash->error('Update Fail');
            return $this->forward('teamclass/index');
        }       
    }
    public function removeAction($teamClassIdString){
        $service = new CommandTeamClassService($this->_teamClassRepository(), $this->_internalPersonnelFinderHelper(), $this->_cityRepository());
        $service->remove($teamClassIdString, $this->_getSessionId());
        $this->flash->success('Remove OK');
        return $this->forward('teamclass/index');
    }

    /*
     * Repository
     */
    protected function _getSessionId(){
//        return $this->session->get('auth')['id'];
        return '471e1cb9-2c63-4847-9ea4-df006fefd17c';
    }
    protected function _teamClassRepository(){
        return $this->em->getRepository('\Managerial\Domain\Model\TeamClass\TeamClass');
    }
    protected function _cityRepository(){
        return $this->em->getRepository('Managerial\Domain\Model\City\City');
    }

    protected function _internalPersonnelFinderHelper(){
        return new \Managerial\Application\Service\Personnel\Helper\InternalPersonnelFinderHelper($this->em->getRepository('Managerial\Domain\Model\Personnel\Personnel'));
    }
    protected function _externalTeamClassFinder(){
        return new \Managerial\Application\Service\TeamClass\Helper\ExternalTeamClassFinderHelper($this->em->getRepository('\Managerial\Domain\Model\TeamClass\TeamClass'));
    }
}