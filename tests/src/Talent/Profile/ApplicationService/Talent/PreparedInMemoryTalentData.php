<?php

namespace Tests\Talent\Profile\ApplicationService\Talent;

use Tests\City\Profile\ApplicationService\City\PreparedInMemoryCityData;
use Tests\Track\Definition\ApplicationService\Track\PreparedInMemoryTrackData;

use Talent\Profile\Infrastructure\Persistence\InMemory\Talent\InMemoryTalentRepository;
use Talent\Profile\DomainModel\Talent\Talent;
use Talent\Profile\DomainModel\Talent\ValueObject\TalentPassword;
use Talent\Profile\DomainModel\Talent\DataObject\TalentWriteDataObject;

class PreparedInMemoryTalentData {
    protected $repository;
    protected $rdoRepository;
    protected $apur;
    protected $igun;
    
    protected $cityData;
    protected $trackData;
    
    /**
     * @return TestableTalentRepository
     */
    function repository(){
        return $this->repository;
    }
    /** @return TestableTalentRdoRepository */
    function rdoRepository(){
        return $this->rdoRepository;
    }
    /** @return Talent */
    function talentApur(){
        return $this->apur;
    }
    /** @return Talent */
    function talentIgun(){
        return $this->igun;
    }
    
    public function __construct() {
        $this->cityData = new PreparedInMemoryCityData();
        $this->trackData = new PreparedInMemoryTrackData();
        
        $this->repository = new TestableTalentRepository();
        $this->_setApur();
        $this->_setIgun();
        $this->rdoRepository = new TestableTalentRdoRepository($this->repository);
    }
    protected function _setApur(){
        $id = \Ramsey\Uuid\Uuid::uuid4()->toString();
        $cityRDO = $this->cityData->bandung()->toReadDataObject();
        $trackRDO = $this->trackData->teknis()->toReadDataObject();
        $request = TalentWriteDataObject::signUpRequest('adi', 'apur', 'adi@email.org', '123', 
                '12345', 'cimahi', '1980-09-08',$cityRDO->getId(), $trackRDO->getId());
        $this->apur = new TestableTalent($id, $request, $cityRDO, $trackRDO);
        $this->repository->add($this->apur);
    }
    protected function _setIgun(){
        $id = \Ramsey\Uuid\Uuid::uuid4()->toString();
        $cityRDO = $this->cityData->jakarta()->toReadDataObject();
        $trackRDO = $this->trackData->bisnis()->toReadDataObject();
        $request = TalentWriteDataObject::signUpRequest('inandar', 'igun', 'inandar@email.org', 'abc', 
                '12345678', 'jakarta', '1978-09-08',$cityRDO->getId(), $trackRDO->getId());
        $this->igun = new TestableTalent($id, $request, $cityRDO, $trackRDO);
        $this->repository->add($this->igun);
    }
}

class TestableTalent extends Talent{
    function getCityId(){
        return $this->cityRDO->getId();
    }
}

use Doctrine\Common\Collections\Criteria;
class TestableTalentRepository extends InMemoryTalentRepository{
    /**
     * @return Talent
     */
    function lastInsertedTalent(){
        return $this->talents->last();
    }
    /**
     * @return TestableTalent[]
     */
    function all(){
        return $this->talents->toArray();
    }
    
    /**
     * @param type $cityId
     * @return TestableTalent[]
     */
    function ofCity($cityId){
        $criteria = Criteria::create()
                ->where(Criteria::expr()->eq('cityId', $cityId));
        return $this->talents->matching($criteria)->toArray();
    }
}

use Superclass\DomainModel\Talent\ITalentRdoRepository;

class TestableTalentRdoRepository implements ITalentRdoRepository{
    protected $repository;
    public function __construct(TestableTalentRepository $repository) {
        $this->repository = $repository;
    }
    
    public function all() {
        $talents = $this->repository->all();
        $talentRdos = [];
        foreach($talents as $talent){
            $talentRdos[] = $talent->toReadDataObject();
        }
        return $talentRdos;
    }

    public function ofCity($cityId) {
        $talents = $this->repository->ofCity($cityId);
        $talentRdos = [];
        foreach($talents as $talent){
            $talentRdos[] = $talent->toReadDataObject();
        }
        return $talentRdos;
    }

    public function ofId($id) {
        $talent = $this->repository->ofId($id);
        if(empty($talent)){
            return null;
        }
        return $talent->toReadDataObject();
    }

}

