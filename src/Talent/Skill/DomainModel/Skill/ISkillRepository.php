<?php

namespace Talent\Skill\DomainModel\Skill;

interface ISkillRepository {
    function nextIdentity();
    
    /**
     * @param \Talent\Skill\DomainModel\Skill\Skill $skill
     */
    function add(Skill $skill);
    
    function update();
    
    /**
     * @param type $id
     * @return \Talent\Skill\DomainModel\Skill\Skill
     */
    function ofId($id);
    
    /**
     * @param type $name
     * @return \Talent\Skill\DomainModel\Skill\Skill
     */
    function ofName($name);
    
    /**
     * @return \Talent\Skill\DomainModel\Skill\Skill[]
     */
    function all();
    
}
