<?php

namespace Team\Idea\ApplicationService\Idea;

use Resources\QueryResponseObject;
use Team\Idea\DomainModel\Idea\DataObject\IdeaReadDataObject;

class IdeaQueryResponseObject extends QueryResponseObject{
    
    /**
     * @return IdeaReadDataObject[]
     */
    public function arrayOfReadDataObject() {
        return $this->_arrayOfReadDataObject();
    }

    /**
     * @return IdeaReadDataObject
     */
    public function firstReadDataObject() {
        return $this->_firstReadDataObject();
    }

//put your code here
}
