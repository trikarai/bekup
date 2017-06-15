<?php

namespace Superclass\DomainModel\Team;

use Resources\IReadDataObject;
use Superclass\DomainModel\Talent\TalentReadDataObject;

class TeamMemberReadDataObject implements IReadDataObject{
    protected $id;
    protected $status;
    protected $position;
    protected $isAdmin = false;
    protected $isCreator = false;
    /**
     * @var TalentReadDataObject
     */
    protected $talentRDO;
    protected $team;
    
    function getId() {
        return $this->id;
    }
    function getStatus() {
        return $this->status;
    }
    function getPosition() {
        return $this->position;
    }
    function getIsAdmin() {
        return $this->isAdmin;
    }
    function getIsCreator() {
        return $this->isCreator;
    }
    function talentRDO() {
        return $this->talentRDO;
    }
    function getTalentId(){
        return $this->talentRDO->getId();
    }

    function __construct($id, $status, $position, $isAdmin, $isCreator, TalentReadDataObject $talentRDO) {
        $this->id = $id;
        $this->status = $status;
        $this->position = $position;
        $this->isAdmin = $isAdmin;
        $this->isCreator = $isCreator;
        $this->talentRDO = $talentRDO;
    }
    
    function toArray() {
        return Array(
            'id' => $this->getId(),
            'status' => $this->getStatus(),
            'position' => $this->getPosition(),
            'is_creator' => $this->getIsCreator(),
            'is_admin' => $this->getIsAdmin(),
            'talent' => $this->talentRDO->toArray(),
        );
    }
}
