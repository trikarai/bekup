<?php

namespace Track\Definition\DomainModel\Track;

use Superclass\DomainModel\Track\TrackAbstract;
use Track\Definition\DomainModel\Track\DataObject\TrackWriteDataObject;

class Track extends TrackAbstract{
    
    public function __construct($id, TrackWriteDataObject $request) {
        $this->id = $id;
        $this->name = $request->getName();
        $this->description = $request->getDescription();
    }
    
    function update(TrackWriteDataObject $request){
        $this->name = $request->getName();
        $this->description = $request->getDescription();
    }
    
    function remove(){
        $this->isRemoved = true;
    }
}
