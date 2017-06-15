<?php

namespace Team\Profile\DomainModel\Talent;

use Superclass\DomainModel\Team\TeamReadDataObject;
use Superclass\DomainModel\Talent\IBaseTalentRepository;

interface ITalentRepository extends IBaseTalentRepository{
    /**
     * @param type $id
     * @return Talent
     */
    function ofId($id);
    
    /**
     * @param TeamReadDataObject $teamRdo
     * @param type $offset
     * @param type $limit
     * @return Talent[]
     */
    function availableTalentToInvite(TeamReadDataObject $teamRdo, $offset, $limit);
    
    function update();
    
}
