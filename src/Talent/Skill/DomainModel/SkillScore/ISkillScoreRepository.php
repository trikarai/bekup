<?php

namespace Talent\Skill\DomainModel\SkillScore;

interface ISkillScoreRepository {
    
    /**
     * @param type $id
     * @param type $talentId
     * @return SkillScore
     */
    function ofId($id, $talentId);
    
    function update();
}
