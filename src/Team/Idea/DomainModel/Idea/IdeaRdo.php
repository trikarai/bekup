<?php

namespace Team\Idea\DomainModel\Idea;

use Resources\IReadDataObject;
use Team\Idea\DomainModel\Superhero\SuperheroRdo;
use Superclass\DomainModel\Talent\TalentReadDataObject;
use Team\Idea\DomainModel\Team\TeamQuery;

class IdeaRdo implements IReadDataObject{
    protected $id;
    protected $name;
    protected $description;
    protected $targetCustomer;
    protected $problemFaced;
    protected $valueProposed;
    protected $revenueModel;
    protected $isRemoved;
    /**
     * @var SuperheroRdo
     */
    protected $superheroRdo;
    /**
     * @var TalentReadDataObject
     */
    protected $talentInitiatorRdo;
    /**
     * @var TeamQuery
     */
    protected $teamQuery;
    
    function getId() {
        return $this->id;
    }
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
    function getIsRemoved() {
        return $this->isRemoved;
    }
    /**
     * @return SuperheroRdo
     */
    function superheroRdo() {
        return $this->superheroRdo;
    }
    /**
     * @return TalentReadDataObject
     */
    function getTalentInitiatorRdo() {
        return $this->talentInitiatorRdo;
    }
    /**
     * @return TeamQuery
     */
    function getTeamQuery() {
        return $this->teamQuery;
    }

    protected function __construct($id, $name, $description, $targetCustomer, $problemFaced, $valueProposed, $revenueModel, $isRemoved, SuperheroRdo $superheroRdo, TalentReadDataObject $talentInitiatorRdo, TeamQuery $teamQuery) {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->targetCustomer = $targetCustomer;
        $this->problemFaced = $problemFaced;
        $this->valueProposed = $valueProposed;
        $this->revenueModel = $revenueModel;
        $this->isRemoved = $isRemoved;
        $this->superheroRdo = $superheroRdo;
        $this->talentInitiatorRdo = $talentInitiatorRdo;
        $this->teamQuery = $teamQuery;
    }

    public function toArray() {
        return array(
            'id' => $this->getId(),
            'description' => $this->getDescription(),
            'target_customer' => $this->getTargetCustomer(),
            'problem_faces' => $this->getProblemFaced(),
            'value_proposed' => $this->getValueProposed(),
            'revenue_model' => $this->getRevenueModel(),
            'is_removed' => $this->getIsRemoved(),
            'superhero' => $this->superheroRdo->toArray(),
            'talent_initiator' => $this->talentInitiatorRdo->toArray(),
            'team' => $this->teamQuery->toArray(),
        );
    }

}
