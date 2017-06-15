<?php

namespace Talent\Skill\DomainModel\Skill\DataObject;

interface ISkillRdoRepository {
    /**
     * @param type $id
     * @return SkillReadDataObject
     */
    function ofId($id);
    
    /**
     * @return SkillReadDataObject[]
     */
    function all();
}
