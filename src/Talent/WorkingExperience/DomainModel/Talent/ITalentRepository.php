<?php

namespace Talent\WorkingExperience\DomainModel\Talent;

interface ITalentRepository{
    /**
     * 
     * @param type $id
     * @return Talent
     */
    function ofId($id);
    
    function update();
}
