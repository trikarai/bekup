<?php

namespace Programme\Description\Infrastructure\Persistence\InMemory;

use Programme\Description\DomainModel\Programme\IProgrammeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;

class InMemoryProgrammeRepository implements IProgrammeRepository{
    /**
     * @var ArrayCollection
     */
    protected $programmes;
    
    public function __construct() {
        $this->programmes = new ArrayCollection();
    }
    
    
    public function All() {
        $criteria = Criteria::create()
                ->where(Criteria::expr()->eq('isRemoved', false));
        return $this->programmes->matching($criteria)->toArray();
    }

    public function add(\Programme\Description\DomainModel\Programme\Programme $programme) {
        $this->programmes->set($programme->getId(), $programme);
    }

    public function nextIdentity() {
        return \Ramsey\Uuid\Uuid::uuid4()->toString();
    }

    public function ofId($id) {
        $criteria = Criteria::create()
                ->where(Criteria::expr()->eq('isRemoved', false));
        return $this->programmes->matching($criteria)->get($id);
    }

    public function ofName($name) {
        $criteria = Criteria::create()
                ->where(Criteria::expr()->andX(
                        Criteria::expr()->eq('name', $name),
                        Criteria::expr()->eq('isRemoved', false)
                ));
        return $this->programmes->matching($criteria)->first();
    }

    public function update() {
        
    }
}
