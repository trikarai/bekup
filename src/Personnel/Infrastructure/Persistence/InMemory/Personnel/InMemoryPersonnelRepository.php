<?php

namespace Personnel\Infrastructure\Persistence\InMemory\Personnel;

use Personnel\DomainModel\Personnel\IPersonnelRepository;
use Personnel\DomainModel\Personnel\Personnel;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;

class InMemoryPersonnelRepository implements IPersonnelRepository{
    /**
     * @var ArrayCollection
     */
    protected $personnels;
    
    public function __construct() {
        $this->personnels = new ArrayCollection();
    }
    
    public function add(Personnel $personnel) {
        $this->personnels->set($personnel->getId(), $personnel);
    }

    /**
     * @return Personnel[]
     */
    public function all() {
        $criteria = Criteria::create()
                ->where(Criteria::expr()->eq('isRemoved', false));
        return $this->personnels->matching($criteria)->toArray();
    }

    public function nextIdentity() {
        return \Ramsey\Uuid\Uuid::uuid4()->toString();
    }

    public function ofEmail($email) {
        $criteria = Criteria::create()
                ->where(Criteria::expr()->andX(
                        Criteria::expr()->eq('email', $email),
                        Criteria::expr()->eq('isRemoved', false)
                ));
        return $this->personnels->matching($criteria)->first();
    }

    public function ofId($id) {
        $criteria = Criteria::create()
                ->where(Criteria::expr()->eq('isRemoved', false));
        return $this->personnels->matching($criteria)->get($id);
    }

    public function update() {
        
    }
}
