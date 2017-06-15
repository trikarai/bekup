<?php

namespace Tests\Team\Idea\ApplicationService\Superhero;

use Team\Idea\Infrastructure\Persistence\InMemory\Talent\InMemoryTalentRepository;
use Team\Idea\DomainModel\Talent\Talent;
use Team\Idea\DomainModel\Superhero\Superhero;
use Team\Idea\DomainModel\Superhero\DataObject\SuperheroWriteDataObject;

class PreparedInMemoryTalentData {
    protected $talent;
    protected $batman;
    protected $goku;
    protected $repository;
    
    public function __construct($talentId) {
        $this->repository = new TestableTalentRepository();
        $this->talent = new TestableTalent($talentId);
        $this->repository->add($this->talent);
        $this->_setBatman();
        $this->_setGoku();
    }
    protected function _setBatman(){
        $request = SuperheroWriteDataObject::request('batman', 'catch bad guys', 'rich', 'party', 'robocop');
        $this->talent->addSuperhero($request);
        $this->batman = $this->talent->getLastInsertedSuperhero();
    }
    protected function _setGoku(){
        $request = SuperheroWriteDataObject::request('goku', 'protect earth', 'kamehameha', 'training', 'nuclear bomb');
        $this->talent->addSuperhero($request);
        $this->goku = $this->talent->getLastInsertedSuperhero();
    }
    
    /** @return TestableTalentRepository */
    function repository(){
        return $this->repository;
    }
    /** @return TestableTalent */
    function talent(){
        return $this->talent;
    }
    /** @return Superhero */
    function batman(){
        return $this->batman;
    }
    /** @return Superhero */
    function goku(){
        return $this->goku;
    }
}


use Doctrine\Common\Collections\Criteria;
class TestableTalent extends Talent{
    public function __construct($talentId) {
        $this->id = $talentId;
        parent::__construct();
    }
    /**
     * @return Superhero
     */
    function getLastInsertedSuperhero(){
        return $this->superheroes->last();
    }
    /**
     * @return Superhero[]
     */
    function getArrayOfActiveSuperhero(){
        $criteria = Criteria::create()
                ->where(Criteria::expr()->eq('isRemoved', false));
        return $this->superheroes->matching($criteria)->toArray();
    }
}

class TestableTalentRepository extends InMemoryTalentRepository{
    
}
