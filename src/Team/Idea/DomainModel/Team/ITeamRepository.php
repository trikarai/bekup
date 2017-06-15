<?php

namespace Team\Idea\DomainModel\Team;

interface ITeamRepository {
    
    /**
     * @param string $teamId
     * @return Team
     */
    function ofId($teamId);
    
    function update();
}
