<?php

namespace Tests\Team\Profile\ApplicationService\Talent;

use Tests\City\Profile\ApplicationService\City\PreparedInMemoryCityData;

class PreparedInMemoryTalentData {
    protected $repository;
    protected $bandungRdo;
    protected $apur;
    protected $adi;
    protected $igun;
    protected $tri;
    protected $arief;
    protected $inandar;
    protected $indra;
    
    /** @return TestableTalentRepository */
    function getRepository() {
        return $this->repository;
    }
    function getActiveMembershipFinder(){
        return new \Team\Profile\ApplicationService\Talent\ActiveMembershipFinder($this->repository);
    }
    /** @return TestableTalent */
    function getApur() {
        return $this->apur;
    }
    /** @return TestableTalent */
    function getAdi() {
        return $this->adi;
    }
    /** @return TestableTalent */
    function getIgun() {
        return $this->igun;
    }
    /** @return TestableTalent */
    function getTri() {
        return $this->tri;
    }
    /** @return TestableTalent */
    function getArief() {
        return $this->arief;
    }
    /** @return TestableTalent */
    function getIndra() {
        return $this->indra;
    }
    function getInandar() {
        return $this->inandar;
    }

            
    public function __construct() {
        $this->repository = new TestableTalentRepository();
        $cityData = new PreparedInMemoryCityData();
        $this->bandungRdo = $cityData->bandung()->toReadDataObject();
        $this->jakartaRdo = $cityData->jakarta()->toReadDataObject();
        $this->_setApur();
        $this->_setAdi();
        $this->_setIgun();
        $this->_setTri();
        $this->_setArief();
        $this->_setInandar();
        $this->_setIndra();
    }
    protected function _setApur(){
        $this->apur = new TestableTalent($this->bandungRdo);
        $this->repository->add($this->apur);
    }
    protected function _setAdi(){
        $this->adi = new TestableTalent($this->bandungRdo);
        $this->repository->add($this->adi);
    }
    protected function _setIgun(){
        $this->igun = new TestableTalent($this->bandungRdo);
        $this->repository->add($this->igun);
    }
    protected function _setTri(){
        $this->tri = new TestableTalent($this->bandungRdo);
        $this->repository->add($this->tri);
    }
    protected function _setArief(){
        $this->arief = new TestableTalent($this->bandungRdo);
        $this->repository->add($this->arief);
    }
    protected function _setInandar(){
        $this->inandar = new TestableTalent($this->bandungRdo);
        $this->repository->add($this->inandar);
    }
    protected function _setIndra(){
        $this->indra = new TestableTalent($this->jakartaRdo);
        $this->repository->add($this->indra);
    }
    
}

use Team\Profile\Infrastructure\Persistence\InMemory\Talent\InMemoryTalentRepository;
class TestableTalentRepository extends InMemoryTalentRepository{
    protected $talents;
    function lastAddedTalent(){
        return $this->talents->last();
    }
}