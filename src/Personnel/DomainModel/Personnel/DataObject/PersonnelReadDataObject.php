<?php

namespace Personnel\DomainModel\Personnel\DataObject;

use Resources\IReadDataObject;
use Superclass\DomainModel\City\CityReadDataObject as CityRDO;
use Superclass\DomainModel\Track\TrackReadDataObject as TrackRDO;

class PersonnelReadDataObject implements IReadDataObject{
    protected $id;
    protected $name;
    protected $email;
    protected $role;
    protected $cityRDO = null;
    protected $trackRDO = null;
    protected $isRemoved;
    
    function getId() {
        return $this->id;
    }
    function getName() {
        return $this->name;
    }
    function getEmail() {
        return $this->email;
    }
    function getRole() {
        return $this->role;
    }
    function getIsRemoved(){
        return $this->isRemoved;
    }
    /**
     * @return CityRDO||Null
     */
    function cityRDO(){
        return $this->cityRDO;
    }
    /**
     * @return TrackRDO||Null
     */
    function trackRDO(){
        return $this->trackRDO;
    }
    
    function __construct($id, $name, $email, $role, $isRemoved, CityRDO $cityRDO = null, TrackRDO $trackRDO = null) {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->role = $role;
        $this->isRemoved = $isRemoved;
        $this->cityRDO = $cityRDO;
        $this->trackRDO = $trackRDO;
    }

            
    function toArray(){
        $data = array(
            'id' => $this->getId(),
            'name' => $this->getName(),
            'email' => $this->getEmail(),
            'role' => $this->getRole(),
            'is_removed' => $this->getIsRemoved(),
        );
        
        switch ($this->getRole()) {
            case "Track Coordinator":
                $data['track'] = $this->trackRDO()->toArray();
                break;
            case "Region Coordinator":
                $data['city'] = $this->cityRDO()->toArray();
                break;
            case "Tutor":
                $data['city'] = $this->cityRDO()->toArray();
                $data['track'] = $this->trackRDO()->toArray();
                break;
            default:
                break;
        }
        return $data;
    }
}
