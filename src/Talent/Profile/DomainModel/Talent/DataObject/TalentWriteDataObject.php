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
    protected $trackId = null;
    
    protected $gender;
    protected $bekupType;
    protected $motivation;

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
    function getGender() {
        return $this->gender;
    }
    function getBekupType() {
        return $this->bekupType;
    }
    function getMotivation() {
        return $this->motivation;
    }

        
    protected function __construct($name, $userName, $email, $password, $phone, $cityOfOrigin, $birthDate, $cityId, $gender, $bekupType, $motivation, $trackId = null) {
        $this->name = $name;
        $this->userName = $userName;
        $this->email = $email;
        $this->password = $password;
        $this->phone = $phone;
        $this->cityOfOrigin = $cityOfOrigin;
        $this->birthDate = $birthDate;
        $this->cityId = $cityId;
        $this->trackId = $trackId;
        $this->gender = $gender;
        $this->bekupType = $bekupType;
        $this->motivation = $motivation;
    }

        
    static function signUpRequest($name, $userName, $email, $password, $phone, $cityOfOrigin, $birthDate, $cityId, $gender, $bekupType, $motivation, $trackId = null){
        return new static($name, $userName, $email, $password, $phone, $cityOfOrigin, $birthDate, $cityId, $gender, $bekupType, $motivation, $trackId);
    }
    
    static function updateRequest($name, $email, $phone, $cityOfOrigin, $birthDate, $gender, $bekupType, $motivation){
        return new static($name, null, $email, null, $phone, $cityOfOrigin, $birthDate, null, $gender, $bekupType, $motivation, null);
    }
}
