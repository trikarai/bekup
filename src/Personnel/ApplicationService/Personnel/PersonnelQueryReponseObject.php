<?php

namespace Personnel\ApplicationService\Personnel;

use Resources\QueryResponseObject;
use Personnel\DomainModel\Personnel\DataObject\PersonnelReadDataObject;

class PersonnelQueryReponseObject extends QueryResponseObject{
    /**
     * @return PersonnelReadDataObject[]
     */
    public function arrayOfReadDataObject() {
        return $this->_arrayOfReadDataObject();
    }

    /**
     * @return PersonnelReadDataObject
     */
    public function firstReadDataObject() {
        return $this->_firstReadDataObject();
    }

}
