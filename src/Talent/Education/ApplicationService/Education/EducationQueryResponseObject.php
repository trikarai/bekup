<?php

namespace Talent\Education\ApplicationService\Education;

use Resources\QueryResponseObject;
use Talent\Education\DomainModel\Education\DataObject\EducationReadDataObject;

class EducationQueryResponseObject extends QueryResponseObject{
    /**
     * @return EducationReadDataObject[]
     */
    public function arrayOfReadDataObject() {
        return $this->_arrayOfReadDataObject();
    }

    /**
     * @return EducationReadDataObject
     */
    public function firstReadDataObject() {
        return $this->_firstReadDataObject();
    }
}
