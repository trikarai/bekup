<?php

namespace City\Profile\Infrastructure\Persistence\InMemory\City;

use City\Profile\DomainModel\City\ICityRepository;
use City\Profile\DomainModel\City\City;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;

class InMemoryCityRepository implements ICityRepository{
    /**
     * @var ArrayCollection
     */
    protected $cities;
    
    public function __construct() {
        $this->cities = new ArrayCollection();
    }
    
    public function add(City $city) {
        $this->cities->set($city->getId(), $city);
    }

    public function all() {
        $criteria = Criteria::create()
                ->where(Criteria::expr()->eq('isRemoved', false));
        return $this->cities->matching($criteria)->toArray();
    }

    public function nextIdentity() {
        return \Ramsey\Uuid\Uuid::uuid4()->toString();
    }

    public function ofId($id) {
        $criteria = Criteria::create()
                ->where(Criteria::expr()->eq('isRemoved', false));
        return $this->cities->matching($criteria)->get($id);
    }

    public function ofName($name) {
        $criteria = Criteria::create()
                ->where(Criteria::expr()->andX(
                        Criteria::expr()->eq('isRemoved', false),
                        Criteria::expr()->eq('name', $name)
                ));
        $city = $this->cities->matching($criteria)->first();
        if(empty($city))
            return null;
        return $city;
    }

    public function update() {
        
    }
}
