<?php

namespace City\Programme\Description\ApplicationService\Programme;

use City\Programme\Description\DomainModel\Programme\ProgrammeRdo;
use Resources\QueryResponseObject;

class ProgrammeQueryResponseObject extends QueryResponseObject{
    /**
     * @return ProgrammeRdo[]
     */
    public function arrayOfReadDataObject() {
        return $this->_arrayOfReadDataObject();
    }

    /**
     * @return ProgrammeRdo
     */
    public function firstReadDataObject() {
        return $this->_firstReadDataObject();
    }

//put your code here
}
