<?php

namespace Team\Idea\DomainModel\Idea\DataObject;

class IdeaWriteDataObject{
    protected $name;
    protected $description;
    protected $targetCustomer;
    protected $problemFaced;
    protected $valueProposed;
    protected $revenueModel;
    
    function getName() {
        return $this->name;
    }
    function getDescription() {
        return $this->description;
    }
    function getTargetCustomer() {
        return $this->targetCustomer;
    }
    function getProblemFaced() {
        return $this->problemFaced;
    }
    function getValueProposed() {
        return $this->valueProposed;
    }
    function getRevenueModel() {
        return $this->revenueModel;
    }
    
    function __construct($name, $description, $targetCustomer, $problemFaced, $valueProposed, $revenueModel) {
        $this->name = $name;
        $this->description = $description;
        $this->targetCustomer = $targetCustomer;
        $this->problemFaced = $problemFaced;
        $this->valueProposed = $valueProposed;
        $this->revenueModel = $revenueModel;
    }

            
    static function request($name, $description, $targetCustomer, $problemFaced, 
            $valueProposed, $revenueModel
    ){
        return new static($name, $description, $targetCustomer, $problemFaced, 
                $valueProposed, $revenueModel);
    }
}
