<?php

namespace Talent\Training\ApplicationService\Training;

use Resources\QueryResponseObject;
use Talent\Training\DomainModel\Training\DataObject\TrainingReadDataObject;

class TrainingQueryResponseObject extends QueryResponseObject{
    /**
     * @return TrainingReadDataObject[]
     */
    public function arrayOfReadDataObject() {
        return $this->_arrayOfReadDataObject();
    }

    /**
     * @return TrainingReadDataObject
     */
    public function firstReadDataObject() {
        return $this->_firstReadDataObject();
    }
}
