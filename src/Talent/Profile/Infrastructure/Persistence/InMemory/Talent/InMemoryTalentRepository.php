<?php

namespace Talent\Profile\Infrastructure\Persistence\InMemory\Talent;

use Talent\Profile\DomainModel\Talent\ITalentRepository;
use Talent\Profile\DomainModel\Talent\Talent;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;

class InMemoryTalentRepository implements ITalentRepository{
    /**
     * @var ArrayCollection
     */
    protected $talents;
    
    public function __construct() {
        $this->talents = new ArrayCollection();
    }
    
    public function add(Talent $talent) {
        $this->talents->set($talent->getId(), $talent);
    }

    public function all() {
        return $this->talents->toArray();
    }

    public function nextIdentity() {
        return \Ramsey\Uuid\Uuid::uuid4()->toString();
    }

    public function ofCity($cityId) {
        $talentObjects = [];
        foreach($this->all() as $talent){
            if($talent->cityReadDataObject()->getId() === $cityId){
                $talentObjects[] = $talent;
            }
        }
        return $talentObjects;
    }

    public function ofEmail($email) {
        $criteria = Criteria::create()
                ->where(Criteria::expr()->eq('email', $email));
        $talent = $this->talents->matching($criteria)->first();
        if($talent instanceof Talent){
            return $talent;
        }
        return null;
    }

    public function ofId($id) {
        $criteria = Criteria::create()
                ->where(Criteria::expr()->eq('id', $id));
        $talent = $this->talents->matching($criteria)->first();
        if($talent instanceof Talent){
            return $talent;
        }
        return null;
    }

    public function ofUserName($userName) {
        $criteria = Criteria::create()
                ->where(Criteria::expr()->eq('userName', $userName));
        $talent = $this->talents->matching($criteria)->first();
        if($talent instanceof Talent){
            return $talent;
        }
        return null;
    }

    public function update() {
        
    }

}
