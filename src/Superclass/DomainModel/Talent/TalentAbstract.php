<?php

namespace Superclass\DomainModel\Talent;
use Superclass\DomainModel\City\CityReadDataObject;

abstract class TalentAbstract {
    protected $id;
    protected $name;
    protected $userName;
    protected $email;
    protected $phone;
    protected $cityOfOrigin;
    
    protected $birthDate;
    protected $cityRDO;
    protected $trackRDO;
    
    function getId(){
        return $this->id;
    }
    function getUserName(){
        return $this->userName;
    }
    function getEmail(){
        return $this->email;
    }
    /**
     * @return CityReadDataObject
     */
    function cityRdo(){
        return $this->cityRDO;
    }
    
    /**
     * @return \Superclass\DomainModel\Talent\TalentReadDataObject
     */
    function toReadDataObject(){
        return new TalentReadDataObject($this->id, $this->name, $this->userName, $this->email, $this->phone, $this->cityOfOrigin, $this->birthDate, $this->cityRDO, $this->trackRDO);
    }
}
