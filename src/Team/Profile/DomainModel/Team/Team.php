<?php

namespace Team\Profile\DomainModel\Team;

use Superclass\DomainModel\Team\TeamAbstract;
use Team\Profile\DomainModel\Talent\Talent;
use Team\Profile\DomainModel\Membership\Membership;
use Superclass\DomainModel\Team\TeamMemberReadDataObject;
use Team\Profile\DomainModel\Team\DataObject\TeamWriteDataObject;
use Superclass\DomainModel\City\CityReadDataObject;

use Resources\ErrorMessage;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;

class Team extends TeamAbstract{
    /** @var ArrayCollection */
    protected $members;
    
    /**
     * @param type $memberId
     * @return TeamMemberReadDataObject||null
     */
    function aMembershipRDO_ofMemberId($memberId){
        $membership = $this->_findMember($memberId);
        if(empty($membership)){
            return null;
        }
        return $membership->toTeamMemberReadDataObject();
    }
    /**
     * @return TeamMemberReadDataObject[]
     */
    function allActiveMembershipRDO(){
        $rdos = [];
        $criteria = Criteria::create()
                ->where(Criteria::expr()->contains('status', 'active'));
        foreach($this->members->matching($criteria)->toArray() as $membership){
            $rdos[] = $membership->toTeamMemberReadDataObject();
        }
        return $rdos;
    }
    /**
     * @return TeamMemberReadDataObject[]
     */
    function allInvitedMembershipRDO(){
        $rdos = [];
        $criteria = Criteria::create()
                ->where(Criteria::expr()->contains('status', 'invited'));
        foreach($this->members->matching($criteria)->toArray() as $membership){
            $rdos[] = $membership->toTeamMemberReadDataObject();
        }
        return $rdos;
    }
    
    public function __construct($id, TeamWriteDataObject $request, CityReadDataObject $cityRDO) {
        $this->members = new ArrayCollection();
        
        $this->id = $id;
        $this->name = $request->getName();
        $this->vision = $request->getVision();
        $this->mission = $request->getMission();
        $this->culture = $request->getCulture();
        $this->founderAgreement = $request->getFounderAgreement();
        $this->cityRDO = $cityRDO;
    }
    
    /**
     * @param type $commanderMemberId
     * @param TeamWriteDataObject $request
     * @return true||ErrorMessage
     */
    function changeProfile($commanderMemberId, TeamWriteDataObject $request){
        if(true !== $msg = $this->_checkCommanderIsAdmin($commanderMemberId)){
            return $msg;
        }
        $this->name = $request->getName();
        $this->vision = $request->getVision();
        $this->mission = $request->getMission();
        $this->culture = $request->getCulture();
        $this->founderAgreement = $request->getFounderAgreement();
        return true;
    }
    
    /**
     * 
     * @param type $commanderMemberId
     * @param Talent $invitedTalent
     * @param type $position
     * @param type $isAdmin
     * @return true||ErrorMessage
     */
    function inviteNewMember($commanderMemberId, Talent $invitedTalent, $position, $isAdmin = false){
        $msg = true;
        if(true !== $msg = $this->_checkCommanderIsAdmin($commanderMemberId)){
        }else if($invitedTalent->cityRdo()->getId() !== $this->CityRDO()->getId()){
            $msg = ErrorMessage::error400_BadRequest(['cannot invite talent from other city']);
        }else if(true !== $msg = $this->_checkInvitedTalentNotAlreadyInActiveOrInvitedList($invitedTalent)){
        }else{
            $id = $this->members->count() + 1;
            $newMember = Membership::asInvited($id, $position, $invitedTalent, $this, $isAdmin);
            $this->members->set($id, $newMember);
        }
        return $msg;
    }
        
    /**
     * @param type $commanderMemberId
     * @param type $memberIdToCancel
     * @return true||ErrorMessage
     */
    function cancelInvitation($commanderMemberId, $memberIdToCancel){
        $memberToCancel = $this->_findMember($memberIdToCancel);
        $msg = true;
        if(true !== $msg = $this->_checkCommanderIsAdmin($commanderMemberId)){
        }else if(empty($memberToCancel)){
            $msg = ErrorMessage::error404_NotFound(['member not found']);
        }else {
            $msg = $memberToCancel->changeStatus('cancel');
        }
        return $msg;
    }
    
    /**
     * @param type $commanderMemberId
     * @param type $memberIdToRemove
     * @return true||ErrorMessage
     */
    function removeMember($commanderMemberId, $memberIdToRemove){
        $membership = $this->_findMember($memberIdToRemove);
        $msg = true;
        if(true !== $msg = $this->_checkCommanderIsAdmin($commanderMemberId)){
        }else if(empty($membership)){
            $msg = ErrorMessage::error404_NotFound(['member not found']);
        }else if($membership->getIsCreator()){
            $msg = ErrorMessage::error403_Forbidden(['cannot remove team creator, team creator can only resign by him/herself']);
        }else{
            $msg = $membership->changeStatus('remove');
        }
        return $msg;
    }
    
    /**
     * @param type $commanderMemberId
     * @return true||ErrorMessage
     */
    protected function _checkCommanderIsAdmin($commanderMemberId){
        $criteria = Criteria::create()
                ->where(Criteria::expr()->andX(
                        Criteria::expr()->contains('status', 'active'),
                        Criteria::expr()->eq('id', $commanderMemberId),
                        Criteria::expr()->eq('isAdmin', true)
                ));
        if(0 !== $this->members->matching($criteria)->count()){
            return true;
        }
        return ErrorMessage::error401_Unauthorized(['unauthorized access: only active admin can make this request']);
    }
    /**
     * @param type $invitedTalentId
     * @return true||ErrorMessage
     */
    protected function _checkInvitedTalentNotAlreadyInActiveOrInvitedList(Talent $talent){
        foreach($this->_arrayOfActiveMember() as $activeMember){
            if($talent->getId() === $activeMember->getTalentId()){
                return ErrorMessage::error409_Conflict(['invited talent already active member of this team']);
            }
        }
        foreach($this->_arrayOfInvitedMember() as $invitedMember){
            if($talent->getId() === $invitedMember->getTalentId()){
                return ErrorMessage::error409_Conflict(['invited talent already in team inviting list']);
            }
        }
        return true;
    }
    /**
     * @return Membership[]
     */
    protected function _arrayOfActiveMember(){
        $criteria = Criteria::create()
                ->where(Criteria::expr()->contains('status', 'active'));
        return $this->members->matching($criteria)->toArray();
    }
    /**
     * @return Membership[]
     */
    protected function _arrayOfInvitedMember(){
        $criteria = Criteria::create()
                ->where(Criteria::expr()->contains('status', 'invited'));
        return $this->members->matching($criteria)->toArray();
    }
    /**
     * @param type $memberId
     * @return Membership
     */
    protected function _findMember($memberId){
        return $this->members->get($memberId);
    }
}
