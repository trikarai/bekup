<?php

namespace Team\Profile\DomainModel\Membership\DataObject;

use Resources\IReadDataObject;
use Superclass\DomainModel\Team\TeamReadDataObject;

class TalentMembershipReadDataObject implements IReadDataObject{
    protected $id;
    protected $status;
    protected $position;
    protected $isAdmin = false;
    protected $isCreator = false;
    protected $teamRDO;
    
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
    /**
     * @return TeamReadDataObject
     */
    function teamRDO() {
        return $this->teamRDO;
    }

    function __construct($id, $status, $position, $isAdmin, $isCreator, TeamReadDataObject $teamRDO) {
        $this->id = $id;
        $this->status = $status;
        $this->position = $position;
        $this->isAdmin = $isAdmin;
        $this->isCreator = $isCreator;
        $this->teamRDO = $teamRDO;
    }

    
    public function toArray() {
        return Array(
            'id' => $this->getId(),
            'status' => $this->getStatus(),
            'position' => $this->getPosition(),
            'is_creator' => $this->getIsCreator(),
            'is_admin' => $this->getIsAdmin(),
            'team' => $this->teamRDO()->toArray()
        );
    }
}
