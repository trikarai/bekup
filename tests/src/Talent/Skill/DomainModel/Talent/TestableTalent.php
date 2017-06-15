<?php

namespace Tests\Talent\Skill\DomainModel\Talent;

use Talent\Skill\DomainModel\Talent\Talent;
use Talent\Skill\DomainModel\SkillScore\SkillScore;

use Doctrine\Common\Collections\Criteria;

class TestableTalent extends Talent{
    public function __construct() {
        parent::__construct();
    }
    
    /**
     * @return SkillScore
     */
    function lastAddedSkillScore(){
        return $this->skillScores->last();
    }
    function getCountOfSkillScore(){
        $criteria = Criteria::create()
                ->where(Criteria::expr()->eq('isRemoved', false));
        return $this->skillScores->matching($criteria)->count();
    }
    function addManually(SkillScore $skillScore){
        $this->skillScores->set($skillScore->getId(), $skillScore);
    }
    
}
