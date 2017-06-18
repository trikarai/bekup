<?php

namespace Programme\Description\DomainModel\Programme\Service;

use Resources\DataValidationServiceAbstract;
use Programme\Description\DomainModel\Programme\DataObject\ProgrammeWriteDataObject;
use Resources\ErrorMessage;

class ProgrammeDataValidationService extends DataValidationServiceAbstract{
    function isValidToAdd(ProgrammeWriteDataObject $request){
        $this->_checkNotEmtpyOrNull($request->getName(), 'programme name');
        $this->_checkNotEmtpyOrNull($request->getDescription(), 'programme description');
        $this->_checkDateFormatIs_YYYY_MM_DD($request->getRegistrationStartDate(), 'programme registration start date');
        $this->_checkDateFormatIs_YYYY_MM_DD($request->getRegistrationEndDate(), 'programme registration end date');
        $this->_checkDateFormatIs_YYYY_MM_DD($request->getOperationStartDate(), 'programme operation start date');
        $this->_checkDateFormatIs_YYYY_MM_DD($request->getOperationEndDate(), 'programme operation end date');
        return $this->_generateResponse();
    }
    
    function isValidToUpdate(ProgrammeWriteDataObject $request){
        return $this->isValidToAdd($request);
    }
    
}
