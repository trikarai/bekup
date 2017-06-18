<?php

namespace Team\Idea\DomainModel\Talent;

use Team\Idea\DomainModel\Superhero\SuperheroRdo;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;

class TalentQuery extends \Superclass\DomainModel\Talent\TalentQueryAbstract{
    protected $superheroRdos;
    
    protected function __construct($id, $name, $userName, $email, $phone, $cityOfOrigin, \Datetime $birthDate, \Superclass\DomainModel\City\CityReadDataObject $cityRdo, \Superclass\DomainModel\Track\TrackReadDataObject $trackRdo) {
        parent::__construct($id, $name, $userName, $email, $phone, $cityOfOrigin, $birthDate, $cityRdo, $trackRdo);
        $this->superheroRdos = new ArrayCollection();
    }
    
    /**
     * @param type $id
     * @return SuperheroRdo
     */
    function aSuperheroRdoOfId($id){
        $criteria = Criteria::create()
                ->where(Criteria::expr()->andX(
                        Criteria::expr()->eq('id', $id),
                        Criteria::expr()->eq('isRemoved', false)
                ));
        return $this->superheroRdos->matching($criteria)->first();
    }
    
    /**
     * @return SuperheroRdo[]
     */
    function allSuperheroRdos(){
        $criteria = Criteria::create()
                ->where(Criteria::expr()->eq('isRemoved', false));
        return $this->superheroRdos->matching($criteria)->toArray();
    }
    
}
