<?php

namespace Tests\Programme\Description\ApplicationService\Programme;

use Programme\Description\DomainModel\Programme\Programme;
use Programme\Description\DomainModel\Programme\ProgrammeRdo;
use Programme\Description\DomainModel\Programme\DataObject\ProgrammeWriteDataObject;

class PreparedInMemoryProgrammeData {
    protected $repository;
    protected $programme2017;
    protected $programme2018;
    
    /** @return TestableInMemoryProgrammeRepository */
    function getRepository() {
        return $this->repository;
    }
    /** @return Programme */
    function getProgramme2017() {
        return $this->programme2017;
    }
    /** @return Programme */
    function getProgramme2018() {
        return $this->programme2018;
    }
    function getRdoRepository(){
        return new TestableProgrammeRdoRepository($this->repository);
    }

        
    public function __construct() {
        $this->repository = new TestableInMemoryProgrammeRepository();
        $this->_setProgramme2017();
        $this->_setProgramme2018();
    }
    protected function _setProgramme2017(){
        $request = ProgrammeWriteDataObject::request('programme 2017', '2017-01-01', '2017-01-31', '2017-02-01', '2017-12-31');
        $this->programme2017 = new TestableProgramme($this->repository->nextIdentity(), $request);
        $this->repository->add($this->programme2017);
    }
    protected function _setProgramme2018(){
        $request = ProgrammeWriteDataObject::request('programme 2018', '2018-01-01', '2018-01-31', '2018-02-01', '2018-12-31');
        $this->programme2018 = new TestableProgramme($this->repository->nextIdentity(), $request);
        $this->repository->add($this->programme2018);
    }
}

class TestableProgramme extends Programme{
    public function __construct($id, ProgrammeWriteDataObject $request) {
        parent::__construct($id, $request);
    }
    function toRdo(){
        return new TestableProgrammeRdo(
                $this->id, 
                $this->name, 
                $this->registrationDateRange->getStartDate()->format('Y-m-d'), 
                $this->registrationDateRange->getEndDate()->format('Y-m-d'), 
                $this->operationDateRange->getStartDate()->format('Y-m-d'), 
                $this->operationDateRange->getEndDate()->format('Y-m-d'), 
                $this->isRemoved);
    }
}

class TestableProgrammeRdo extends ProgrammeRdo{
    public function __construct($id, $name, $registrationStartDate, $registrationEndDate, $operationStartDate, $operationEndDate, $isRemoved) {
        parent::__construct($id, $name, $registrationStartDate, $registrationEndDate, $operationStartDate, $operationEndDate, $isRemoved);
    }
}
use Programme\Description\Infrastructure\Persistence\InMemory\InMemoryProgrammeRepository;
use Doctrine\Common\Collections\Criteria;

class TestableInMemoryProgrammeRepository extends InMemoryProgrammeRepository{
    function getCountOfProgramme(){
        $criteria = Criteria::create()
                ->where(Criteria::expr()->eq('isRemoved', false));
        return $this->programmes->matching($criteria)->count();
    }
    /**
     * @return Programme
     */
    function lastInsertedProgramme(){
        return $this->programmes->last();
    }
    function getKey(){
        return $this->programmes->getKeys();
    }
}

use Programme\Description\DomainModel\Programme\IProgrammeRdoRepository;

class TestableProgrammeRdoRepository implements IProgrammeRdoRepository{
    protected $programmeRepository;
    
    public function __construct(TestableInMemoryProgrammeRepository $programmeRepository) {
        $this->programmeRepository = $programmeRepository;
    }

    public function all() {
        $programmeRdos = [];
        foreach($this->programmeRepository->All() as $programme){
            $programmeRdos[] = $programme->toRdo();
        }
        return $programmeRdos;
    }

    public function ofId($id) {
        $programme = $this->programmeRepository->ofId($id);
        if(empty($programme)){
            return null;
        }
        return $programme->toRdo();
    }

}

