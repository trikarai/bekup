<?php


namespace Talent\Entrepreneurship\DomainModel\Talent;

interface ITalentQueryRepository {
    /**
     * @param type $id
     * @return TalentQuery
     */
    function ofId($id);
}
