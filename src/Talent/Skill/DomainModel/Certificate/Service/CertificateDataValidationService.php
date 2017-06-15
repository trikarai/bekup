<?php

namespace Talent\Skill\DomainModel\Certificate\Service;

use Resources\DataValidationServiceAbstract;
use Talent\Skill\DomainModel\Certificate\DataObject\CertificateWriteDataObject;

class CertificateDataValidationService extends DataValidationServiceAbstract{
    function isValidToAdd(CertificateWriteDataObject $request){
        $this->_checkNotEmtpyOrNull($request->getName(), 'certificate name');
        $this->_checkNotEmtpyOrNull($request->getOrganizer(), 'certificate organizer');
        if(null !== $request->getValidUntil()){
            $this->_checkYearFormat($request->getValidUntil(), 'certificate valid until');
        }
        return $this->_generateResponse();
    }
    
    function isValidToUpdate(CertificateWriteDataObject $request){
        return $this->isValidToAdd($request);
    }
}
