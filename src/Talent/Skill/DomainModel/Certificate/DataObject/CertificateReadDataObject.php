<?php

namespace Talent\Skill\DomainModel\Certificate\DataObject;

use Resources\IReadDataObject;

class CertificateReadDataObject implements IReadDataObject{
    protected $id;
    protected $name;
    protected $organizer;
    protected $validUntil;
    
    function getId() {
        return $this->id;
    }
    function getName() {
        return $this->name;
    }
    function getOrganizer() {
        return $this->organizer;
    }
    function getValidUntil() {
        return $this->validUntil;
    }
    
    function __construct($id, $name, $organizer, $validUntil) {
        $this->id = $id;
        $this->name = $name;
        $this->organizer = $organizer;
        $this->validUntil = $validUntil;
    }

    public function toArray() {
        return array(
            'id' => $this->getId(),
            'name' => $this->getName(),
            'organizer' => $this->getOrganizer(),
            'valid_until' => $this->getValidUntil(),
        );
    }
}
