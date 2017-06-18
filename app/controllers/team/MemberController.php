<?php

namespace Team;

use Team\Profile\ApplicationService\Team\InviteTeamMemberService;
use Team\Profile\ApplicationService\Team\CommandTeamMemberService;
use Team\Profile\ApplicationService\Talent\CommandMemberService;
use Team\Profile\ApplicationService\Team\AvailableTalentToInviteService;

use Talent\Profile\ApplicationService\Talent\QueryTalentService;

class MemberController extends \TalentControllerBase{
    
    function inviteAction($offset = 0){
        $this->view->pick('team/member/invite');
        $service = new AvailableTalentToInviteService($this->_talentRepository());
        $response = $service->execute($this->_getTalentId(), $offset, 100);
        if(false === $response->getStatus()){
            $this->displayErrorMessages($response->errorMessage()->getDetails());
        }
        $this->view->inviteeList = $response->arrayOfReadDataObject();
        
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
        $idOfTalentToInvite = strip_tags($this->request->getPost('talent_id'));
        $position = strip_tags($this->request->getPost('position'));
        $isAdmin = false;
        if(isset($_POST['is_admin'])){
            $isAdmin = true;
        }
        $response = $service->execute($this->_getTalentId(), $idOfTalentToInvite, $position, $isAdmin);
        if(false === $response->getStatus()){
            $this->displayErrorMessages($response->errorMessage()->getDetails());
        }else{
            $this->flash->success('talent invited');
        }
        return $this->forward('member/invite');
    }
    
    function cancelAction(){
        
    }
    function removeAction(){
        
    }
    function resignAction(){    
        
    }
    function rejectAction(){
        
    }
    
    protected function _talentRepository(){
        return $this->em->getRepository('\Team\Profile\DomainModel\Talent\Talent');
    }
    protected function _teamRepository(){
        return $this->em->getRepository('Team\Profile\DomainModel\Team\Team');
    }
}
