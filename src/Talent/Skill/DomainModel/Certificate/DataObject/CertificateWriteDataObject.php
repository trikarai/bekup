<?php

namespace Talent\Skill\DomainModel\Certificate\DataObject;

class CertificateWriteDataObject {
    protected $name;
    protected $organizer;
    protected $validUntil;
    
    function getName(){
        return $this->name;
    }
    function getOrganizer(){
        return $this->organizer;
    }
    function getValidUntil(){
        return $this->validUntil;
    }
    
    protected function __construct($name, $organizer, $validUntil = null) {
        $this->name = $name;
        $this->organizer = $organizer;
        $this->validUntil = $validUntil;
    }
    
    static function request($name, $organizer, $validUntil = null){
        return new static($name, $organizer, $validUntil);
    }
}
