<?php

namespace Team\Programme\DomainModel\Team;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;
use Team\Programme\DomainModel\Programme\ProgrammeRdo;

class TeamQuery extends \Superclass\DomainModel\Team\TeamQueryAbstract{
    /**
     * @var ArrayCollection
     */
    protected $programmeRdos;
    
    /**
     * @param type $id
     * @return ProgrammeRdo||null
     */
    function aProgrammeRdoOfId($id){
        $criteria = Criteria::create()
                ->where(Criteria::expr()->eq('isRemoved', false));
        return $this->programmeRdos->matching($criteria)->get($id);
    }
    
    /**
     * @return ProgrammeRdo[]
     */
    function allProgrammeRdo(){
        $criteria = Criteria::create()
                ->where(Criteria::expr()->eq('isRemoved', false));
        return $this->programmeRdos->matching($criteria)->toArray();
    }
    
}
