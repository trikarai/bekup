<?php

namespace Talent\Skill\DomainModel\SkillScore\Service;

use Resources\DataValidationServiceAbstract;
use Resources\ErrorMessage;

class SkillScoreDataValidationService extends DataValidationServiceAbstract{
    /**
     * @param type $scoreValue
     * @return true||ErrorMessage
     */
    function isValidToAdd($scoreValue){
        $this->_checkScoreValueBetween1To5($scoreValue);
//        $this->_checkNotEmtpyOrNull($scoreValue, "skill score value");
        return $this->_generateResponse();
    }
    
    /**
     * @param type $scoreValue
     * @return true||ErrorMessage
     */
    function isValidToUpdate($scoreValue){
        return $this->isValidToAdd($scoreValue);
    }
    
    protected function _checkScoreValueBetween1To5($scoreValue){
        $scoreRegex = "/^[1-5]$/";
        $filteredScore = filter_var($scoreValue, FILTER_VALIDATE_REGEXP, array("options" => array('regexp' => $scoreRegex)));
        if(empty($filteredScore)){
            $this->status = false;
            $this->errorMessageHolder[] = "invalid 'skill score value': '$scoreValue' must be between 1 - 5";
        }
    }
}
