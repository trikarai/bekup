<?php

namespace Programme\Description\ApplicationService\Programme;

use Resources\QueryResponseObject;
use Programme\Description\DomainModel\Programme\DataObject\ProgrammeReadDataObject;

class ProgrammeQueryResponseObject extends QueryResponseObject{
    /**
     * @return ProgrammeReadDataObject[]
     */
    public function arrayOfReadDataObject() {
        return $this->_arrayOfReadDataObject();
    }

    /**
     * @return ProgrammeReadDataObject
     */
    public function firstReadDataObject() {
        return $this->_firstReadDataObject();
    }
}
