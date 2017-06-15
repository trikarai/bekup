<?php

namespace Talent\Skill\DomainModel\Certificate;

use Talent\Skill\DomainModel\SkillScore\SkillScore;
use Talent\Skill\DomainModel\Certificate\DataObject\CertificateWriteDataObject;

class Certificate {
    protected $id;
    protected $name;
    protected $organizer;
    protected $validUntil;
    protected $isRemoved = false;
    
    protected $skillScore;
    
    function getId(){
        return $this->id;
    }
    function getIsRemoved(){
        return $this->isRemoved;
    }
    /**
     * @return \Talent\Skill\DomainModel\Certificate\DataObject\CertificateReadDataObject
     */
    function toReadDataObject(){
        return new DataObject\CertificateReadDataObject($this->id, $this->name, $this->organizer, $this->validUntil);
    }
    
    public function __construct($id, CertificateWriteDataObject $request, SkillScore $skillScore) {
        $this->id = $id;
        $this->name = $request->getName();
        $this->organizer = $request->getOrganizer();
        $this->validUntil = $request->getValidUntil();
        $this->skillScore = $skillScore;
    }
    
    function change(CertificateWriteDataObject $request){
        $this->name = $request->getName();
        $this->organizer = $request->getOrganizer();
        $this->validUntil = $request->getValidUntil();
    }
    function remove(){
        $this->isRemoved = true;
    }
    
}
