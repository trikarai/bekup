<?php

namespace Talent\Skill\ApplicationService\SkillScore;

use Resources\QueryResponseObject;
use Talent\Skill\DomainModel\SkillScore\DataObject\SkillScoreReadDataObject;

class SkillScoreResponseObject extends QueryResponseObject{
    /**
     * @return SkillScoreReadDataObject[]
     */
    public function arrayOfReadDataObject() {
        return $this->_arrayOfReadDataObject();
    }

    /**
     * @return SkillScoreReadDataObject
     */
    public function firstReadDataObject() {
        return $this->_firstReadDataObject();
    }
}
