<?php

namespace Talent\Entrepreneurship\DomainModel\Entrepreneurship\Service;

use Resources\DataValidationServiceAbstract;
use Talent\Entrepreneurship\DomainModel\Entrepreneurship\DataObject\EntrepreneurshipWriteDataObject;
use Resources\ErrorMessage;

class EntrepreneurshipDataValidationService extends DataValidationServiceAbstract{
    /**
     * @param EntrepreneurshipWriteDataObject $request
     * @return True||ErrorMessage
     */
    function isValidToAdd(EntrepreneurshipWriteDataObject $request){
        $this->_checkNotEmtpyOrNull($request->getName(), 'business name');
        $this->_checkNotEmtpyOrNull($request->getBusinessField(), 'business field');
        $this->_checkBusinessCategoryString($request->getBusinessCategory());
        $this->_checkNotEmtpyOrNull($request->getPosition(), 'position');
        $this->_checkYearFormat($request->getStartYear(), 'business start year');
        $endYear = $request->getEndYear();
        if(!empty($endYear)){
            $this->_checkYearFormat($request->getEndYear(), 'business end year');
        }
        return $this->_generateResponse();
    }
    
    /**
     * @param EntrepreneurshipWriteDataObject $request
     * @return True||ErrorMessage
     */
    function isValidToUpdate(EntrepreneurshipWriteDataObject $request){
        return $this->isValidToAdd($request);
    }
    
    function _checkBusinessCategoryString($businessCategory){
        $categoryList = array(
            'B2B',
            'B2C',
            'B2G',
            'C2C',
        );
        if(!in_array($businessCategory, $categoryList)){
            $this->_appendMessage("invalid business category: '$businessCategory'; business category must be of: 'B2B, B2C, B2G, C2C'");
        }
    }
}
