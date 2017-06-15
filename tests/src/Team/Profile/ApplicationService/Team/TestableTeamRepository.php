<?php

namespace Tests\Team\Profile\ApplicationService\Team;

use Team\Profile\DomainModel\Team\ITeamRepository;
use Doctrine\Common\Collections\ArrayCollection;

class TestableTeamRepository implements ITeamRepository{
    protected $talentId;
    protected $teamId;
    protected $team;
    
    protected $containName = false;
    
    function getTalentId(){
        return $this->talentId;
    }
    /**
     * @return TestableTeam
     */
    function team(){
        return $this->team;
    }
    function getTeamId(){
        return $this->teamId;
    }
    function markAsDuplicateName(){
        $this->containName = true;
    }
    
    public function __construct() {
        $this->talentId = \Ramsey\Uuid\Uuid::uuid4()->toString();
        $this->teamId = $this->nextIdentity();
        $this->team = new TestableTeam();
    }
    
    public function all() {
        
    }
    public function allWithinCityId($cityId) {
        
    }
    public function nextIdentity() {
        return \Ramsey\Uuid\Uuid::uuid4()->toString();
    }
    public function ofTalentId($talentId) {
        if($talentId === $this->talentId){
            return $this->team;
        }
        return null;
    }
    public function ofId($id) {
        
    }
    public function update() {
        
    }
    public function ofNameWithinCityId($name, $cityId) {
        if($this->containName){
            return new TestableTeam();
        }
        return null;
    }
}