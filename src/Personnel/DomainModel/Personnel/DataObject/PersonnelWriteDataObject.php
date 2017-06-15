<?php

namespace Personnel\DomainModel\Personnel\DataObject;

class PersonnelWriteDataObject {
    protected $name;
    protected $email;
    protected $password;
    protected $cityId = null;
    protected $trackId = null;
    
    function getName(){
        return $this->name;
    }
    function getEmail(){
        return $this->email;
    }
    function getPassword(){
        return $this->password;
    }
    function getCityId(){
        return $this->cityId;
    }
    function getTrackId(){
        return $this->trackId;
    }
    
    protected function __construct($name, $email, $password, $cityId = null, $trackId = null) {
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->cityId = $cityId;
        $this->trackId = $trackId;
    }
    
    static function asDirectorRequest($name, $email, $password){
        return new static($name, $email, $password, null, null);
    }
    static function asTrackCoordinatorRequest($name, $email, $password, $trackId){
        return new static($name, $email, $password, null, $trackId);
    }
    static function asRegionCoordinatorRequest($name, $email, $password, $cityId){
        return new static($name, $email, $password, $cityId, null);
    }
    static function asTutorRequest($name, $email, $password, $cityId, $trackId){
        return new static($name, $email, $password, $cityId, $trackId);
    }
    
    static function updateRequest($name, $email){
        return new static($name, $email, null, null, null);
    }
}
