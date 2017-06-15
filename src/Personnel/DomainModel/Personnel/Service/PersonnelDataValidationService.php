<?php

namespace Personnel\DomainModel\Personnel\Service;

use Resources\DataValidationServiceAbstract;
use Personnel\DomainModel\Personnel\DataObject\PersonnelWriteDataObject;

class PersonnelDataValidationService extends DataValidationServiceAbstract{
    function isValidToAdd(PersonnelWriteDataObject $request){
        $this->_checkNotEmtpyOrNull($request->getName(), 'personnel name');
        $this->_checkEmailFormat($request->getEmail(), 'personnel email');
        $this->_checkNotEmtpyOrNull($request->getPassword(), 'personnel password');
        return $this->_generateResponse();
    }
    
    function isValidToUpdate(PersonnelWriteDataObject $request){
        
    }
    
}
