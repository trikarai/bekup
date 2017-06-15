<?php

use Phalcon\Tag;


use Talent\Application\Service\TalentClass\ApplyTalentClassService;
use Talent\Application\Service\TalentClass\DTO\QueryTalentClassDTO;
use Talent\Application\Service\TalentClass\QueryTalentClassService;
use Talent\Application\Service\TalentClass\CancelTalentClassService;
use Talent\Domain\Model\TalentClass\Exception\DuplicateCityClassException;
use Managerial\Application\Service\CityClass\Helper\ExternalCityClassFinderHelper;

class TalentclassController extends TalentControllerBase{
    public function indexAction(){
        if(!$this->_getSessionId()){return $this->forward('login');}
        $service = new QueryTalentClassService($this->_talentClassParticipationRepository(), $this->_externalCityClassFinderHelperRepository());
        $talentClassDTOs = $service->showAll($this->_getSessionId());
        $this->view->talentClassDTOs = $talentClassDTOs;  
    }
    public function newAction(){
        if(!$this->_getSessionId()){return $this->forward('login');}
        $service = new QueryTalentClassService($this->_talentClassParticipationRepository(), $this->_externalCityClassFinderHelperRepository());
        $cityClassDTOs = $service->showAllClassReference($this->_getSessionId());
        $this->view->cityClassDTOs = $cityClassDTOs;
    }
    public function applyAction($cityClassIdString){
//    public function applyAction(){
//        if(!$this->request->isPost()){return $this->forward('talentclass/index');}
//        $cityClassIdString = strip_tags($this->request->getPost('cityClassIdString'));  
        $service = new ApplyTalentClassService($this->_talentClassParticipationRepository(), $this->_externalCityClassFinderHelperRepository());        
        try{
        $service->execute($cityClassIdString, $this->_getSessionId());
            $this->flash->success("Apply Class Successfull");
            return $this->forward('talentclass/index');
        } catch (DuplicateCityClassException $ex) {
            $this->flash->error("Class Already Apllied");
            return $this->forward('talentclass/new');
        }
    }
    public function cancelAction($talentClassIdString){
        $service = new CancelTalentClassService($this->_talentClassParticipationRepository());
        try {
            $service->execute($talentClassIdString, $this->_getSessionId());
            $this->flash->success('Class Canceled');
        } catch (\Managerial\Domain\Model\CityClass\Exception\CityClassNotFoundException $ex) {
            $this->flash->error('Fail to Cancel Class');
        }
        return $this->forward('talentclass/index');
    }
    public function resignAction($talentClassIdString){
        $this->flash->success('Ops..!!');
    }
    /*
     * Repository
     */
    protected function _getSessionId(){
        return $this->session->get('auth')['id'];
    }
    protected function _talentClassParticipationRepository(){
        return $this->em->getRepository('Talent\Domain\Model\TalentClass\TalentClassParticipation');
    }
    protected function _externalCityClassFinderHelperRepository(){
        return new ExternalCityClassFinderHelper($this->em->getRepository('\Managerial\Domain\Model\CityClass\CityClass'));
    }
}