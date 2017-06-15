<?php

namespace Team\Programme\DomainModel\Team;

interface ITeamQueryRepository {
    /**
     * @param type $id
     * @return TeamQuery
     */
    function ofId($id);
}
