<?php

use Region\Application\Service\CityTeamClass\DTO\CommandCityTeamClassDTO;
use Region\Application\Service\CityTeamClass\ShowCityTeamClassService;
use Region\Application\Service\CityTeamClass\ShowTeamWithinTeamClassService;

class CityteamclassController extends ControllerBase{
    
    public function indexAction(){
        $service = new ShowCityTeamClassService($this->_cityteamClassRepository(), $this->_internalPersonnelFinderHelper(), $this->_externalTeamClassFinder());
        $cityteamClassDTOs = $service->showAllCityTeamClass($this->_getSessionId());
        $this->view->cityteamClassDTOs = $cityteamClassDTOs;
        
    }
    
    
    /*
     * Repository
     */
    protected function _getSessionId(){
//        return $this->session->get('auth')['id'];
        return 'f3e9f674-c98d-4db1-918c-1f30a465d283';
    }
    protected function _cityteamClassRepository(){
        return $this->em->getRepository('\Region\Domain\Model\CityTeamClass\CityTeamClass');
    }
    protected function _internalPersonnelFinderHelper(){
        return new \Managerial\Application\Service\Personnel\Helper\InternalPersonnelFinderHelper($this->em->getRepository('Managerial\Domain\Model\Personnel\Personnel'));
    }
    protected function _externalTeamClassFinder(){
        return new \Managerial\Application\Service\TeamClass\Helper\ExternalTeamClassFinderHelper($this->em->getRepository('\Managerial\Domain\Model\TeamClass\TeamClass'));
    }
}

