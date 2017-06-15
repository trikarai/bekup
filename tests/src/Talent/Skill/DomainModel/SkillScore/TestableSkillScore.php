<?php

namespace Tests\Talent\Skill\DomainModel\SkillScore;

use Talent\Skill\DomainModel\SkillScore\SkillScore;
use Talent\Skill\DomainModel\Certificate\Certificate;
use Doctrine\Common\Collections\Criteria;

class TestableSkillScore extends SkillScore{
    public function __construct() {
        $this->certificates = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    function getCountOfCertificates(){
        $criteria = Criteria::create()
                ->where(Criteria::expr()->eq('isRemoved', false));
        return $this->certificates->matching($criteria)->count();
    }
    
    /**
     * @return Certificate
     */
    function lastAddedCertificate(){
        return $this->certificates->last();
    }
    function addManually(Certificate $certificate){
        $this->certificates->set($certificate->getId(), $certificate);
    }
    
}
