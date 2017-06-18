<?php

namespace Team\Idea\DomainModel\Idea\Service;

use Resources\DataValidationServiceAbstract;
use Resources\ErrorMessage;
use Team\Idea\DomainModel\Idea\DataObject\IdeaWriteDataObject;

class IdeaDataValidationService extends DataValidationServiceAbstract{
    
    /**
     * @param IdeaWriteDataObject $request
     * @return true||ErrorMessage
     */
    function isValidToPropose(IdeaWriteDataObject $request){
        $this->_checkNotEmtpyOrNull($request->getName(), 'idea name');
        $this->_checkNotEmtpyOrNull($request->getDescription(), 'idea description');
        $this->_checkNotEmtpyOrNull($request->getTargetCustomer(), 'idea target customer');
        $this->_checkNotEmtpyOrNull($request->getProblemFaced(), 'idea problem faced');
        $this->_checkNotEmtpyOrNull($request->getValueProposed(), 'idea value proposed');
        $this->_checkNotEmtpyOrNull($request->getRevenueModel(), 'idea revenue model');
        return $this->_generateResponse();
    }
    
    /**
     * @param IdeaWriteDataObject $request
     * @return true||ErrorMessage
     */
    function isValidToUpdate(IdeaWriteDataObject $request){
        return $this->isValidToPropose($request);
    }
}
