<?php

namespace Talent\Entrepreneurship\DomainModel\Talent;

use Talent\Entrepreneurship\DomainModel\Entrepreneurship\EntrepreneurshipRdo;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;


class TalentQuery extends \Superclass\DomainModel\Talent\TalentQueryAbstract{
    /**
     * @var ArrayCollection
     */
    protected $entrepreneurshipRdos;
    
    protected function __construct($id, $name, $userName, $email, $phone, $cityOfOrigin, \Datetime $birthDate, \Superclass\DomainModel\City\CityReadDataObject $cityRdo, \Superclass\DomainModel\Track\TrackReadDataObject $trackRdo, $gender, $bekupType, $motivation) {
        parent::__construct($id, $name, $userName, $email, $phone, $cityOfOrigin, $birthDate, $cityRdo, $trackRdo, $gender, $bekupType, $motivation);
        $this->entrepreneurshipRdos = new ArrayCollection();
    }
    
    /**
     * @param type $id
     * @return EntrepreneurshipRdo||null||false
     */
    function anEntrepreneurshipRdoOfId($id){
        $criteria = Criteria::create()
                ->where(Criteria::expr()->andX(
                        Criteria::expr()->eq('id', $id),
                        Criteria::expr()->eq('isRemoved', false)
                ));
        return $this->entrepreneurshipRdos->matching($criteria)->first();
    }
    
    /**
     * @return EntrepreneurshipRdo[]
     */
    function allEntrepreneurshipRdo(){
        $criteria = Criteria::create()
                ->where(Criteria::expr()->eq('isRemoved', false));
        return $this->entrepreneurshipRdos->matching($criteria)->toArray();
    }
    
}
