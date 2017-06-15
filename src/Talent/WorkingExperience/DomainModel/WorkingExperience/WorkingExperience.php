<?php

namespace Talent\WorkingExperience\DomainModel\WorkingExperience;

use Resources\Exception\CatchableException;
use Resources\ErrorMessage;

use Talent\WorkingExperience\DomainModel\WorkingExperience\DataObject\WorkingExperienceWriteDataObject;
use Talent\WorkingExperience\DomainModel\WorkingExperience\DataObject\WorkingExperienceReadDataObject;
use Talent\WorkingExperience\DomainModel\WorkingExperience\ValueObject\WorkingExperienceTime;

use Talent\WorkingExperience\DomainModel\Talent\Talent;

class WorkingExperience {
    protected $id;
    protected $companyName;
    protected $position;
    protected $role;
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
     * @return WorkingExperienceReadDataObject
     */
    function toReadDataObject(){
        return new WorkingExperienceReadDataObject($this->id, $this->companyName, 
                $this->position, $this->role, $this->time->getStartYear(), $this->time->getEndYear());
    }

    /**
     * @param type $id
     * @param WorkingExperienceWriteDataObject $request
     * @param Talent $talent
     */
    public function __construct($id, WorkingExperienceWriteDataObject $request, Talent $talent){
        $this->id = $id;
        $this->companyName = $request->getCompanyName();
        $this->position = $request->getPosition();
        $this->role = $request->getRole();
        $this->time = WorkingExperienceTime::fromNative($request->getStartYear(), $request->getEndYear());
        $this->talent = $talent;
    }
    
    /**
     * 
     * @param WorkingExperienceWriteDataObject $request
     * @return true||ErrorMessage
     */
    function change(WorkingExperienceWriteDataObject $request){
        try{
            $this->time = WorkingExperienceTime::fromNative($request->getStartYear(), $request->getEndYear());
            
        }catch(CatchableException $e){
            return ErrorMessage::error400_BadRequest([$e->getMessage()]);
        }
        $this->companyName = $request->getCompanyName();
        $this->position = $request->getPosition();
        $this->role = $request->getRole();
        return true;
    }
    
    function remove(){
        $this->isRemoved = true;
    }
}
