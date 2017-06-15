<?php

namespace Tests\Talent\Education\ApplicationService\Education;

use Talent\Education\Infrastructure\Persistence\InMemory\Talent\InMemoryTalentRepository;
use Talent\Education\DomainModel\Talent\Talent;
use Talent\Education\DomainModel\Education\Education;
use Talent\Education\DomainModel\Education\DataObject\EducationWriteDataObject;

use Doctrine\Common\Collections\Criteria;

class PreparedInMemoryEducationData {
    protected $repository;
    protected $talentApur;
    protected $educationSD;
    protected $educationSMP;
    
    function repository(){
        return $this->repository;
    }
    /** @return TestableTalent */
    function talentApur(){
        return $this->talentApur;
    }
    /** @return Education */
    function educationSD(){
        return $this->educationSD;
    }
    /** @return Education */
    function educationSMP(){
        return $this->educationSMP;
    }
    
    public function __construct() {
        $this->repository = new InMemoryTalentRepository();
        $this->talentApur = new TestableTalent();
        $this->repository->add($this->talentApur);
        $this->_setEducationSD();
        $this->_setEducationSMP();
    }
    protected function _setEducationSD(){
        $request = EducationWriteDataObject::addRequest('SD', 'YWKA', '', '', '1990', '1992');
        $this->talentApur->addEducation($request);
//        $this->talentApur->addEducation($request, new \Resources\MessageObject());
        $this->educationSD = $this->talentApur->lastAddedEducation();
    }
    protected function _setEducationSMP(){
        $request = EducationWriteDataObject::addRequest('SMP', 'SMP 9 Bandung', '', '', '1992', '1995');
        $this->talentApur->addEducation($request);
//        $this->talentApur->addEducation($request, new \Resources\MessageObject());
        $this->educationSMP = $this->talentApur->lastAddedEducation();
    }
}

class TestableTalent extends Talent{
    public function __construct() {
        $this->id = \Ramsey\Uuid\Uuid::uuid4()->toString();
        parent::__construct();
    }
    
    /**
     * @return Education
     */
    function lastAddedEducation(){
        return $this->educations->last();
    }
    function getEducationCount(){
        $criteria = Criteria::create()
                ->where(Criteria::expr()->eq('isRemoved', false));
        return $this->educations->matching($criteria)->count();
    }
}
