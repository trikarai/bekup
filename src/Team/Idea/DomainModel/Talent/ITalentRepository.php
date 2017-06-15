<?php

namespace Team\Idea\DomainModel\Talent;

use Superclass\DomainModel\Talent\IBaseTalentRepository;

interface ITalentRepository extends IBaseTalentRepository{
    
    /**
     * @param string $id
     * @return Talent
     */
    function ofId($id);
    
    function update();
}
