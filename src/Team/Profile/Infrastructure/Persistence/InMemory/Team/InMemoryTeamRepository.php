<?php

namespace Team\Profile\Infrastructure\Persistence\InMemory\Team;

use Team\Profile\DomainModel\Team\ITeamRepository;
use Team\Profile\DomainModel\Team\Team;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;

class InMemoryTeamRepository implements ITeamRepository{
    protected $teams;
    
    public function __construct() {
        $this->teams = new ArrayCollection();
    }
    
    function add(Team $team){
        $this->teams->set($team->getId(), $team);
    }
    
    public function all() {
        return $this->teams->toArray();
    }

    public function allWithinCityId($cityId) {
        $teams = [];
        foreach($this->all() as $team){
            if($cityId === $team->CityRDO()->getId()){
                $teams[] = $team;
            }
        }
        return $teams;
    }

    public function nextIdentity() {
        return \Ramsey\Uuid\Uuid::uuid4()->toString();
    }

    public function ofId($id) {
        return $this->teams->get($id);
    }

    public function ofNameWithinCityId($name, $cityId) {
        foreach($this->allWithinCityId($cityId) as $team){
            if($name === $team->getName()){
                return $team;
            }
        }
        return null;
    }

    public function ofTalentId($talentId) {
        
    }

    public function update() {
        
    }
}
