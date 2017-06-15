<?php

namespace Talent\Skill\DomainModel\Talent;

use Resources\ErrorMessage;
use Superclass\DomainModel\Talent\TalentAbstract;
use Talent\Skill\DomainModel\Skill\DataObject\SkillReadDataObject;
use Talent\Skill\DomainModel\SkillScore\SkillScore;
use Talent\Skill\DomainModel\SkillScore\DataObject\SkillScoreReadDataObject;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;

class Talent extends TalentAbstract{
    /**
     * @var ArrayCollection
     */
    protected $skillScores;
    
    /**
     * @param type $id
     * @return SkillScoreReadDataObject
     */
    function aSkillScoreReadDataObjectOfId($id){
        $skillScore = $this->_findSkillScore($id);
        if(empty($skillScore)){
            return null;
        }
        return $skillScore->toReadDataObject();
    }
    
    /**
     * @return SkillScoreReadDataObject[]
     */
    function allSkillScoreReadDataObject(){
        $skillScores = $this->_arrayOfActiveSkillScores();
        $skillScoreRDOs = [];
        foreach($skillScores as $skillScore){
            $skillScoreRDOs[] = $skillScore->toReadDataObject();
        }
        return $skillScoreRDOs;
    }
    
    protected function __construct() {
        $this->skillScores = new ArrayCollection();
    }
    
    /**
     * 
     * @param SkillReadDataObject $skillRDO
     * @param type $scoreValue
     * @return true||ErrorMessage
     */
    function addSkillScore(SkillReadDataObject $skillRDO, $scoreValue){
        $id = $this->skillScores->count() + 1;
        if(!$this->_isNotDuplicateSkillRDO($skillRDO)){
            return ErrorMessage::error409_Conflict(["skill Reference: '{$skillRDO->getName()}' already used"]);
        }
        $skillScore = new SkillScore($id, $scoreValue, $skillRDO, $this);
        $this->skillScores->set($id, $skillScore);
        return true;
    }
    
    /**
     * @param type $id
     * @param type $scoreValue
     * @return true||ErrorMessage
     */
    function updateSkillScore($id, $scoreValue){
        $skillScore = $this->_findSkillScore($id);
        if(empty($skillScore)){
            return ErrorMessage::error404_NotFound(['skill score not found or already removed']);
        }
        $skillScore->change($scoreValue);
        return true;
    }
    
    /**
     * @param type $id
     * @return true||ErrorMessage
     */
    function removeSkillScore($id){
        $skillScore = $this->_findSkillScore($id);
        if(empty($skillScore)){
            return ErrorMessage::error404_NotFound(['skill score not found or already removed']);
        }
        $skillScore->remove();
        return true;
    }
    
    /**
     * @param type $id
     * @return SkillScore
     */
    protected function _findSkillScore($id){
        $criteria = Criteria::create()
                ->where(Criteria::expr()->andX(
                        Criteria::expr()->eq('id', $id),
                        Criteria::expr()->eq('isRemoved', false)
                ));
        return $this->skillScores->matching($criteria)->first();
    }
    /**
     * @return SkillScore[]
     */
    protected function _arrayOfActiveSkillScores(){
        $criteria = Criteria::create()
                ->where(Criteria::expr()->eq('isRemoved', false));
        return $this->skillScores->matching($criteria)->toArray();
    }
    /**
     * @param SkillReadDataObject $skillRDO
     * @return boolean
     */
    protected function _isNotDuplicateSkillRDO(SkillReadDataObject $skillRDO){
        $criteria = Criteria::create()
                ->where(Criteria::expr()->andX(
                Criteria::expr()->eq('skillId', $skillRDO->getId()),
                Criteria::expr()->eq('isRemoved', false)
                ));
        $skillScore = $this->skillScores->matching($criteria)->first();
        if(empty($skillScore)){
            return true;
        }
        return false;
    }
}
