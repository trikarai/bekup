<?php

namespace Tests\Talent\Skill\ApplicationService\Certificate;

use Tests\Talent\Skill\ApplicationService\Skill\PreparedInMemorySkillData;
use Tests\Talent\Skill\ApplicationService\SkillScore\PreparedInMemorySkillScoreData;

use Talent\Skill\DomainModel\Certificate\Certificate;
use Talent\Skill\DomainModel\Certificate\DataObject\CertificateWriteDataObject;
use Talent\Skill\DomainModel\SkillScore\SkillScore;
use Talent\Skill\DomainModel\Talent\Talent;
use Talent\Skill\DomainModel\SkillScore\ISkillScoreRepository;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;

class PreparedInMemoryCertificateData {
    protected $repository;
    protected $talent;
    protected $skillScore;
    protected $phpCertificate;
    protected $dddCertificate;
    
    /** @return ISkillScoreRepository */
    function repository(){
        return $this->repository;
    }
    /** @return Talent */
    function talent(){
        return $this->talent;
    }
    /** @return TestableSkillScore */
    function skillScore(){
        return $this->skillScore;
    }
    /** @return Certificate */
    function phpCertificate(){
        return $this->phpCertificate;
    }
    /** @return Certificate */
    function dddCertificate(){
        return $this->dddCertificate;
    }
    
    public function __construct() {
        $skillData = new PreparedInMemorySkillData();
        $skillScoreData = new PreparedInMemorySkillScoreData();
        
        $this->talent = $skillScoreData->talent();
        $this->skillScore = new TestableSkillScore(1, 4, $skillData->phpSkill()->toReadDataObject(), $this->talent);
        $this->repository = new TestableSkillScoreRepository();
        $this->repository->add($this->skillScore);
        $this->_setPhpCertificate();
        $this->_setDddCertificate();
    }
    protected function _setPhpCertificate(){
        $request = CertificateWriteDataObject::request('php certificate', 'php.net', 2020);
        $this->skillScore->addCertificate($request);
        $this->phpCertificate = $this->skillScore->lastAddedCertificate();
    }
    protected function _setDddCertificate(){
        $request = CertificateWriteDataObject::request('ddd certificate', 'bdb');
        $this->skillScore->addCertificate($request);
        $this->dddCertificate = $this->skillScore->lastAddedCertificate();
    }
    
    
}

class TestableSkillScore extends SkillScore{
    /**
     * @return Talent
     */
    function talent(){
        return $this->talent;
    }
    function getCountOfCertificate(){
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
}

class TestableSkillScoreRepository implements ISkillScoreRepository{
    protected $skillScores;
    
    public function __construct() {
        $this->skillScores = new ArrayCollection();
    }
    function add(TestableSkillScore $skillScore){
        $id = \Ramsey\Uuid\Uuid::uuid4()->toString();
        $this->skillScores->set($id, $skillScore);
    }
    
    /**
     * @param type $id
     * @param type $talentId
     * @return TestableSkillScore||null
     */
    public function ofId($id, $talentId) {
        foreach($this->_arrayOfSkillScores() as $skillScore){
            if($talentId === $skillScore->talent()->getId() &&
                    $id === $skillScore->getId()
            ){
                return $skillScore;
            }
        }
        return null;
    }
    /**
     * @return TestableSkillScore[]
     */
    protected function _arrayOfSkillScores(){
        $criteria = Criteria::create()
                ->where(Criteria::expr()->eq('isRemoved', false));
        return $this->skillScores->matching($criteria)->toArray();
    }

    public function update() {
        
    }

}

