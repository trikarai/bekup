<?php

namespace Team\Idea\DomainModel\Superhero\Service;

use Team\Idea\DomainModel\Superhero\DataObject\SuperheroWriteDataObject;
use Resources\DataValidationServiceAbstract;

class SuperheroDataValidationService extends DataValidationServiceAbstract {
    
    /**
     * @param SuperheroWriteDataObject $request
     * @return true||ErrorMEssage
     */
    function isValidToAdd(SuperheroWriteDataObject $request){
        $this->_checkNotEmtpyOrNull($request->getName(), "superhero name");
        $this->_checkNotEmtpyOrNull($request->getMainDuty(), "superhero main duty");
        $this->_checkNotEmtpyOrNull($request->getSpecialAbility(), "superhero special ability");
        $this->_checkNotEmtpyOrNull($request->getDailyActivity(), "superhero dailyActivity");
        $this->_checkNotEmtpyOrNull($request->getAlternativeTechnology(), "superhero alternative technology");
        return $this->_generateResponse();
    }
    
    /**
     * 
     * @param SuperheroWriteDataObject $request
     * @return true||ErrorMessage
     */
    function isValidToUpdate(SuperheroWriteDataObject $request){
        return $this->isValidToAdd($request);
    }
}
