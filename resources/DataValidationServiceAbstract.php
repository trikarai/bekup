<?php

namespace Resources;

abstract class DataValidationServiceAbstract {
    protected $status = true;
    protected $errorMessageHolder = [];
    
    protected function _setStatusFalse(){
        $this->status = false;
    }
    protected function _appendMessage($message){
        $this->status = false;
        $this->errorMessageHolder[] = $message;
    }
    
    /**
     * @return true||ErrorMessage
     */
    protected function _generateResponse(){
        if(true === $this->status){
            return true;
        }
        return ErrorMessage::error400_BadRequest($this->errorMessageHolder);
    }
    
    /**
     * @param type $argument
     * @param type $label
     * @return true||string
     */
    protected function _checkNotEmtpyOrNull($argument, $label){
        if(empty($argument)){
            $this->status = false;
            $this->errorMessageHolder[] = "argument: '$argument' is invalid - '$label' must be not empty string";
        }
    }
    /**
     * @param type $argument
     * @param type $label
     * @return true||string
     */
    protected function _checkEmailFormat($argument, $label){
        if(!filter_var($argument, FILTER_VALIDATE_EMAIL)){
            $this->status = false;
            $this->errorMessageHolder[] = "argument: '$argument' is invalid - '$label' must be valid email address";
        }
    }
    /**
     * @param type $argument
     * @param type $label
     * @return true||string
     */
    protected function _checkDateFormatIs_YYYY_MM_DD($argument, $label){
        $dateRegex = "/^(19|20)\d{2}[-](0[1-9]|1[012])[-](0[1-9]|[12][0-9]|3[01])$/";//yyyy-mm-dd date format
        $filteredDate = filter_var($argument, FILTER_VALIDATE_REGEXP, array("options" => array("regexp"=>$dateRegex)));//validate correct date
        
        if(empty($filteredDate)){
            $this->status = false;
            $this->errorMessageHolder[] = "argument: '$argument' is invalid - '$label' must be a YYYY-MM-DD date format";
        }
    }
    /**
     * @param type $argument
     * @param type $label
     * @return true||string
     */
    protected function _checkYearFormat($argument, $label){
        $yearRegex = "/^\d{4}$/";
        $filteredYear = filter_var($argument, FILTER_VALIDATE_REGEXP, array('options'=>(array('regexp'=>$yearRegex))));
        if(empty($filteredYear)){
            $this->status = false;
            $this->errorMessageHolder[] = "argument: '$argument' is invalid - '$label' must be a Year format";
        }
    }
}
