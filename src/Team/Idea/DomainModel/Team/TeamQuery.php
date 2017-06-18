<?php

namespace Team\Idea\DomainModel\Team;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;
use Team\Idea\DomainModel\Idea\IdeaRdo;

class TeamQuery extends \Superclass\DomainModel\Team\TeamQueryAbstract{
    /**
     * @var ArrayCollection
     */
    protected $ideaRdos;
    
    protected function __construct($id, $name, $vision, $mission, $culture, $founderAgreement, \Superclass\DomainModel\City\CityReadDataObject $cityRDO, $isRemoved) {
        parent::__construct($id, $name, $vision, $mission, $culture, $founderAgreement, $cityRDO, $isRemoved);
        $this->ideaRdos = new ArrayCollection();
    }
    
    /**
     * @param type $id
     * @return IdeaRdo||null
     */
    function anIdeaRdoOfId($id){
        $criteria = Criteria::create()
                ->where(Criteria::expr()->andX(
                        Criteria::expr()->eq('id', $id),
                        Criteria::expr()->eq('isRemoved', false)
                ));
        return $this->ideaRdos->matching($criteria)->first();
    }
    
    /**
     * @return IdeaRdo[]
     */
    function allIdeaRdos(){
        $criteria = Criteria::create()
                ->where(Criteria::expr()->eq('isRemoved', false));
        return $this->ideaRdos->matching($criteria)->toArray();
    }
    
}
