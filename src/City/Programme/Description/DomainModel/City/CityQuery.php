<?php

namespace City\Programme\Description\DomainModel\City;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;
use City\Programme\Description\DomainModel\Programme\ProgrammeRdo;

class CityQuery extends \Superclass\DomainModel\City\CityQueryAbstract{
    /**
     * @var ArrayCollection
     */
    protected $programmeRdos;
    
    /**
     * 
     * @param type $id
     * @return ProgrammeRdo
     */
    function aProgrammeRdoOfId($id){
        $criteria = Criteria::create()
                ->where(Criteria::expr()->andX(
                        Criteria::expr()->eq('id', $id),
                        Criteria::expr()->eq('isRemoved', false)
                ));
        return $this->programmeRdos->matching($criteria)->first();
    }
    
    /**
     * @param type $id
     * @return ProgrammeRdo
     */
    function allProgrammeRdo(){
        $criteria = Criteria::create()
                ->where(Criteria::expr()->eq('isRemoved', false));
        return $this->programmeRdos->matching($criteria)->toArray();
    }
}
