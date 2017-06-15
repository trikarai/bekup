<?php

namespace City\Profile\ApplicationService\City;

use Resources\QueryResponseObject;
use Superclass\DomainModel\City\CityReadDataObject;

class CityQueryResponseObject extends QueryResponseObject{
    /**
     * 
     * @return CityReadDataObject[]
     */
    public function arrayOfReadDataObject() {
        return $this->_arrayOfReadDataObject();
    }

    /**
     * 
     * @return CityReadDataObject
     */
    public function firstReadDataObject() {
        return $this->_firstReadDataObject();
    }
    
    function toArrayOfIdNameList(){
        $cityList = [];
        foreach($this->arrayOfReadDataObject() as $rdo){
            $cityList[$rdo->getId()] = $rdo->getName();
        }
        return $cityList;
    }
}
