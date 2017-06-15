<?php

namespace Team\Profile\DomainModel\Team;

use Team\Profile\DomainModel\Team\Team;

interface ITeamRepository {
    function nextIdentity();
    
    function update();
    
    /**
     * @return Team
     */
    function ofId($id);
    /**
     * @return Team
     */
//    function ofTalentId($talentId);
    /**
     * @param type $name
     * @param type $cityId
     * @return Team
     */
    function ofNameWithinCityId($name, $cityId);
    /**
     * @param type $cityId
     * @return Team[]
     */
    function allWithinCityId($cityId);
    /**
     * @return Team[]
     */
    function all();
}
