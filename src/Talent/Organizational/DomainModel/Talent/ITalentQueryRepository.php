<?php

namespace Talent\Organizational\DomainModel\Talent;

interface ITalentQueryRepository {
    /**
     * @param type $id
     * @return TalentQuery
     */
    function ofId($id);
}
