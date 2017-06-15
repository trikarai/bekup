<?php

namespace Track\Definition\Infrastructure\Persistence\InMemory\Track;

use Track\Definition\DomainModel\Track\ITrackRepository;
use Track\Definition\DomainModel\Track\Track;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;

class InMemoryTrackRepository implements ITrackRepository{
    /**
     * @var ArrayCollection
     */
    protected $tracks;
    
    public function __construct() {
        $this->tracks = new ArrayCollection();
    }
    
    public function add(Track $track) {
        $this->tracks->set($track->getId(), $track);
    }

    public function nextIdentity() {
        return \Ramsey\Uuid\Uuid::uuid4()->toString();
    }

    public function all() {
        $criteria = Criteria::create()
                ->where(Criteria::expr()->eq('isRemoved', false));
        return $this->tracks->matching($criteria)->toArray();
    }

    public function ofId($id) {
        $criteria = Criteria::create()
                ->where(Criteria::expr()->eq('isRemoved', false));
        return $this->tracks->matching($criteria)->get($id);
    }

    public function ofName($name) {
        $criteria = Criteria::create()
                ->where(Criteria::expr()->andX(
                        Criteria::expr()->eq('isRemoved', false),
                        Criteria::expr()->eq('name', $name)
                ));
        $track = $this->tracks->matching($criteria)->first();
        if($track instanceof Track) 
            return $track;
        return null;
    }

    public function update() {
        
    }
}
