<?php

namespace Talent\Profile\ApplicationService\Talent;

use Resources\QueryResponseObject;
use Superclass\DomainModel\Talent\TalentReadDataObject;

class TalentQueryResponseObject extends QueryResponseObject{
    /**
     * @return TalentReadDataObject[]
     */
    public function arrayOfReadDataObject() {
        return $this->_arrayOfReadDataObject();
    }

    /**
     * @return TalentReadDataObject
     */
    public function firstReadDataObject() {
        return $this->_firstReadDataObject();
    }
}
