<?php

namespace Tests\Talent\WorkingExperience\ApplicationService\WorkingExperience;

use Talent\WorkingExperience\Infrastructure\Persistence\InMemory\Talent\InMemoryTalentRepository;
use Talent\WorkingExperience\DomainModel\Talent\Talent;
use Talent\WorkingExperience\DomainModel\WorkingExperience\WorkingExperience;
use Talent\WorkingExperience\DomainModel\WorkingExperience\DataObject\WorkingExperienceWriteDataObject;

class PreparedInMemoryWorkingExperienceData {
    protected $repository;
    protected $talent;
    protected $convergain;
    protected $barapraja;
    
    /**
     * @return TestableTalent
     */
    function talent(){
        return $this->talent;
    }
    /**
     * @return InMemoryTalentRepository
     */
    function repository(){
        return $this->repository;
    }
    /** @return WorkingExperience */
    function convergain(){
        return $this->convergain;
    }
    /** @return WorkingExperience */
    function barapraja(){
        return $this->barapraja;
    }
    
    public function __construct() {
        $this->repository = new InMemoryTalentRepository();
        $this->talent = new TestableTalent();
        $this->repository->add($this->talent);
        $this->_setConvergain();
        $this->_setBarapraja();
    }
    protected function _setConvergain(){
        $request = WorkingExperienceWriteDataObject::request('convergain', 'magang', 'ngahuleng', '2006', '2010');
        $this->talent->addWorkingExperience($request);
        $this->convergain = $this->talent->lastAddedWorkingExperience();
    }
    protected function _setBarapraja(){
        $request = WorkingExperienceWriteDataObject::request('barapraja', 'programming', 'coding', '2011');
        $this->talent->addWorkingExperience($request);
        $this->barapraja = $this->talent->lastAddedWorkingExperience();
    }
}

use Doctrine\Common\Collections\Criteria;
class TestableTalent extends Talent{
    public function __construct() {
        $this->id = \Ramsey\Uuid\Uuid::uuid4()->toString();
        parent::__construct();
    }
    /**
     * @return WorkingExperience
     */
    function lastAddedWorkingExperience(){
        return $this->workingExperiences->last();
    }
    function getWorkingExperienceCount(){
        $criteria = Criteria::create()
                ->where(Criteria::expr()->eq('isRemoved', false));
        return $this->workingExperiences->matching($criteria)->count();
    }
}
