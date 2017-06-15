<?php

namespace City\Profile\DomainModel\City\Service;

use Resources\MessageObject;
use Resources\ValidationService;

class CityValidationService extends ValidationService{
    
    /**
     * @param string $name
     * @param MessageObject $messageObject
     * @return boolean
     */
    function isValidToAdd($name, MessageObject $messageObject){
        $this->_checkNotEmtpyOrNull($name, "city name", $messageObject);
        return $messageObject->getStatus();
    }
    
    /**
     * @param string $name
     * @param MessageObject $messageObject
     * @return boolean
     */
    function isValidToUpdate($name, MessageObject $messageObject){
        return $this->isValidToAdd($name, $messageObject);
    }
    
}
