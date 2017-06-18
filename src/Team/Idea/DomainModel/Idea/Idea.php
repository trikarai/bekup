<?php

namespace Team\Idea\DomainModel\Idea;

use Team\Idea\DomainModel\Idea\DataObject\IdeaWriteDataObject;
use Team\Idea\DomainModel\Team\Team;

class Idea {
    protected $id;
    protected $name;
    protected $description;
    protected $targetCustomer;
    protected $problemFaced;
    protected $valueProposed;
    protected $revenueModel;
    protected $isRemoved = false;
    protected $superheroId = null;
    protected $talentInitiatorId;
    /**
     * @var Team
     */
    protected $team;
    
    function getId(){
        return $this->id;
    }
    function getName(){
        return $this->name;
    }
    function getIsRemoved(){
        return $this->isRemoved;
    }

    /**
     * @param type $id
     * @param IdeaWriteDataObject $request
     * @param type $talentId
     * @param Team $team
     * @param type $superheroId
     */
    function __construct($id, IdeaWriteDataObject $request, $talentId, Team $team, $superheroId = null) {
        $this->id = $id;
        $this->name = $request->getName();
        $this->description = $request->getDescription();
        $this->targetCustomer = $request->getTargetCustomer();
        $this->problemFaced = $request->getProblemFaced();
        $this->valueProposed = $request->getValueProposed();
        $this->revenueModel = $request->getRevenueModel();
        $this->talentInitiatorId = $talentId;
        $this->team = $team;
        $this->superheroId = $superheroId;
    }

    /**
     * @param IdeaWriteDataObject $request
     * @param type $superheroId
     */
    function update(IdeaWriteDataObject $request, $superheroId = null){
        $this->name = $request->getName();
        $this->description = $request->getDescription();
        $this->targetCustomer = $request->getTargetCustomer();
        $this->problemFaced = $request->getProblemFaced();
        $this->valueProposed = $request->getValueProposed();
        $this->revenueModel = $request->getRevenueModel();
        $this->superheroId = $superheroId;
    }
    
    function remove(){
        $this->isRemoved = true;
    }
}
