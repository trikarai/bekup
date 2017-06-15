<?php

namespace Team\Programme\ApplicationService\Programme;

use Resources\QueryResponseObject;
use Team\Programme\DomainModel\Programme\ProgrammeRdo;

class ProgrammeQueryResponseObject extends QueryResponseObject {
    /**
     * @return ProgrammeRdo
     */
    public function arrayOfReadDataObject() {
        return $this->_arrayOfReadDataObject();
    }

    /**
     * @return ProgrammeRdo[]
     */
    public function firstReadDataObject() {
        return $this->_firstReadDataObject();
    }

//put your code here
}
