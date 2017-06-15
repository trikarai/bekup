<?php

namespace Talent\Training\DomainModel\Talent;

use Talent\Training\DomainModel\Talent\Talent;
use Superclass\DomainModel\Talent\IBaseTalentRepository;

interface ITalentRepository extends IBaseTalentRepository{
    /**
     * @param type $id
     * @return Talent
     */
    function ofId($id);
    
    function update();
}
