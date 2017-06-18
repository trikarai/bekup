<?php

namespace Team\Idea\DomainModel\Team;

interface ITeamQueryRepository {
    /**
     * @param type $id
     * @return TeamQuery
     */
    function ofId($id);
}
