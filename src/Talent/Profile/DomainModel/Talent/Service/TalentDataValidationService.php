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
        $this->_checkGenderString($request->getGender());
        $this->_checkBekupTypeString($request->getBekupType());
        $this->_checkNotEmtpyOrNull($request->getMotivation(), 'talent motivation');
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
        $this->_checkGenderString($request->getGender());
        $this->_checkBekupTypeString($request->getBekupType());
        $this->_checkNotEmtpyOrNull($request->getMotivation(), 'talent motivation');
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
    protected function _checkGenderString($gender){
        $genderList = ["L", "M"];
        if(!in_array($gender, $genderList)){
            $this->_appendMessage("invalid gender");
        }
    }
    protected function _checkBekupTypeString($bekupType){
        $bekupTypeList = ['start', 'basic', 'journey'];
        if(!in_array($bekupType, $bekupTypeList)){
            $this->_appendMessage("invalid bekup Type");
        }
    }
}
