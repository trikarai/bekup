<?php

namespace City\Profile\DomainModel\City\Service;

use Resources\DataValidationServiceAbstract;
use Resources\ErrorMessage;

class CityDataValidationService extends DataValidationServiceAbstract{
    /**
     * @param type $name
     * @return true||ErrorMessage
     */
    function isValidToAdd($name){
        $this->_checkNotEmtpyOrNull($name, 'city name');
        return $this->_generateResponse();
    }
    
    /**
     * @param type $name
     * @return true||ErrorMessage
     */
    function isValidToUpdate($name){
        return $this->isValidToAdd($name);
    }
    
}
