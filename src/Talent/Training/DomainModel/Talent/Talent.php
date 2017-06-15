<?php

namespace Talent\Training\DomainModel\Talent;

use Resources\ErrorMessage;
use Resources\Exception\CatchableException;

use Superclass\DomainModel\Talent\TalentAbstract;
use Talent\Training\DomainModel\Training\Training;
use Talent\Training\DomainModel\Training\DataObject\TrainingWriteDataObject;
use Talent\Training\DomainModel\Training\DataObject\TrainingReadDataObject;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;


class Talent extends TalentAbstract{
    /**
     * @var ArrayCollection
     */
    protected $trainings;

    /**
     * @param type $id
     * @return TrainingReadDataObject
     */
    function aTrainingReadDataObjectOfId($id){
        $training = $this->_findTraining($id);
        if(empty($training)){
            return null;
        }
        return $training->toReadDataObject();
    }
    /**
     * @return TrainingReadDataObject[]
     */
    function allTrainingReadDataObject(){
        $trainingRDOs = [];
        foreach($this->_arrayOfActiveTrainings() as $training){
            $trainingRDOs[] = $training->toReadDataObject();
        }
        return $trainingRDOs;
    }

    protected  function __construct() {
        $this->trainings = new ArrayCollection();
    }
    
    /**
     * @param TrainingWriteDataObject $request
     * @return true||ErrorMessage
     */
    function addTraining(TrainingWriteDataObject $request){
        $id = $this->trainings->count() + 1;
        try{
            $training = new Training($id, $request, $this);
            $this->trainings->set($id, $training);
            return true;
        } catch(CatchableException $ex){
            return ErrorMessage::error400_BadRequest([$ex->getMessage()]);
        }
    }
    
    /**
     * @param type $id
     * @param TrainingWriteDataObject $request
     * @return true||ErrorMessage
     */
    function updateTraining($id, TrainingWriteDataObject $request){
        $msg = true;
        $training = $this->_findTraining($id);
        if(empty($training)){
            $msg = ErrorMessage::error404_NotFound(['training not found or already removed']);
        }else{
            $msg = $training->change($request);
        }
        return $msg;
    }
    
    function removeTraining($id){
        $msg = true;
        $training = $this->_findTraining($id);
        
        if(empty($training)){
            $msg = ErrorMessage::error404_NotFound(["training not found or already removed"]);
        }else{
            $training->remove();
        }
        return $msg;
    }
    
    /**
     * @param type $id
     * @return Training||null
     */
    protected function _findTraining($id){
        $criteria = Criteria::create()
                ->where(Criteria::expr()->andX(
                        Criteria::expr()->eq('id', $id),
                        Criteria::expr()->eq('isRemoved', false)
                ));
        return $this->trainings->matching($criteria)->first();
    }
    /**
     * @return Training[]
     */
    protected function _arrayOfActiveTrainings(){
        $criteria = Criteria::create()
                ->where(Criteria::expr()->eq('isRemoved', false));
        return $this->trainings->matching($criteria)->toArray();
    }
}
