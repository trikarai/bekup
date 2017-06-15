<?php

namespace Talent\Training\DomainModel\Training\Service;

use Resources\ErrorMessage;
use Resources\DataValidationServiceAbstract;
use Talent\Training\DomainModel\Training\DataObject\TrainingWriteDataObject;

class TrainingDataValidationService extends DataValidationServiceAbstract{
    
    /**
     * @param TrainingWriteDataObject $request
     * @return true||ErrorMessage
     */
    function isValidToAdd(TrainingWriteDataObject $request){
        $this->_checkNotEmtpyOrNull($request->getName(), 'training name');
        $this->_checkNotEmtpyOrNull($request->getOrganizer(), 'training organizer');
//        $this->_checkTrainingYearFormatAndItIsLessThanCurrentYear($request->getYear());
        $this->_checkYearFormat($request->getYear(), 'training year');
        return $this->_generateResponse();
    }
    
    /**
     * @param TrainingWriteDataObject $request
     * @return true||ErrorMessage
     */
    function isValidToUpdate(TrainingWriteDataObject $request){
        return $this->isValidToAdd($request);
    }
    
    protected function _checkTrainingYearFormatAndItIsLessThanCurrentYear($year){
        $yearRegex = "/^\d{4}$/";
        $filteredYear = filter_var($year, FILTER_VALIDATE_REGEXP, array('options'=>(array('regexp'=>$yearRegex))));
        if(empty($filteredYear)){
            $this->_appendMessage("argument: '$year' is invalid - 'start year' must be a Year format");
        }else{
            if($filteredYear > date('Y')){
                $this->_appendMessage("training year must be less than current year");
            }
        }
    }
    
}
