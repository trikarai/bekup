<?php

namespace Superclass\DomainModel\Talent;

use Resources\IReadDataObject;
use Superclass\DomainModel\City\CityReadDataObject;
use Superclass\DomainModel\Track\TrackReadDataObject;

class TalentReadDataObject implements IReadDataObject{
    protected $id;
    protected $name;
    protected $userName;
    protected $email;
    protected $phone;
    protected $cityOfOrigin;
    /** @var \dateTime */
    protected $birthDate;
    protected $cityRDO;
    protected $trackRDO;
    
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
    function cityRDO(){
        return $this->cityRDO;
    }
    function getCityId(){
        return $this->cityRDO->getId();
    }
    
    /**
     * @return TrackReadDataObject
     */
    function trackRDO(){
        return $this->trackRDO;
    }
    
    function __construct($id, $name, $userName, $email, $phone, $cityOfOrigin, 
            \DateTime $birthDate, CityReadDataObject $cityRDO, TrackReadDataObject $trackRDO
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->userName = $userName;
        $this->email = $email;
        $this->phone = $phone;
        $this->cityOfOrigin = $cityOfOrigin;
        $this->birthDate = $birthDate;
        $this->cityRDO = $cityRDO;
        $this->trackRDO = $trackRDO;
    }

    
    function toArray(){
        return array(
            'id' => $this->getId(),
            'name' => $this->getName(),
            'user_name' => $this->getUserName(),
            'email' => $this->getEmail(),
            'phone' => $this->getPhone(),
            'city_of_origin' => $this->getCityOfOrigin(),
            'birth_date' => $this->getBirthDate(),
            'city' => $this->cityRDO()->toArray(),
            'track' => $this->trackRDO()->toArray(),
        );
    }
}
