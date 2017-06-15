<?php

namespace Track\Definition\ApplicationService\Track;

use Superclass\DomainModel\Track\TrackReadDataObject;
use Resources\QueryResponseObject;

class TrackQueryResponseObject extends QueryResponseObject{
    /**
     * @return TrackReadDataObject[]
     */
    public function arrayOfReadDataObject() {
        return $this->_arrayOfReadDataObject();
    }

    /**
     * @return TrackReadDataObject
     */
    public function firstReadDataObject() {
        return $this->_firstReadDataObject();
    }
    
    function toArrayOfIdNameList(){
        $trackList = [];
        foreach($this->arrayOfReadDataObject() as $rdo){
            $trackList[$rdo->getId()] = $rdo->getName();
        }
        return $trackList;
    }
}
