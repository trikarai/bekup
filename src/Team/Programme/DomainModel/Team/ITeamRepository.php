<?php

namespace Team\Programme\DomainModel\Team;
interface ITeamRepository {
    /**
     * @param type $id
     * @return Team
     */
    function ofId($id);
    
    function update();
}
