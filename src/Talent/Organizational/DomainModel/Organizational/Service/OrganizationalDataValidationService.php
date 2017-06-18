<?php

namespace Talent\Organizational\DomainModel\Organizational\Service;

use Resources\DataValidationServiceAbstract;
use Talent\Organizational\DomainModel\Organizational\DataObject\OrganizationalWriteDataObject;
use Resources\ErrorMessage;

class OrganizationalDataValidationService extends DataValidationServiceAbstract{
    /**
     * @param OrganizationalWriteDataObject $request
     * @return true||ErrorMessage
     */
    function isValidToAdd(OrganizationalWriteDataObject $request){
        $this->_checkNotEmtpyOrNull($request->getName(), 'organization name');
        $this->_checkNotEmtpyOrNull($request->getPosition(), 'organization position');
        $this->_checkYearFormat($request->getStartYear(), 'organization start year');
        $endYear = $request->getEndYear();
        if(!empty($endYear)){
            $this->_checkYearFormat($request->getEndYear(), 'organization end year');
        }
        return $this->_generateResponse();
    }
    
    /**
     * @param OrganizationalWriteDataObject $request
     * @return true||ErrorMessage
     */
    function isValidToUpdate(OrganizationalWriteDataObject $request){
        return $this->isValidToAdd($request);
    }
}
