<?php

namespace Team\Idea\ApplicationService\Superhero;

use Resources\QueryResponseObject;
use Team\Idea\DomainModel\Superhero\DataObject\SuperheroReadDataObject;

class SuperheroQueryResponseObject extends QueryResponseObject{
    /**
     * @return SuperheroReadDataObject[]
     */
    public function arrayOfReadDataObject() {
        return $this->_arrayOfReadDataObject();
    }

    /**
     * @return SuperheroReadDataObject
     */
    public function firstReadDataObject() {
        return $this->_firstReadDataObject();
    }
}
