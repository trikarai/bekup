<?php

namespace Talent\Skill\DomainModel\Skill\Service;

use Resources\DataValidationServiceAbstract;

class SkillDataValidationService extends DataValidationServiceAbstract{
    /**
     * @param type $name
     * @return true||ErrorMessage
     */
    function isValidToAdd($name){
        $this->_checkNotEmtpyOrNull($name, 'skill name');
        return $this->_generateResponse();
    }
    
    /**
     * @param type $name
     * @return True||ErrorMessage
     */
    function isValidToUpdate($name){
        return $this->isValidToAdd($name);
    }
}
