<?php

namespace Talent\Education\DomainModel\Talent;

use Superclass\DomainModel\Talent\IBaseTalentRepository;

interface ITalentRepository extends IBaseTalentRepository{
    /**
     * @param type $id
     * @return Talent
     */
    function ofId($id);
    
    function update();
    
}
