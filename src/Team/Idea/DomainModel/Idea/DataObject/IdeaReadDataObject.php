<?php

namespace Team\Idea\DomainModel\Idea\DataObject;

use Team\Idea\DomainModel\Idea\Idea;
use Team\Idea\DomainModel\Superhero\DataObject\SuperheroReadDataObject;
use Superclass\DomainModel\Talent\TalentReadDataObject;
use Resources\IReadDataObject;

class IdeaReadDataObject implements IReadDataObject{
    protected $id;
    protected $name;
    protected $localProblem;
    protected $globalTrendRelation;
    protected $appliedTechnology;
    protected $idealFinalResult;
    protected $valueContradiction;
    protected $usedResource;
    protected $superheroRDO = null;
    protected $talentInitiatorRDO;
    
    function getId() {
        return $this->id;
    }
    function getName() {
        return $this->name;
    }
    function getLocalProblem() {
        return $this->localProblem;
    }
    function getGlobalTrendRelation() {
        return $this->globalTrendRelation;
    }
    function getAppliedTechnology() {
        return $this->appliedTechnology;
    }
    function getIdealFinalResult() {
        return $this->idealFinalResult;
    }
    function getValueContradiction() {
        return $this->valueContradiction;
    }
    function getUsedResource() {
        return $this->usedResource;
    }
    /**
     * @return SuperheroReadDataObject
     */
    function superheroRDO() {
        return $this->superheroRDO;
    }
    /**
     * @return TalentReadDataObject
     */
    function talentInitiatorRDO() {
        return $this->talentInitiatorRDO;
    }

    function __construct($id, $name, $localProblem, $globalTrendRelation, $appliedTechnology, $idealFinalResult, $valueContradiction, $usedResource, SuperheroReadDataObject $superheroRDO = null, TalentReadDataObject $talentInitiatorRDO) {
        $this->id = $id;
        $this->name = $name;
        $this->localProblem = $localProblem;
        $this->globalTrendRelation = $globalTrendRelation;
        $this->appliedTechnology = $appliedTechnology;
        $this->idealFinalResult = $idealFinalResult;
        $this->valueContradiction = $valueContradiction;
        $this->usedResource = $usedResource;
        $this->superheroRDO = $superheroRDO;
        $this->talentInitiatorRDO = $talentInitiatorRDO;
    }

    
    

    function toArray(){
        $rdo = $this->superheroRDO();
        if(empty($rdo)){
            $superhero_array = null;
        }else{
            $superhero_array = $rdo->toArray();
        }
        return Array(
            'id' => $this->getId(),
            'name' => $this->getName(),
            'local_problem' => $this->getLocalProblem(),
            'global_trend_relation' => $this->getGlobalTrendRelation(),
            'applied_technology' => $this->getAppliedTechnology(),
            'value_contradiction' => $this->getValueContradiction(),
            'used_resource' => $this->getUsedResource(),
            'superhero' => $superhero_array,
            'talent_initiator' => $this->talentInitiatorRDO()->toArray(),
        );
    }
}
