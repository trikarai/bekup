<?php

namespace Talent\Organizational\DomainModel\Organizational;

use Talent\Organizational\DomainModel\Talent\Talent;
use Talent\Organizational\DomainModel\Organizational\ValueObject\OrganizationalTime;
use Talent\Organizational\DomainModel\Organizational\DataObject\OrganizationalWriteDataObject;
use Resources\Exception\CatchableException;
use Resources\ErrorMessage;

class Organizational {
    protected $id;
    protected $name;
    protected $position;
    protected $isRemoved;
    /**
     * @var OrganizationalTime
     */
    protected $time;
    /**
     * @var Talent
     */
    protected $talent;
    
    function getId() {
        return $this->id;
    }
    function getIsRemoved() {
        return $this->isRemoved;
    }
    
    /**
     * @param type $id
     * @param OrganizationalWriteDataObject $request
     * @param Talent $talent
     * @throw CatchableException
     */
    function __construct($id, OrganizationalWriteDataObject $request, Talent $talent) {
        $this->id = $id;
        $this->name = $request->getName();
        $this->position = $request->getPosition();
        $this->time = OrganizationalTime::fromNative($request->getStartYear(), $request->getEndYear());
        $this->isRemoved = false;
        $this->talent = $talent;
    }
    
    /**
     * @param OrganizationalWriteDataObject $request
     * @return true||ErrorMessage
     */
    function change(OrganizationalWriteDataObject $request){
        try{
            $this->name = $request->getName();
            $this->position = $request->getPosition();
            $this->time = OrganizationalTime::fromNative($request->getStartYear(), $request->getEndYear());
        }  catch (CatchableException $ex){
            return ErrorMessage::error400_BadRequest([$ex->getMessage()]);
        }
        return true;
    }
    
    function remove(){
        $this->isRemoved = true;
    }
}
