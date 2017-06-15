<?php

namespace Tests\Talent\Training\ApplicationService\Training;

use Talent\Training\DomainModel\Talent\Talent;
use Talent\Training\Infrastructure\Persistence\InMemory\Talent\InMemoryTalentRepository;
use Talent\Training\DomainModel\Training\DataObject\TrainingWriteDataObject;
use Talent\Training\DomainModel\Training\Training;

class PreparedInMemoryTrainingData {
    protected $repository;
    protected $talent;
    protected $phpTraining;
    protected $dddTraining;
    
    /** @return TestableTalentRepository */
    function repository(){
        return $this->repository;
    }
    /** @return TestableTalent */
    function talent(){
        return $this->talent;
    }
    /** @return Training */
    function phpTraining(){
        return $this->phpTraining;
    }
    /** @return Training */
    function dddTraining(){
        return $this->dddTraining;
    }
    
    public function __construct() {
        $this->repository = new TestableTalentRepository();
        $this->talent = new TestableTalent();
        $this->repository->add($this->talent);
        $this->_setPhpTraining();
        $this->_setDddTraining();
    }
    protected function _setPhpTraining(){
        $request = TrainingWriteDataObject::request('php', 'php.net', '2010');
        $this->talent->addTraining($request);
        $this->phpTraining = $this->talent->lastAddedTraining();
    }
    protected function _setDddTraining(){
        $request = TrainingWriteDataObject::request('ddd', 'erich evans', '2015');
        $this->talent->addTraining($request);
        $this->dddTraining = $this->talent->lastAddedTraining();
    }
    
}

use Doctrine\Common\Collections\Criteria;
class TestableTalent extends Talent{
    public function __construct() {
        $this->id = \Ramsey\Uuid\Uuid::uuid4()->toString();
        parent::__construct();
    }
    /**
     * @return Training
     */
    function lastAddedTraining(){
        return $this->trainings->last();
    }
    function getTrainingCount(){
        $criteria = Criteria::create()
                ->where(Criteria::expr()->eq('isRemoved', false));
        return $this->trainings->matching($criteria)->count();
    }
}

class TestableTalentRepository extends InMemoryTalentRepository{
    public function __construct() {
        parent::__construct();
    }
}

