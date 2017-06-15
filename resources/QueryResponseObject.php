<?php

namespace Resources;

abstract class QueryResponseObject extends ResponseObject{
    protected $readDataObject = [];
    
    function setReadDataObject(IReadDataObject $aReadDataObject){
        $this->readDataObject[] = $aReadDataObject;
    }
    /**
     * @param array $bulkOfReadDataObject
     */
    function setBulkReadDataObject(array $bulkOfReadDataObject){
        $this->readDataObject = $bulkOfReadDataObject;
    }
    
    /**
     * @return IReadDataObject[];
     */
    abstract function arrayOfReadDataObject();
    protected function _arrayOfReadDataObject(){
        return $this->readDataObject;
    }

    /**
     * @return IReadDataObject
     */
    abstract function firstReadDataObject();
    protected function _firstReadDataObject(){
        if(isset($this->readDataObject[0])){
            return $this->readDataObject[0];
        }
        return null;
    }
}
