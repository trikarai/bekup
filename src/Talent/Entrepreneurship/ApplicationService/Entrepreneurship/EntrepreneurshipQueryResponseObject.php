<?php

namespace Talent\Entrepreneurship\ApplicationService\Entrepreneurship;

use Talent\Entrepreneurship\DomainModel\Entrepreneurship\EntrepreneurshipRdo;
use Resources\QueryResponseObject;

class EntrepreneurshipQueryResponseObject extends QueryResponseObject{
    /**
     * @return EntrepreneurshipRdo[]
     */
    public function arrayOfReadDataObject() {
        return $this->_arrayOfReadDataObject();
    }

    /**
     * @return EntrepreneurshipRdo
     */
    public function firstReadDataObject() {
        return $this->_firstReadDataObject();
    }
}
