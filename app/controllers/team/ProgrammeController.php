<?php

namespace Team;

use Team\Programme\ApplicationService\Programme\QueryProgrammeService;
use Team\Programme\ApplicationService\Programme\QueryAvailableProgrammeService;
use Team\Programme\ApplicationService\Programme\ApplyProgrammeService;
use Team\Programme\ApplicationService\Programme\CommandProgrammeService;
use Team\Profile\ApplicationService\Team\QueryMemberService;

class ProgrammeController extends TeamControllerBase{
    protected function _queryProgrammeService(){
        $teamQueryRepository = $this->em->getRepository('Team\Programme\DomainModel\Team\TeamQuery');
        return new QueryProgrammeService($teamQueryRepository, $this->_activeMembershipFinder());
    }
    protected function _teamRepository(){
        return $this->em->getRepository('Team\Programme\DomainModel\Team\Team');
    }
    protected function _commandProgrammeService(){
        return new CommandProgrammeService($this->_teamRepository(), $this->_activeMembershipFinder());
    }
    
    function indexAction(){
        $service = new QueryMembershipService($this->_talentRepository());
        $response = $service->showActiveMembership($this->_getTalentId());
        if(false === $response->getStatus()){
            $this->displayErrorMessages($response->errorMessage()->getDetails());
            return $this->forward('dashboard/noTeam');
        }
        $this->view->pick('team/programme/index');
        $service = $this->_queryProgrammeService();
        $response = $service->showActiveProgramme($this->_getTalentId());
        if(false === $response->getStatus()){
            //$this->displayWarningMessages($response->errorMessage()->getDetails());
            return $this->forward('programme/participation');
        }
        $this->rdo = $response->firstReadDataObject();
    }
    
    function participationAction(){
        $this->view->pick('team/programme/participation');
        $participatedService = $this->_queryProgrammeService();
        $cityQueryRepository = $this->em->getRepository('\City\Programme\Description\DomainModel\City\CityQuery');
        $availableProgrammeService = new QueryAvailableProgrammeService($cityQueryRepository, $this->_activeMembershipFinder());
        
        $participatedProgrammeResponse = $participatedService->showAll($this->_getTalentId());
        $availableProgrammeResponse = $availableProgrammeService->showAll($this->_getTalentId());
        
        $this->view->participatedProgrammeRdos = $participatedProgrammeResponse->arrayOfReadDataObject();
        $this->view->availableProgrammeRdos = $availableProgrammeResponse->arrayOfReadDataObject();
    }
    
    function applyAction($cityProgrammeId){
        $cityQueryRepository = $this->em->getRepository('\City\Programme\Description\DomainModel\City\CityQuery');
        $service = new ApplyProgrammeService($this->_teamRepository(), $cityQueryRepository, $this->_activeMembershipFinder());
        $response = $service->execute($this->_getTalentId(), $cityProgrammeId);
        if(false === $response->getStatus()){
            $this->displayErrorMessages($response->errorMessage()->getDetails());
        }else{
            $this->flash->success('programme applied');
        }
        return $this->forward('programme/participation');
    }
    
    function cancelApplicationAction($teamProgrammeId){
        $service = $this->_commandProgrammeService();
        $response = $service->cancelApplication($this->_getTalentId(), $teamProgrammeId);
        if(false === $response->getStatus()){
            $this->displayErrorMessages($response->errorMessage()->getDetails());
        }else{
            $this->flash->success('programme application cancelled');
        }
        return $this->forward('programme/participation');
    }
    
    function resignAction($teamProgrammeId){
        $service = $this->_commandProgrammeService();
        $response = $service->resignProgramme($this->_getTalentId(), $teamProgrammeId);
        if(false === $response->getStatus()){
            $this->displayErrorMessages($response->errorMessage()->getDetails());
        }else{
            $this->flash->success('successfully resign from programme');
        }
        return $this->forward('programme/participation');
    }
    
    protected function _talentRepository(){
        return $this->em->getRepository('\Team\Profile\DomainModel\Talent\Talent');
    }
    
}
