<?php

namespace Superclass\DomainModel\Talent;

use Superclass\DomainModel\City\CityReadDataObject;
use Superclass\DomainModel\Track\TrackReadDataObject;

abstract class TalentQueryAbstract {
    protected $id;
    protected $name;
    protected $userName;
    protected $email;
    protected $phone;
    protected $cityOfOrigin;
    /** @var \Datetime */
    protected $birthDate;
    /** @var CityReadDataObject */
    protected $cityRdo;
    /** @var TrackReadDataObject */
    protected $trackRdo = null;
    
    protected $gender;
    protected $bekupType;
    protected $motivation;
    
    function getId() {
        return $this->id;
    }
    function getName() {
        return $this->name;
    }
    function getUserName() {
        return $this->userName;
    }
    function getEmail() {
        return $this->email;
    }
    function getPhone() {
        return $this->phone;
    }
    function getCityOfOrigin() {
        return $this->cityOfOrigin;
    }
    function getBirthDate() {
        return $this->birthDate->format('Y-m-d');
    }
    /**
     * @return CityReadDataObject
     */
    function cityRdo() {
        return $this->cityRdo;
    }
    /**
     * @return TrackReadDataObject
     */
    function trackRdo() {
        return $this->trackRdo;
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

    protected function __construct($id, $name, $userName, $email, $phone, $cityOfOrigin, 
            \Datetime $birthDate, CityReadDataObject $cityRdo, TrackReadDataObject $trackRdo, 
            $gender, $bekupType, $motivation
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->userName = $userName;
        $this->email = $email;
        $this->phone = $phone;
        $this->cityOfOrigin = $cityOfOrigin;
        $this->birthDate = $birthDate;
        $this->cityRdo = $cityRdo;
        $this->trackRdo = $trackRdo;
        $this->gender = $gender;
        $this->bekupType = $bekupType;
        $this->motivation = $motivation;
    }

    function toArray(){
        $talentQuery = array(
            'id' => $this->getId(),
            'name' => $this->getName(),
            'user_name' => $this->getUserName(),
            'email' => $this->getEmail(),
            'phone' => $this->getPhone(),
            'city_of_origin' => $this->getCityOfOrigin(),
            'birth_date' => $this->getBirthDate(),
            'city' => $this->cityRdo->toArray(),
            'gender' => $this->getGender(),
            'bekup_type' => $this->getBekupType(),
            'motivation' => $this->getMotivation(),
            'track' => null,
        );
        if(!empty($this->trackRdo)){
            $talentQuery['track'] = $this->trackRdo()->toArray();
        }
        return $talentQuery;
    }


}
