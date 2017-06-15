<?php

namespace Team\Profile\ApplicationService\Team;

use Superclass\DomainModel\Team\TeamMemberReadDataObject;
use Resources\QueryResponseObject;

class TeamMemberQueryResponseObject extends QueryResponseObject{
    /**
     * @return TeamMemberReadDataObject[]
     */
    public function arrayOfReadDataObject() {
        return $this->_arrayOfReadDataObject();
    }

    /**
     * @return TeamMemberReadDataObject
     */
    public function firstReadDataObject() {
        return $this->_firstReadDataObject();
    }
}
