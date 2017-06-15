<?php

namespace Talent\WorkingExperience\DomainModel\WorkingExperience\Service;

use Resources\DataValidationServiceAbstract;
use Resources\ErrorMessage;

use Talent\WorkingExperience\DomainModel\WorkingExperience\DataObject\WorkingExperienceWriteDataObject;

class WorkingExperienceDataValidationService extends DataValidationServiceAbstract{
    
    /**
     * @param WorkingExperienceWriteDataObject $request
     * @return true||ErrorMessage
     */
    function isValidToAdd(WorkingExperienceWriteDataObject $request){
        $this->_checkNotEmtpyOrNull($request->getCompanyName(), 'working experience company name');
        $this->_checkNotEmtpyOrNull($request->getPosition(), 'working experience position');
        $this->_checkNotEmtpyOrNull($request->getRole(), 'working experience role');
        $this->_checkYearFormat($request->getStartYear(), 'working experience start year');
        if(null !== $request->getEndYear()){
            $this->_checkYearFormat($request->getEndYear(), 'working experience end year');
        }
        return $this->_generateResponse();
    }
    
    /**
     * 
     * @param WorkingExperienceWriteDataObject $request
     * @return true||ErrorMessage
     */
    function isValidToUpdate(WorkingExperienceWriteDataObject $request){
        return $this->isValidToAdd($request);
    }
    
}
