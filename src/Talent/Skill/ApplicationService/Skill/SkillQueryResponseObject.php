<?php

namespace Talent\Skill\ApplicationService\Skill;

use Resources\QueryResponseObject;
use Talent\Skill\DomainModel\Skill\DataObject\SkillReadDataObject;

class SkillQueryResponseObject extends QueryResponseObject{
    /**
     * @return SkillReadDataObject[]
     */
    public function arrayOfReadDataObject() {
        return $this->_arrayOfReadDataObject();
    }

    /**
     * @return SkillReadDataObject
     */
    public function firstReadDataObject() {
        return $this->_firstReadDataObject();
    }
    
    function toArrayOfSkillList(){
        $skillList = [];
        foreach($this->arrayOfReadDataObject() as $rdo){
            $skillList[$rdo->getId()] = "{$rdo->trackReadDataObject()->getName()} - {$rdo->getName()}";
        }
        return $skillList;
    }
}
