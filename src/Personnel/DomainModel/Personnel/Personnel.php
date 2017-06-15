<?php

namespace Personnel\DomainModel\Personnel;

use Personnel\DomainModel\Personnel\ValueObject\PersonnelPassword as Password;
use Superclass\DomainModel\City\CityReadDataObject as CityRDO;
use Superclass\DomainModel\Track\TrackReadDataObject as TrackRDO;

use Personnel\DomainModel\Personnel\DataObject\PersonnelWriteDataObject;
use Personnel\DomainModel\Personnel\DataObject\PersonnelReadDataObject;

class Personnel {
    protected $id;
    protected $name;
    protected $email;
    protected $password;
    protected $role;
    protected $cityRDO = null;
    protected $trackRDO = null;
    protected $isRemoved = false;
    
    function getId(){
        return $this->id;
    }
    function getEmail(){
        return $this->email;
    }
    /** @return Password */
    function password(){
        return $this->password;
    }
    function getIsRemoved(){
        return $this->isRemoved;
    }
    /**
     * @return PersonnelReadDataObject
     */
    function toReadDataObject(){
        return new PersonnelReadDataObject($this->id, $this->name, $this->email, 
                $this->role, $this->isRemoved, $this->cityRDO, $this->trackRDO);
    }
    
//CONSTRUCTOR
    
    protected function __construct($id, PersonnelWriteDataObject $request, Password $password, $role, CityRDO $cityRDO = null, TrackRDO $trackRDO = null) {
        $this->id = $id;
        $this->name = $request->getName();
        $this->email = $request->getEmail();
        $this->password = $password;
        $this->role = $role;
        $this->cityRDO = $cityRDO;
        $this->trackRDO = $trackRDO;
    }
    /**
     * @param string $id
     * @param PersonnelWriteDataObject $request
     * @param Password $password
     * @return \static
     */
    static function createDirector($id, PersonnelWriteDataObject $request, Password $password){
        return new static($id, $request, $password, "Director", null, null);
    }
    /**
     * @param string $id
     * @param PersonnelWriteDataObject $request
     * @param Password $password
     * @param TrackRDO $trackRDO
     * @return \static
     */
    static function createTrackCoordinator($id, PersonnelWriteDataObject $request, Password $password, TrackRDO $trackRDO){
        return new static($id, $request, $password, "Track Coordinator", null, $trackRDO);
    }
    /**
     * @param string $id
     * @param PersonnelWriteDataObject $request
     * @param Password $password
     * @param CityRDO $cityRDO
     * @return \static
     */
    static function createRegionCoordinator($id, PersonnelWriteDataObject $request, Password $password, CityRDO $cityRDO){
        return new static($id, $request, $password, "Region Coordinator", $cityRDO, null);
    }
    /**
     * @param string $id
     * @param PersonnelWriteDataObject $request
     * @param Password $password
     * @param CityRDO $cityRDO
     * @param TrackRDO $trackRDO
     * @return \static
     */
    static function createTutor($id, PersonnelWriteDataObject $request, Password $password, CityRDO $cityRDO, TrackRDO $trackRDO){
        return new static($id, $request, $password, "Tutor", $cityRDO, $trackRDO);
    }
    
//MUTATOR
    /**
     * @param PersonnelWriteDataObject $request
     */
    function update(PersonnelWriteDataObject $request){
        $this->name = $request->getName();
        $this->email = $request->getEmail();
    }
    
    function remove(){
        $this->isRemoved = true;
    }
}
