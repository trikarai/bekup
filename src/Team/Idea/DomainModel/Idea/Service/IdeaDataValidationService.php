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
        $this->_checkNotEmtpyOrNull($request->getLocalProblem(), 'idea local problem');
        $this->_checkNotEmtpyOrNull($request->getGlobalTrendRelation(), 'idea global trend relation');
        $this->_checkNotEmtpyOrNull($request->getAppliedTechnology(), 'idea applied technology');
        $this->_checkNotEmtpyOrNull($request->getIdealFinalResult(), 'idea ideal final result');
        $this->_checkNotEmtpyOrNull($request->getValueContradiction(), 'idea value contradiction');
        $this->_checkNotEmtpyOrNull($request->getUsedResource(), 'idea used resources');
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
