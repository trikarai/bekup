<?php

namespace Talent\Skill\ApplicationService\Certificate;

use Resources\QueryResponseObject;
use Talent\Skill\DomainModel\Certificate\DataObject\CertificateReadDataObject;

class CertificateResponseObject extends QueryResponseObject{
    /**
     * @return CertificateReadDataObject[]
     */
    public function arrayOfReadDataObject() {
        return $this->_arrayOfReadDataObject();
    }

    /**
     * @return CertificateReadDataObject
     */
    public function firstReadDataObject() {
        return $this->_firstReadDataObject();
    }
}
