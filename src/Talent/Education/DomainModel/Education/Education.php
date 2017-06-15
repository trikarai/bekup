<?php

namespace Talent\Education\DomainModel\Education;

use Resources\ErrorMessage;
use Talent\Education\DomainModel\Talent\Talent;
use Talent\Education\DomainModel\Education\ValueObject\EducationTime;
use Talent\Education\DomainModel\Education\DataObject\EducationWriteDataObject;
use Talent\Education\DomainModel\Education\DataObject\EducationReadDataObject;

class Education {
    protected $id;
    protected $phase;
    protected $institution;
    protected $major;
    protected $time;
    protected $note;
    protected $isRemoved = false;
    
    protected $talent;
    
    function getId(){
        return $this->id;
    }
    function getIsRemoved(){
        return $this->isRemoved;
    }
    
    /**
     * @return EducationReadDataObject
     */
    function toReadDataObject(){
        return new EducationReadDataObject($this->id, $this->phase, $this->institution, 
                $this->major, $this->time->getStartYear(), $this->time->getEndYear(),$this->note);
    }
    
//CONSTRUCTOR
    /**
     * @param type $id
     * @param EducationWriteDataObject $request
     * @throw CatchableException
     */
    public function __construct($id, EducationWriteDataObject $request, Talent $talent) {
        $this->id = $id;
        $this->phase = $request->getPhase();
        $this->institution = $request->getInstitution();
        $this->major = $request->getMajor();
        $this->note = $request->getNote();
        $this->talent = $talent;
        $this->time = EducationTime::fromNative($request->getStartYear(), $request->getEndYear());
    }
    
    /**
     * @param EducationWriteDataObject $request
     * @return true||ErrorMessage
     */
    function change(EducationWriteDataObject $request){
        $this->institution = $request->getInstitution();
        $this->major = $request->getMajor();
        $this->note = $request->getNote();
        try {
            $this->time = EducationTime::fromNative($request->getStartYear(), $request->getEndYear());
            return true;
        } catch (\Resources\Exception\CatchableException $ex) {
            return ErrorMessage::error400_BadRequest([$ex->getMessage()]);
        }
    }
    
    function remove(){
        $this->isRemoved = true;
    }
    
}
