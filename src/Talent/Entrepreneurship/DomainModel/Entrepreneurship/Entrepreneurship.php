<?php

namespace Talent\Entrepreneurship\DomainModel\Entrepreneurship;

use Talent\Entrepreneurship\DomainModel\Entrepreneurship\ValueObject\EntrepreneurshipTime;
use Talent\Entrepreneurship\DomainModel\Entrepreneurship\DataObject\EntrepreneurshipWriteDataObject;
use Talent\Entrepreneurship\DomainModel\Talent\Talent;
use Resources\ErrorMessage;

class Entrepreneurship {
    protected $id;
    protected $name;
    protected $businessField;
    protected $businessCategory;
    protected $position;
    protected $isRemoved = false;
    /**
     * @var EntrepreneurshipTime
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
     * @param EntrepreneurshipWriteDataObject $request
     * @param Talent $talent
     * @throw \Resources\Exception\CatchableException
     */
    public function __construct($id, EntrepreneurshipWriteDataObject $request, Talent $talent) {
        $this->id = $id;
        $this->name = $request->getName();
        $this->businessField = $request->getBusinessField();
        $this->businessCategory = $request->getBusinessCategory();
        $this->position = $request->getPosition();
        $this->time = EntrepreneurshipTime::fromNative($request->getStartYear(), $request->getEndYear());
        $this->talent = $talent;
    }
    
    /**
     * @param EntrepreneurshipWriteDataObject $request
     * @return True||ErrorMessage
     */
    function change(EntrepreneurshipWriteDataObject $request){
        try {
            $this->name = $request->getName();
            $this->businessField = $request->getBusinessField();
            $this->businessCategory = $request->getBusinessCategory();
            $this->position = $request->getPosition();
            $this->time = EntrepreneurshipTime::fromNative($request->getStartYear(), $request->getEndYear());
        } catch (\Resources\Exception\CatchableException $ex) {
            return ErrorMessage::error400_BadRequest([$ex->getMessage()]);
        }
        return true;
    }
    
    function remove(){
        $this->isRemoved = true;
    }

}
