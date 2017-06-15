<?php

namespace Talent\Training\DomainModel\Training;

use Talent\Training\DomainModel\Training\DataObject\TrainingWriteDataObject;
use Talent\Training\DomainModel\Training\ValueObject\TrainingTime;
use Resources\Exception\CatchableException;
use Resources\ErrorMessage;

use Talent\Training\DomainModel\Talent\Talent;

class Training {
    protected $id;
    protected $name;
    protected $organizer;
    protected $time;
    protected $isRemoved = false;
    protected $talent;
    
    function getId(){
        return $this->id;
    }
    function getIsRemoved(){
        return $this->isRemoved;
    }
    
    /**
     * @return \Talent\Training\DomainModel\Training\DataObject\TrainingReadDataObject
     */
    function toReadDataObject(){
        return new DataObject\TrainingReadDataObject($this->id, $this->name, $this->organizer, $this->time->getTime());
    }
    /**
     * @param type $id
     * @param TrainingWriteDataObject $request
     * @param Talent $talent
     * @throw CatchableException
     */
    public function __construct($id, TrainingWriteDataObject $request, Talent $talent) {
        $this->id = $id;
        
        $this->name = $request->getName();
        $this->organizer = $request->getOrganizer();
        $this->time = TrainingTime::fromNative($request->getYear());
        $this->talent = $talent;
    }
    
    /**
     * @param TrainingWriteDataObject $request
     * @return true||ErrorMessage
     */
    function change(TrainingWriteDataObject $request){
        $this->name = $request->getName();
        $this->organizer = $request->getOrganizer();
        $this->time  = $request->getYear();
        try{
            $this->time  = TrainingTime::fromNative($request->getYear());
            return true;
        } catch(CatchableException $ex){
            return ErrorMessage::error400_BadRequest([$ex->getMessage()]);
        }
    }
    
    function remove(){
        $this->isRemoved = true;
    }
}
