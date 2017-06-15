<?php

namespace Talent\Profile\DomainModel\Talent\Service;

use Resources\DataValidationServiceAbstract;
use Resources\ErrorMessage;
use Talent\Profile\DomainModel\Talent\DataObject\TalentWriteDataObject;

class TalentDataValidationService extends DataValidationServiceAbstract{
    
    /**
     * @param TalentWriteDataObject $request
     * @return true||ErrorMessage
     */
    function isValidToSignUp(TalentWriteDataObject $request){
        $this->_checkNotEmtpyOrNull($request->getName(), 'talent name');
        $this->_checkNotEmtpyOrNull($request->getUserName(), 'talent user name');
        $this->_checkEmailFormat($request->getEmail(), 'talent email');
        $this->_checkNotEmtpyOrNull($request->getPassword(), 'talent password');
        $this->_checkNotEmtpyOrNull($request->getPhone(), 'talent phone number');
        $this->_checkNotEmtpyOrNull($request->getCityOfOrigin(), 'talent city of origin');
        $this->_checkTalentAgeOver17($request->getBirthDate());
        return $this->_generateResponse();
    }
    
    /**
     * @param TalentWriteDataObject $request
     * @return true||ErrorMessage
     */
    function isValidToUpdate(TalentWriteDataObject $request){
        $this->_checkNotEmtpyOrNull($request->getName(), 'talent name');
        $this->_checkEmailFormat($request->getEmail(), 'talent email');
        $this->_checkNotEmtpyOrNull($request->getPhone(), 'talent phone number');
        $this->_checkNotEmtpyOrNull($request->getCityOfOrigin(), 'talent city of origin');
        $this->_checkTalentAgeOver17($request->getBirthDate());
        return $this->_generateResponse();
    }
    
    protected function _checkTalentAgeOver17($birthDate){
        try{
            $birthDateTime = new \DateTime($birthDate);
            if(17 > $birthDateTime->diff(new \DateTime('now'))->format('%y')){
                $this->_appendMessage("Applicant must be older than 17");
            }
        } catch(\Exception $e){
            $this->_appendMessage("Argument: '$birthDate' is invalid - 'talent birth date' musta be a date format");
        }
    }
}
