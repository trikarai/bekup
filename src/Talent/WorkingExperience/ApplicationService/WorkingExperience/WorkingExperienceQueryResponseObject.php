<?php

namespace Talent\WorkingExperience\ApplicationService\WorkingExperience;

use Resources\QueryResponseObject;
use Talent\WorkingExperience\DomainModel\WorkingExperience\DataObject\WorkingExperienceReadDataObject;

class WorkingExperienceQueryResponseObject extends QueryResponseObject{
    /**
     * @return WorkingExperienceReadDataObject[]
     */
    public function arrayOfReadDataObject() {
        return $this->_arrayOfReadDataObject();
    }

    /**
     * @return WorkingExperienceReadDataObject
     */
    public function firstReadDataObject() {
        return $this->_firstReadDataObject();
    }
}
