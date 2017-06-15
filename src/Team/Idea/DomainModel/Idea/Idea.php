<?php

namespace Team\Idea\DomainModel\Idea;

use Team\Idea\DomainModel\Idea\DataObject\IdeaWriteDataObject;
use Team\Idea\DomainModel\Idea\DataObject\IdeaReadDataObject;

use Team\Idea\DomainModel\Superhero\DataObject\SuperheroReadDataObject;
use Superclass\DomainModel\Talent\TalentReadDataObject;
use Team\Idea\DomainModel\Team\Team;

class Idea {
    protected $id;
    protected $name;
    protected $localProblem;
    protected $globalTrendRelation;
    protected $appliedTechnology;
    protected $idealFinalResult;
    protected $valueContradiction;
    protected $usedResource;
    /**
     * @var SuperheroReadDataObject
     */
    protected $superheroRDO = null;
    /**
     * @var TalentReadDataObject
     */
    protected $talentInitiatorRDO;
    protected $team;
    
    protected $isRemoved = false;
    
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
     * @return IdeaReadDataObject
     */
    function toReadDataObject(){
        return new IdeaReadDataObject($this->id, $this->name, $this->localProblem, 
                $this->globalTrendRelation, $this->appliedTechnology, $this->idealFinalResult, 
                $this->valueContradiction, $this->usedResource, $this->superheroRDO, $this->talentInitiatorRDO);
    }
    
    /**
     * @param Team $team
     * @param type $id
     * @param IdeaWriteDataObject $request
     * @param TalentReadDataObject $talentRDO
     * @param SuperheroReadDataObject $superheroRDO
     */
    public function __construct(Team $team, $id, IdeaWriteDataObject $request, 
            TalentReadDataObject $talentRDO, SuperheroReadDataObject $superheroRDO = null
    ) {
        $this->id = $id;
        $this->name = $request->getName();
        $this->localProblem = $request->getLocalProblem();
        $this->globalTrendRelation = $request->getGlobalTrendRelation();
        $this->appliedTechnology = $request->getAppliedTechnology();
        $this->idealFinalResult = $request->getIdealFinalResult();
        $this->valueContradiction = $request->getValueContradiction();
        $this->usedResource = $request->getUsedResource();
        
        $this->superheroRDO = $superheroRDO;
        $this->talentInitiatorRDO = $talentRDO;
        $this->team = $team;
    }
    
    /**
     * @param IdeaWriteDataObject $request
     */
    function update(IdeaWriteDataObject $request){
        $this->name = $request->getName();
        $this->localProblem = $request->getLocalProblem();
        $this->globalTrendRelation = $request->getGlobalTrendRelation();
        $this->appliedTechnology = $request->getAppliedTechnology();
        $this->idealFinalResult = $request->getIdealFinalResult();
        $this->valueContradiction = $request->getValueContradiction();
        $this->usedResource = $request->getUsedResource();
    }
    function remove(){
        $this->isRemoved = true;
    }
}
