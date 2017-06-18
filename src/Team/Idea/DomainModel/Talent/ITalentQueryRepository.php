<?php

namespace Team\Idea\DomainModel\Talent;

interface ITalentQueryRepository {
    /**
     * @param type $id
     * @return TalentQuery
     */
    function ofId($id);
}
