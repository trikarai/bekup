<?php

namespace City\Programme\Description\DomainModel\City;

use Superclass\DomainModel\City\CityAbstract;
use Resources\ErrorMessage;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;

use City\Programme\Description\DomainModel\Programme\Programme;
use Programme\Description\DomainModel\Programme\DataObject\ProgrammeReadDataObject as ReferenceProgrammeRDO;
use City\Programme\Description\DomainModel\Programme\DataObject\ProgrammeReadDataObject as ProgrammeRDO;

class City extends CityAbstract{
    protected $programmes;
    
    protected function __construct() {
        $this->programmes = new ArrayCollection();
    }
    
    /**
     * @param type $referenceProgrammeId
     * @param type $isOffline
     * @return true||ErrorMessage
     */
    function addProgramme($referenceProgrammeId, $isOffline = false){
        if(!$this->_isReferenceProgrammeNotUsed($referenceProgrammeId)){
            $message = "programme reference already used";
            return ErrorMessage::error409_Conflict([$message]);
        }
        $id = \Ramsey\Uuid\Uuid::uuid4()->toString();
        $programme = new Programme($this, $id, $referenceProgrammeId, $isOffline);
        $this->programmes->set($id, $programme);
        return true;
    }
    /**
     * 
     * @param type $id
     * @param type $isOffline
     * @return true||ErrorMessage
     */
    function updateProgramme($id, $isOffline = false){
        $programme = $this->_findProgramme($id);
        if(empty($programme)){
            return ErrorMessage::error404_NotFound(['programme not found']);
        }
        switch ($isOffline) {
            case true:
                $programme->setOffline();
                break;
            case false:
                $programme->setOnline();
                break;
        }
        return true;
    }
    /**
     * @param type $id
     * @return true||ErrorMessage
     */
    function removeProgramme($id){
        $programme = $this->_findProgramme($id);
        if(empty($programme)){
            return ErrorMessage::error404_NotFound(['programme not found']);
        }
        $programme->remove();
        return true;
    }
    
    function _isReferenceProgrammeNotUsed($referenceProgrammeId){
        $criteria = Criteria::create()
                ->where(Criteria::expr()->andX(
                        Criteria::expr()->eq('referenceProgrammeId', $referenceProgrammeId),
                        Criteria::expr()->eq('isRemoved', false)
                ));
        if(0 === $this->programmes->matching($criteria)->count()){
            return true;
        }
        return false;
    }
    /**
     * @param type $id
     * @return Programme
     */
    function _findProgramme($id){
        $criteria = Criteria::create()
                ->where(Criteria::expr()->andX(
                        Criteria::expr()->eq('id', $id),
                        Criteria::expr()->eq('isRemoved', false)
                ));
        return $this->programmes->matching($criteria)->first();
    }
}
