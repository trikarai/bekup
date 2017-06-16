<?php

namespace Team;

use Team\Profile\ApplicationService\Talent\QueryMembershipService;
use Team\Profile\ApplicationService\Team\QueryMemberService;
use Superclass\DomainModel\Team\TeamMemberReadDataObject;

class DashboardController extends \TalentControllerBase{
    function indexAction(){
        $service = new QueryMembershipService($this->_talentRepository());
        $response = $service->showActiveMembership($this->_getTalentId());
        if(false === $response->getStatus()){
            $this->displayErrorMessages($response->errorMessage()->getDetails());
            return $this->forward('dashboard/noTeam');
        }
        $membershipRdo = $response->firstReadDataObject();
        $this->view->pick("team/dashboard/index");
    
        $this->view->teamRdo = $membershipRdo->teamRDO();
        $this->view->selfMemberRdo = $membershipRdo;
        $this->view->otherMemberList = $this->_getOtherActiveTeamMemberList($membershipRdo->getId());
        $this->view->invitedList = $this->_getInvitedMemberList();
        
    }

    function noTeamAction(){
        $this->view->pick("team/dashboard/noTeam");
    }
    
    protected function _transformTeamMemberRdoToArray(TeamMemberReadDataObject $rdo){
        $name = $rdo->talentRDO()->getName();
        preg_match_all('~\b(\S){1}~', $name, $i);
        $initial =  @$i[1][0].@$i[1][1];
        return array(
            'id' => $rdo->getId(),
            'talent_id' => $rdo->talentRDO()->getId(),
            'name' => $name,
            'initial' => $initial,
            'position' => $rdo->getPosition(),
            'is_admin' => $rdo->getIsAdmin(),
            'is_creator' => $rdo->getIsCreator(),
        );
    }
    protected function _talentRepository(){
        return $this->em->getRepository('\Team\Profile\DomainModel\Talent\Talent');
    }
    protected function _queryMemberService(){
        $teamRepository = $this->em->getRepository('\Team\Profile\DomainModel\Team\Team');
        return new QueryMemberService($teamRepository, $this->_talentRepository());
    }
    protected function _getOtherActiveTeamMemberList($myId){
        $service = $this->_queryMemberService();
        $response = $service->showAllActiveMember($this->_getTalentId());
        $memberList = [];
        foreach($response->arrayOfReadDataObject() as $rdo){
            if($myId !== $rdo->getId()){
                $memberList[] = $this->_transformTeamMemberRdoToArray($rdo);
            }
        }
        return $memberList;
    }
    protected function _getInvitedMemberList(){
        $service = $this->_queryMemberService();
        $response = $service->showAllInvitedMember($this->_getTalentId());
        $invitedList = [];
        foreach($response->arrayOfReadDataObject() as $rdo){
            $invitedList[] = $this->_transformTeamMemberRdoToArray($rdo);
        }
        return $invitedList;
    }
}
