<?php

namespace Talent\WorkingExperience\DomainModel\Talent;

use Resources\ErrorMessage;

use Superclass\DomainModel\Talent\TalentAbstract;
use Talent\WorkingExperience\DomainModel\WorkingExperience\WorkingExperience;
use Talent\WorkingExperience\DomainModel\WorkingExperience\DataObject\WorkingExperienceWriteDataObject;
use Talent\WorkingExperience\DomainModel\WorkingExperience\DataObject\WorkingExperienceReadDataObject;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;

class Talent extends TalentAbstract{
    /**
     * @var ArrayCollection
     */
    protected $workingExperiences;

    /**
     * @param type $id
     * @return WorkingExperienceReadDataObject||null
     */
    function aWorkingExperienceReadDataObjectOfId($id){
        $workingExperience = $this->_findWorkingExperience($id);
        if(empty($workingExperience)){
            return null;
        }
        return $workingExperience->toReadDataObject();
    }
    /**
     * @return WorkingExperienceReadDataObject[]||[]
     */
    function allWorkingExperienceReadDataObject(){
        $workingExperienceRDOs = [];
        foreach($this->_arrayOfActiveWorkingExperiece() as $workingExperience){
            $workingExperienceRDOs[] = $workingExperience->toReadDataObject();
        }
        return $workingExperienceRDOs;
    }
    
    protected function __construct() {
        $this->workingExperiences = new ArrayCollection();
    }
    
    /**
     * @param WorkingExperienceWriteDataObject $request
     * @return true||ErrorMessage
     */
    function addWorkingExperience(WorkingExperienceWriteDataObject $request){
        try{
            $id = $this->workingExperiences->count() + 1;
            $workingExperience = new WorkingExperience($id, $request, $this);
            $this->workingExperiences->set($id, $workingExperience);
            return true;
        } catch (\Resources\Exception\CatchableException $e){
            return ErrorMessage::error400_BadRequest([$e->getMessage()]);
        }
    }
    
    /**
     * @param type $id
     * @param WorkingExperienceWriteDataObject $request
     * @return true||ErrorMessage
     */
    function updateWorkingExperience($id, WorkingExperienceWriteDataObject $request){
        $msg = true;
        $workingExperience = $this->_findWorkingExperience($id);
        if(empty($workingExperience)){
            $msg = ErrorMessage::error404_NotFound(['working experience not found or already removed']);
        }else {
            $msg = $workingExperience->change($request);
        }
        return $msg;
    }
    
    /**
     * @param type $id
     * @return true||ErrorMessage
     */
    function removeWorkingExperience($id){
        $msg = true;
        $workingExperience = $this->_findWorkingExperience($id);
        if(empty($workingExperience)){
            $msg = ErrorMessage::error404_NotFound(['working experience not found or already removed']);
        }else {
            $workingExperience->remove();
        }
        return $msg;
    }
    
    /**
     * @param type $id
     * @return WorkingExperience||null
     */
    protected function _findWorkingExperience($id){
        $criteria = Criteria::create()
                ->where(Criteria::expr()->andX(
                        Criteria::expr()->eq('id', $id),
                        Criteria::expr()->eq('isRemoved', false)
                ));
        return $this->workingExperiences->matching($criteria)->first();
    }
    /**
     * @return WorkingExperience[]
     */
    function _arrayOfActiveWorkingExperiece(){
        $criteria = Criteria::create()
                ->where(Criteria::expr()->eq('isRemoved', false));
        return $this->workingExperiences->matching($criteria)->toArray();
    }
}
