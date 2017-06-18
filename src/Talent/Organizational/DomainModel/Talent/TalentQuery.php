<?php

namespace Talent\Organizational\DomainModel\Talent;

use Talent\Organizational\DomainModel\Organizational\OrganizationalRdo;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;

class TalentQuery extends \Superclass\DomainModel\Talent\TalentQueryAbstract{
    /**
     * @var ArrayCollection
     */
    protected $organizationalRdos;
    
    protected function __construct($id, $name, $userName, $email, $phone, $cityOfOrigin, \Datetime $birthDate, \Superclass\DomainModel\City\CityReadDataObject $cityRdo, \Superclass\DomainModel\Track\TrackReadDataObject $trackRdo, $gender, $bekupType, $motivation) {
        parent::__construct($id, $name, $userName, $email, $phone, $cityOfOrigin, $birthDate, $cityRdo, $trackRdo, $gender, $bekupType, $motivation);
        $this->organizationalRdos = new ArrayCollection();
    }
    
    /**
     * @param type $id
     * @return OrganizationalRdo||false||null
     */
    function anOrganizationalRdoOfId($id){
        $criteria = Criteria::create()
                ->where(Criteria::expr()->andX(
                        Criteria::expr()->eq('id', $id),
                        Criteria::expr()->eq('isRemoved', false)
                ));
        return $this->organizationalRdos->matching($criteria)->first();
    }
    
    /**
     * @return OrganizationalRdo[]
     */
    function allOrganizationalRdo(){
        $criteria = Criteria::create()
                ->where(Criteria::expr()->eq('isRemoved', false));
        return $this->organizationalRdos->matching($criteria)->toArray();
    }
    
}
