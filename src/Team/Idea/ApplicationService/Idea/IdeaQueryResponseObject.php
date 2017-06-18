<?php

namespace Team\Idea\ApplicationService\Idea;

use Resources\QueryResponseObject;
use Team\Idea\DomainModel\Idea\IdeaRdo;

class IdeaQueryResponseObject extends QueryResponseObject{
    
    /**
     * @return IdeaRdo[]
     */
    public function arrayOfReadDataObject() {
        return $this->_arrayOfReadDataObject();
    }

    /**
     * @return IdeaRdo
     */
    public function firstReadDataObject() {
        return $this->_firstReadDataObject();
    }

//put your code here
}
