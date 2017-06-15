<?php

namespace Team\Programme\DomainModel\Team;

use Resources\IReadDataObject;
use Superclass\DomainModel\Talent\TalentReadDataObject;
use Superclass\DomainModel\Team\TeamMemberReadDataObject;

class TeamMemberRdo extends TeamMemberReadDataObject implements IReadDataObject{
    protected $team;
    
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
