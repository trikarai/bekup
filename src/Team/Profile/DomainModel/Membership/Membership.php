<?php

namespace Team\Profile\DomainModel\Membership;

use Resources\ErrorMessage;
use Team\Profile\DomainModel\Talent\Talent;
//use Team\Profile\DomainModel\Team\Team;
use Superclass\DomainModel\Team\TeamAbstract as Team;
//use Team\Profile\DomainModel\Membership\ValueObject\MembershipStatus;
use Team\Profile\DomainModel\Membership\DataObject\TalentMembershipReadDataObject;
//use Superclass\DomainModel\Team\TeamMemberReadDataObject;
use Team\Profile\DomainModel\Membership\DataObject\TeamMemberReadDataObject;

class Membership {
    protected $id;
    /**
     * @var MembershipStatus
     */
    protected $status;
    protected $position;
    protected $isAdmin = false;
    protected $isCreator = false;
    
    protected $talent;
    protected $team;
    
    function getId(){
        return $this->id;
    }
    function getStatus(){
        return $this->status;
    }
    function getIsAdmin(){
        return $this->isAdmin;
    }
    function getIsCreator(){
        return $this->isCreator;
    }
    function getTeamId(){
        return $this->team->getId();
    }
    function getTalentId(){
        return $this->talent->getId();
    }
    /**
     * @return TeamMemberReadDataObject
     */
    function toTeamMemberReadDataObject(){
        return new TeamMemberReadDataObject($this->id, $this->getStatus(), $this->position, 
                $this->isAdmin, $this->isCreator, $this->talent->toReadDataObject());
    }
    /**
     * @return TalentMembershipReadDataObject
     */
    function toTalentMembershipReadDataObject(){
        return new TalentMembershipReadDataObject($this->id, $this->getStatus(), $this->position, 
                $this->isAdmin, $this->isCreator, $this->team->toReadDataObject());
    }
    
    protected function __construct($id, $status, $position, Talent $talent, Team $team, $isAdmin = false, $isCreator = false) {
        $this->id = $id;
//        $this->status = MembershipStatus::{$status}();
        $this->status = $status;
        $this->position = $position;
        $this->isCreator = $isCreator;
        $this->isAdmin = $isAdmin;
        
        $this->talent = $talent;
        $this->team = $team;
    }

    static function asCreator($position, Talent $talent, Team $team){
        return new static(1, 'active', $position, $talent, $team, true, true);
    }
    
    static function asInvited($id, $position, Talent $talent, Team $team, $isAdmin = false){
        return new static($id, 'invited', $position, $talent, $team, $isAdmin);
    }
    
    /**
     * @param type $status
     * @return true||ErrorMessage
     */
    function changeStatus($status){
        $validTransitionFromInvited = ['active', 'reject', 'cancel'];
        $validTransitionFromActive = ['resign', 'remove'];
        $newStatus = strtolower($status);
        if('invited' === $this->getStatus() && in_array($newStatus, $validTransitionFromInvited)){
            $this->status = $newStatus;
            return true;
        }else if('active' === $this->getStatus() && in_array($newStatus, $validTransitionFromActive)){
            $this->status = $newStatus;
            return true;
        }
        return ErrorMessage::error400_BadRequest(['unknown status / invalid transition']);
    }
    function changePosition($position){
        $this->position = $position;
    }
    function setAsAdmin(){
        $this->isAdmin = true;
    }
}
