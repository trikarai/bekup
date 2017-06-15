<?php

namespace Team\Idea\DomainModel\Idea\DataObject;

class IdeaWriteDataObject{
    protected $name;
    protected $localProblem;
    protected $globalTrendRelation;
    protected $appliedTechnology;
    protected $idealFinalResult;
    protected $valueContradiction;
    protected $usedResource;
    
    function getName(){
        return $this->name;
    }
    function getLocalProblem(){
        return $this->localProblem;
    }
    function getGlobalTrendRelation(){
        return $this->globalTrendRelation;
    }
    function getAppliedTechnology(){
        return $this->appliedTechnology;
    }
    function getIdealFinalResult(){
        return $this->idealFinalResult;
    }
    function getValueContradiction(){
        return $this->valueContradiction;
    }
    function getUsedResource(){
        return $this->usedResource;
    }
    
    protected function __construct($name, $localProblem, $globalTrendRelation, 
            $appliedTechnology, $idealFinalResult, $valueContradiction, $usedResource
    ) {
        $this->name = $name;
        $this->localProblem = $localProblem;
        $this->globalTrendRelation = $globalTrendRelation;
        $this->appliedTechnology = $appliedTechnology;
        $this->idealFinalResult = $idealFinalResult;
        $this->valueContradiction = $valueContradiction;
        $this->usedResource = $usedResource;
    }
    
    static function request($name, $localProblem, $globalTrendRelation, $appliedTechnology, 
            $idealFinalResult, $valueContradiction, $usedResource
    ){
        return new static($name, $localProblem, $globalTrendRelation, $appliedTechnology, 
                $idealFinalResult, $valueContradiction, $usedResource);
    }
}
