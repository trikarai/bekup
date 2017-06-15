<?php

namespace Team\Programme\DomainModel\Team;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;
use Team\Programme\DomainModel\Programme\ProgrammeRdo;

class TeamQuery extends \Superclass\DomainModel\Team\TeamQueryAbstract{
    /** @var ArrayCollection */
    protected $programmeRdos;
    
    function anActiveProgrammeRdo(){
        $criteria = Criteria::create()
                ->where(Criteria::expr()->eq('status', 'active'));
        return $this->programmeRdos->matching($criteria)->first();
    }
    /**
     * @param type $id
     * @return ProgrammeRdo||null
     */
    function aProgrammeRdoOfId($id){
        return $this->programmeRdos->get($id);
    }
    
    /**
     * @return ProgrammeRdo[]
     */
    function allProgrammeRdo(){
        return $this->programmeRdos->toArray();
    }
}
