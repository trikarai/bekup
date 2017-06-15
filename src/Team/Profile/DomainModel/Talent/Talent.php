<?php

namespace Team\Profile\DomainModel\Talent;

use Superclass\DomainModel\Talent\TalentAbstract;
use Team\Profile\DomainModel\Team\Team;
use Team\Profile\DomainModel\Team\DataObject\TeamWriteDataObject;
use Team\Profile\DomainModel\Membership\Membership;
use Team\Profile\DomainModel\Membership\DataObject\TalentMembershipReadDataObject;

use Resources\ErrorMessage;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;

class Talent extends TalentAbstract{
    /**
     * @var ArrayCollection
     */
    protected $teamMemberships;

    /**
     * @return TalentMembershipReadDataObject||null
     */
    function anActiveMembershipRDO(){
        $membership = $this->_findActiveMembership();
        if(empty($membership)){
            return null;
        }
        return $membership->toTalentMembershipReadDataObject();
    }
    
    /**
     * @param type $teamId
     * @param type $membershipId
     * @return TalentMembershipReadDataObject||null
     */
    function aMembershipRDO_ofTeamIdAndMembershipId($teamId,$membershipId){
        $membership = $this->_findMembershipByTeamIdAndId($teamId, $membershipId);
        if(empty($membership)){
            return null;
        }
        return $membership->toTalentMembershipReadDataObject();
    }
    
    /**
     * @return TalentMembershipReadDataObject[]
     */
    function allInvitedMembershipRDO(){
        $rdos = [];
        foreach($this->_arrayOfInvitedMembership() as $membership){
            $rdos[] = $membership->toTalentMembershipReadDataObject();
        }
        return $rdos;
    }

    protected function __construct() {
        $this->teamMemberships = new ArrayCollection();
    }
    
    /**
     * @param TeamWriteDataObject $request
     * @param type $position
     * @return true||ErrorMessage
     */
    function createTeam($teamId, TeamWriteDataObject $request, $position){
        if(true !== $msg = $this->_checkHasNoActiveTeamMember()){
            return $msg;
        }
        $team = new Team($teamId, $request, $this->cityRDO);
        $membership = Membership::asCreator($position, $this, $team);
        $this->teamMemberships->add($membership);
        return true;
    }
    
    /**
     * @param type $teamId
     * @param type $membershipId
     * @return true||ErrorMessage
     */
    function acceptTeamInvitation($teamId, $membershipId){
        $membership = $this->_findMembershipByTeamIdAndId($teamId, $membershipId);
        $msg = true;
        if(empty($membership)){
            $msg = ErrorMessage::error404_NotFound(['membership invitation not found']);
        }else if(true !== $msg = $this->_checkHasNoActiveTeamMember()){
        }else{
            $msg = $membership->changeStatus('active');
        }
        return $msg;
    }
    
    /**
     * @param type $teamId
     * @param type $membershipId
     * @return true||ErrorMessage
     */
    function rejectTeamInvitation($teamId, $membershipId){
        $membership = $this->_findMembershipByTeamIdAndId($teamId, $membershipId);
        $msg = true;
        if(empty($membership)){
            $msg = ErrorMessage::error404_NotFound(['membership invitation not found']);
        }else{
            $msg = $membership->changeStatus('reject');
        }
        return $msg;
    }
    
    /**
     * @return true||ErrorMessage
     */
    function resign(){
        $activeMembership = $this->_findActiveMembership();
        $msg = true;
        if(empty($activeMembership)){
            return ErrorMessage::error404_NotFound(['no active team membership found']);
        }else{
            $msg = $activeMembership->changeStatus('resign');
        }
        return $msg;
    }
    
    /**
     * @return Membership
     */
    protected function _findActiveMembership(){
        $criteria = Criteria::create()
                ->where(Criteria::expr()->contains('status', 'active'));
        return $this->teamMemberships->matching($criteria)->first();
    }
    /**
     * @return true||ErrorMessage
     */
    protected function _checkHasNoActiveTeamMember(){
        $criteria = Criteria::create()
                ->where(Criteria::expr()->eq('status', 'active'));
        if(0 === $this->teamMemberships->matching($criteria)->count()){
            return true;
        }
        return ErrorMessage::error409_Conflict(['already active team member, please quit from current team to proceed']);
    }
    /**
     * @param type $teamId
     * @return Membership||null
     */
    protected function _findMembershipByTeamIdAndId($teamId, $membershipId){
        foreach($this->_arrayOfMembershipById($membershipId) as $membership){
            if($teamId === $membership->getTeamId()){
                return $membership;
            }
        }
        return null;
    }
    /**
     * @return Membership[]
     */
    protected function _arrayOfMembershipById($membershipId){
        $criteria = Criteria::create()
                ->where(Criteria::expr()->eq('id', $membershipId));
        return $this->teamMemberships->matching($criteria)->toArray();
    }
    /**
     * @return Membership[]
     */
    protected function _arrayOfInvitedMembership(){
        $criteria = Criteria::create()
                ->where(Criteria::expr()->contains('status', 'invited'));
        return $this->teamMemberships->matching($criteria)->toArray();
    }
}
