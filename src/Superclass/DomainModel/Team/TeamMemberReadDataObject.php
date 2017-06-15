<?php

namespace Superclass\DomainModel\Team;

use Resources\IReadDataObject;
use Superclass\DomainModel\Talent\TalentReadDataObject;

abstract class TeamMemberReadDataObject{
    protected $id;
    protected $status;
    protected $position;
    protected $isAdmin = false;
    protected $isCreator = false;
    /**
     * @var TalentReadDataObject
     */
    protected $talentRDO;
    
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

    function __construct($id, $status, $position, $isAdmin, $isCreator, TalentReadDataObject $talentRDO) {
        $this->id = $id;
        $this->status = $status;
        $this->position = $position;
        $this->isAdmin = $isAdmin;
        $this->isCreator = $isCreator;
        $this->talentRDO = $talentRDO;
    }
}
