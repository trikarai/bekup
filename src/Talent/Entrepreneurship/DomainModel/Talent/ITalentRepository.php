<?php

namespace Talent\Entrepreneurship\DomainModel\Talent;

interface ITalentRepository {
    /**
     * @param type $id
     * @return Talent
     */
    function OfId($id);
    
    function update();
}
