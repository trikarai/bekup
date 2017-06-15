<?php

namespace Talent\Education\DomainModel\Education\Service;

use Resources\DataValidationServiceAbstract;
use Talent\Education\DomainModel\Education\DataObject\EducationWriteDataObject;
use Resources\ErrorMessage;

class EducationDataValidationService extends DataValidationServiceAbstract{
    
    /**
     * @param EducationWriteDataObject $request
     * @return true||ErrorMessage
     */
    function isValidToAdd(EducationWriteDataObject $request){
        $this->_checkNotEmtpyOrNull($request->getPhase(), 'education phase');
        $this->_checkNotEmtpyOrNull($request->getInstitution(), 'education institution');
        $this->_checkYearFormat($request->getStartYear(), 'education start year');
        if(null !== $request->getEndYear()){
            $this->_checkYearFormat($request->getEndYear(), 'education end year');
        }
        return $this->_generateResponse();
    }
    
    /**
     * @param EducationWriteDataObject $request
     * @return true||ErrorMessage
     */
    function isValidToUpdate(EducationWriteDataObject $request){
        $this->_checkNotEmtpyOrNull($request->getInstitution(), 'education institution');
        $this->_checkYearFormat($request->getStartYear(), 'education start year');
        if(null !== $request->getEndYear()){
            $this->_checkYearFormat($request->getEndYear(), 'education end year');
        }
        return $this->_generateResponse();
    }
}
