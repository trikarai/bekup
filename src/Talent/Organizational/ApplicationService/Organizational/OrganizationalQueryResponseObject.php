<?php

namespace Talent\Organizational\ApplicationService\Organizational;

use Resources\QueryResponseObject;
use Talent\Organizational\DomainModel\Organizational\OrganizationalRdo;

class OrganizationalQueryResponseObject extends QueryResponseObject{
    /**
     * @return OrganizationalRdo[]
     */
    public function arrayOfReadDataObject() {
        return $this->_arrayOfReadDataObject();
    }

    /**
     * 
     * @return OrganizationalRdo
     */
    public function firstReadDataObject() {
        return $this->_firstReadDataObject();
    }

//put your code here
}
