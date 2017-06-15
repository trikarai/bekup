<?php

namespace Track\Definition\DomainModel\Track\Service;

use Resources\DataValidationServiceAbstract;
use Track\Definition\DomainModel\Track\DataObject\TrackWriteDataObject;
use Resources\ErrorMessage;

class TrackDataValidationService extends DataValidationServiceAbstract{
    /**
     * @param TrackWriteDataObject $request
     * @return true||ErrorMessage
     */
    function isValidToAdd(TrackWriteDataObject $request){
        $this->_checkNotEmtpyOrNull($request->getName(), 'track name');
        $this->_checkNotEmtpyOrNull($request->getDescription(), 'track name');
        return $this->_generateResponse();
    }
    
    /**
     * @param TrackWriteDataObject $request
     * @return true||ErrorMessage
     */
    function isValidToUpdate(TrackWriteDataObject $request){
        return $this->isValidToAdd($request);
    }
    
}
