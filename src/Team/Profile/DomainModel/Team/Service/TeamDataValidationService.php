<?php

namespace Team\Profile\DomainModel\Team\Service;

use Team\Profile\DomainModel\Team\DataObject\TeamWriteDataObject;
use Resources\ErrorMessage;
use Resources\DataValidationServiceAbstract;

class TeamDataValidationService extends DataValidationServiceAbstract{
    
    /**
     * @param TeamWriteDataObject $request
     * @return true||ErrorMessage
     */
    function isValidToCreate(TeamWriteDataObject $request){
        $this->_checkNotEmtpyOrNull($request->getName(), 'team name');
        $this->_checkNotEmtpyOrNull($request->getVision(), 'team vision');
        $this->_checkNotEmtpyOrNull($request->getMission(), 'team mission');
        $this->_checkNotEmtpyOrNull($request->getCulture(), 'team culture');
//        $this->_checkNotEmtpyOrNull($request->getFounderAgreement(), 'team founder agreement');
        return $this->_generateResponse();
    }
    
    /**
     * @param TeamWriteDataObject $request
     * @return true||ErrorMessage
     */
    function isValidToUpdate(TeamWriteDataObject $request){
        return $this->isValidToCreate($request);
    }
    
}
