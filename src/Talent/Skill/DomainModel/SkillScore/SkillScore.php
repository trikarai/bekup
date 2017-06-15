<?php

namespace Talent\Skill\DomainModel\SkillScore;

use Resources\ErrorMessage;

use Talent\Skill\DomainModel\SkillScore\DataObject\SkillScoreReadDataObject;
use Talent\Skill\DomainModel\Skill\DataObject\SkillReadDataObject;
use Talent\Skill\DomainModel\Talent\Talent;

use Talent\Skill\DomainModel\Certificate\Certificate;
use Talent\Skill\DomainModel\Certificate\DataObject\CertificateWriteDataObject;
use Talent\Skill\DomainModel\Certificate\DataObject\CertificateReadDataObject;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;

class SkillScore {
    protected $id;
    protected $scoreValue;
    protected $isRemoved = false;
    
    protected $skillRDO;
    protected $talent;
    /**
     * @var ArrayCollection
     */
    protected $certificates;
    
    function getId(){
        return $this->id;
    }
    function getIsRemoved(){
        return $this->isRemoved;
    }
    function getSkillId(){
        return $this->skillRDO->getId();
    }
    /**
     * @return SkillScoreReadDataObject
     */
    function toReadDataObject(){
        return new SkillScoreReadDataObject($this->id, $this->scoreValue, $this->skillRDO);
    }
    
    /**
     * @param type $id
     * @param type $scoreValue
     * @param SkillReadDataObject $skillRDO
     * @param Talent $talent
     */
    public function __construct($id, $scoreValue, SkillReadDataObject $skillRDO, Talent $talent) {
        $this->id = $id;
        $this->scoreValue = $scoreValue;
        $this->skillRDO = $skillRDO;
        $this->talent = $talent;
        $this->certificates = new ArrayCollection();
    }
    
    /**
     * @param type $scoreValue
     */
    function change($scoreValue){
        $this->scoreValue = $scoreValue;
    }
    
    function remove(){
        $this->isRemoved = true;
    }
    
//CERTIFICATE MANAGEMENT
    /**
     * @param type $id
     * @return CertificateReadDataObject
     */
    function aCertificateReadDataObjectOfId($id){
        $certificate = $this->_findCertificate($id);
        if(empty($certificate)){
            return null;
        }
        return $certificate->toReadDataObject();
    }
    /**
     * @return CertificateReadDataObject[]
     */
    function allCertificateReadDataObject(){
        $rdos = [];
        foreach($this->_arrayOfActiveCertificates() as $certificate){
            $rdos[] = $certificate->toReadDataObject();
        }
        return $rdos;
    }
    
    function addCertificate(CertificateWriteDataObject $request){
        $id = $this->certificates->count() + 1;
        $certificate = new Certificate($id, $request, $this);
        $this->certificates->set($id, $certificate);
        return true;
    }
    
    /**
     * 
     * @param type $id
     * @param CertificateWriteDataObject $request
     * @return true||ErrorMessage
     */
    function updateCertificate($id, CertificateWriteDataObject $request){
        $certificate = $this->_findCertificate($id);
        if(empty($certificate)){
            return ErrorMessage::error404_NotFound(['certificate not found or already removed']);
        }
        $certificate->change($request);
        return true;
    }
    
    /**
     * 
     * @param type $id
     * @return true||ErrorMessage
     */
    function removeCertificate($id){
        $certificate = $this->_findCertificate($id);
        if(empty($certificate)){
            return ErrorMessage::error404_NotFound(['certificate not found or already removed']);
        }
        $certificate->remove();
        return true;
    }
    
    /**
     * @param type $id
     * @return Certificate||null
     */
    protected function _findCertificate($id){
        $criteria = Criteria::create()
                ->where(Criteria::expr()->andX(
                        Criteria::expr()->eq('id', $id),
                        Criteria::expr()->eq('isRemoved', false)
                ));
        return $this->certificates->matching($criteria)->first();
    }
    /**
     * @return Certificate[]
     */
    protected function _arrayOfActiveCertificates(){
        $criteria = Criteria::create()
                ->where(Criteria::expr()->eq('isRemoved', false));
        return $this->certificates->matching($criteria)->toArray();
    }
}
