<?php

namespace Talent\Profile\DomainModel\Talent\DataObject;

class TalentWriteDataObject {
    protected $name;
    protected $userName;
    protected $email;
    protected $password;
    protected $phone;
    protected $cityOfOrigin;
    protected $birthDate;
    protected $cityId;
    protected $trackId;

    function getName(){
        return $this->name;
    }
    function getUserName(){
        return $this->userName;
    }
    function getEmail(){
        return $this->email;
    }
    function getPassword(){
        return $this->password;
    }
    function getPhone(){
        return $this->phone;
    }
    function getCityOfOrigin(){
        return $this->cityOfOrigin;
    }
    function getBirthDate(){
        return $this->birthDate;
    }
    function getCityId() {
        return $this->cityId;
    }

    function getTrackId() {
        return $this->trackId;
    }
    
    function __construct($name, $userName, $email, $password, $phone, $cityOfOrigin, $birthDate, $cityId, $trackId) {
        $this->name = $name;
        $this->userName = $userName;
        $this->email = $email;
        $this->password = $password;
        $this->phone = $phone;
        $this->cityOfOrigin = $cityOfOrigin;
        $this->birthDate = $birthDate;
        $this->cityId = $cityId;
        $this->trackId = $trackId;
    }

    
    static function signUpRequest($name, $userName, $email, $password, $phone, $cityOfOrigin, $birthDate, $cityId, $trackId){
        return new static($name, $userName, $email, $password, $phone, $cityOfOrigin, $birthDate, $cityId, $trackId);
    }
    
    static function updateRequest($name, $email, $phone, $cityOfOrigin, $birthDate){
        return new static($name, null, $email, null, $phone, $cityOfOrigin, $birthDate, null, null);
    }
}
