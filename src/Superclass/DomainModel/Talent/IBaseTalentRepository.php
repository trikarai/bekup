<?php

namespace Superclass\DomainModel\Talent;

interface IBaseTalentRepository {
    /**
     * @param type $id
     * @return TalentAbstract
     */
    function ofId($id);
}
