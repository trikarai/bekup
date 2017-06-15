<?php

namespace Talent\Education\DomainModel\Talent;

use Resources\ErrorMessage;
use Resources\Exception\CatchableException;

use Superclass\DomainModel\Talent\TalentAbstract;
use Talent\Education\DomainModel\Education\Education;
use Talent\Education\DomainModel\Education\DataObject\EducationWriteDataObject;
use Talent\Education\DomainModel\Education\DataObject\EducationReadDataObject;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;

class Talent extends TalentAbstract{
    /**
     * @var ArrayCollection
     */
    protected $educations;
    
    /**
     * @param type $id
     * @return EducationReadDataObject
     */
    function anEducationReadDataObjectOfId($id){
        $education = $this->_findEducation($id);
        if(empty($education)){
            return null;
        }
        return $education->toReadDataObject();
    }
    
    /**
     * @return EducationReadDataObject[]
     */
    function allEducationReadDataobject(){
        $educationRDOs = [];
        foreach($this->_arrayOfNonRemovedEducation() as $education){
            $educationRDOs[] = $education->toReadDataObject();
        }
        return $educationRDOs;
    }
    
    protected function __construct() {
        $this->educations = new ArrayCollection();
    }
    
    /**
     * @param EducationWriteDataObject $request
     * @return true||ErrorMessage
     */
    function addEducation(EducationWriteDataObject $request){
        $id = $this->educations->count() + 1;
        try{
            $education = new Education($id, $request, $this);
            $this->educations->set($id, $education);
            return true;
        } catch (CatchableException $e){
            return ErrorMessage::error400_BadRequest([$e->getMessage()]);
        }
    }
    
    /**
     * @param type $id
     * @param EducationWriteDataObject $request
     * @return true||ErrorMessage
     */
    function updateEducation($id, EducationWriteDataObject $request){
        $msg = true;
        $education = $this->_findEducation($id);
        if(empty($education)){
            $msg = ErrorMessage::error404_NotFound(['education not found or already removed']);
        }else {
            $msg = $education->change($request);
        }
        return $msg;
    }
    
    /**
     * @param type $id
     * @return true||ErrorMessage
     */
    function removeEducation($id){
        $msg = true;
        $education = $this->_findEducation($id);
        if(empty($education)){
            $msg = ErrorMessage::error404_NotFound(['education not found or already removed']);
        }else{
            $education->remove();
        }
        return $msg;
    }
    
    /**
     * @param type $id
     * @return Education
     */
    protected function _findEducation($id){
        $criteria = Criteria::create()
                ->where(Criteria::expr()->andX(
                        Criteria::expr()->eq('id', $id),
                        Criteria::expr()->eq('isRemoved', false)
                ));
        return $this->educations->matching($criteria)->first();
    }
    /**
     * @return Education
     */
    protected function _arrayOfNonRemovedEducation(){
        $criteria = Criteria::create()
                ->where(Criteria::expr()->eq('isRemoved', false));
        return $this->educations->matching($criteria)->toArray();
    }
}
