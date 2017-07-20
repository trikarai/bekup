<?php

namespace Team;

use Team\Profile\ApplicationService\Team\InviteTeamMemberService;
use Team\Profile\ApplicationService\Team\CommandTeamMemberService;
use Team\Profile\ApplicationService\Talent\CommandMemberService;
use Team\Profile\ApplicationService\Team\AvailableTalentToInviteService;

use Talent\Profile\ApplicationService\Talent\QueryTalentService;

class MemberController extends \TalentControllerBase{

    function inviteAction(){
        $this->view->pick('team/member/invite');
    }
    
    function profileAction($talentId){
        $this->view->pick('team/member/profile');
        $talentRdoRepository = $this->em->getRepository('\Superclass\DomainModel\Talent\TalentReadDataObject');
        $service = new QueryTalentService($talentRdoRepository);
        $response = $service->showOneById($talentId);
        if(false === $response->getStatus()){
            $this->displayErrorMessages($response->errorMessage()->getDetails());
            return $this->forward('member/invite');
        }
        $this->view->talentRdo = $response->firstReadDataObject();
    }
    
    function sendAction(){
        $service = new InviteTeamMemberService($this->_teamRepository(), $this->_talentRepository());
        $email = strip_tags($this->request->getPost('email'));
        $position = strip_tags($this->request->getPost('position'));
        $isAdmin = false;
        if(isset($_POST['is_admin'])){
            $isAdmin = true;
        }
        $response = $service->execute($this->_getTalentId(), $email, $position, $isAdmin);
        if(false === $response->getStatus()){
            $this->displayErrorMessages($response->errorMessage()->getDetails());
        }else{
            $this->flash->success('talent invited');
        }
        return $this->forward('member/invite');
    }
    
    function cancelAction($memberId){
        $service = $this->_commandTeamMemberService();
        $response = $service->cancelInvitation($this->_getTalentId(), $memberId);
        if(false === $response->getStatus()){
            $this->displayErrorMessages($response->errorMessage()->getDetails());
        }
        return $this->forwardNamespace('Team/dashboard/index');
    }
    function removeAction($memberId){
        $service = $this->_commandTeamMemberService();
        $response = $service->removeMember($this->_getTalentId(), $memberId);
        if(false === $response->getStatus()){
            $this->displayErrorMessages($response->errorMessage()->getDetails());
        }
        return $this->forwardNamespace('Team/dashboard/index');
    }
    function resignAction(){
        $service = $this->_commandMemberService();
        $response = $service->resign($this->_getTalentId());
        if(false === $response->getStatus()){
            $this->displayErrorMessages($response->errorMessage()->getDetails());
        }
        return $this->forwardNamespace('Team/dashboard/index');
    }
    function rejectAction($teamId, $memberId){
        $service = $this->_commandMemberService();
        $response = $service->rejectInvitation($this->_getTalentId(), $teamId, $memberId);
        if(false === $response->getStatus()){
            $this->displayErrorMessages($response->errorMessage()->getDetails());
        }
        return $this->forwardNamespace('Team/dashboard/index');
    }
    function acceptAction($teamId, $memberId){
        $service = $this->_commandMemberService();
        $response = $service->acceptInvitation($this->_getTalentId(), $teamId, $memberId);
        if(false === $response->getStatus()){
            $this->displayErrorMessages($response->errorMessage()->getDetails());
        }
        return $this->forwardNamespace('Team/dashboard/index');
    }
    
    protected function _talentRepository(){
        return $this->em->getRepository('\Team\Profile\DomainModel\Talent\Talent');
    }
    protected function _teamRepository(){
        return $this->em->getRepository('Team\Profile\DomainModel\Team\Team');
    }
    protected function _commandTeamMemberService(){
        return new CommandTeamMemberService($this->_teamRepository(), $this->_talentRepository());
    }
    protected function _commandMemberService(){
        return new CommandMemberService($this->_talentRepository());
    }
}
