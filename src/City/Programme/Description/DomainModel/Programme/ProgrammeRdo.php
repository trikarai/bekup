<?php

namespace City\Programme\Description\DomainModel\Programme;

use Resources\IReadDataObject;
use Programme\Description\DomainModel\Programme\ProgrammeRdo as RefereceProgrammeRdo;
use Superclass\DomainModel\City\CityReadDataObject;

class ProgrammeRdo implements IReadDataObject{
    protected $id;
    protected $referenceProgrammeRDO;
    protected $isOffline;
    protected $isRemoved;
    
    protected $cityRdo;
    
    function getId() {
        return $this->id;
    }
    /**
     * @return RefereceProgrammeRdo
     */
    function referenceProgrammeRDO() {
        return $this->referenceProgrammeRDO;
    }
    function getIsOffline() {
        return $this->isOffline;
    }
    function getIsRemoved() {
        return $this->isRemoved;
    }
    /**
     * @return CityReadDataObject
     */
    function cityRdo(){
        return $this->cityRdo;
    }
    
    protected function __construct($id, RefereceProgrammeRdo $referenceProgrammeRDO, $isOffline, $isRemoved, CityReadDataObject $cityRdo) {
        $this->id = $id;
        $this->referenceProgrammeRDO = $referenceProgrammeRDO;
        $this->isOffline = $isOffline;
        $this->isRemoved = $isRemoved;
        $this->cityRdo = $cityRdo;
    }

    public function toArray() {
        return array(
            'id' => $this->getId(),
            'reference_programme' => $this->referenceProgrammeRDO()->toArray(),
            'is_offline' => $this->getIsOffline(),
            'is_removed' => $this->getIsRemoved(),
            'city' => $this->cityRdo()->toArray(),
        );
    }

}
