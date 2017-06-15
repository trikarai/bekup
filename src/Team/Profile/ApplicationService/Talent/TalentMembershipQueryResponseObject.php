<?php

namespace Team\Profile\ApplicationService\Talent;

use Team\Profile\DomainModel\Membership\DataObject\TalentMembershipReadDataObject;
use Resources\QueryResponseObject;

class TalentMembershipQueryResponseObject extends QueryResponseObject {
    /**
     * @return TalentMembershipReadDataObject[]
     */
    public function arrayOfReadDataObject() {
        return $this->_arrayOfReadDataObject();
    }

    /**
     * @return TalentMembershipReadDataObject
     */
    public function firstReadDataObject() {
        return $this->_firstReadDataObject();
    }
}
