<?php

namespace Talent\Organizational\DomainModel\Talent;

use Talent\Organizational\DomainModel\Organizational\Organizational;
use Talent\Organizational\DomainModel\Organizational\DataObject\OrganizationalWriteDataObject;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;
use Resources\ErrorMessage;
use Resources\Exception\CatchableException;

class Talent extends \Superclass\DomainModel\Talent\TalentAbstract {
    /**
     * @var ArrayCollection
     */
    protected $organizationals;
    
    protected function __construct() {
        $this->organizationals = new ArrayCollection();
    }
    
    /**
     * @param OrganizationalWriteDataObject $request
     * @return true||ErrorMessage
     */
    function addOrganizationExperience(OrganizationalWriteDataObject $request){
        try{
            $id = \Ramsey\Uuid\Uuid::uuid4()->toString();
            $organizational = new Organizational($id, $request, $this);
            $this->organizationals->set($id, $organizational);
        }catch(\Resources\Exception\CatchableException $ex){
            return ErrorMessage::error400_BadRequest([$ex->getMessage()]);
        }
        return true;
    }
    
    /**
     * @param type $id
     * @param OrganizationalWriteDataObject $request
     * @return true||ErrorMesssage
     */
    function updateOrganizationExperience($id, OrganizationalWriteDataObject $request){
        $organizational = $this->_findOrganizational($id);
        if(empty($organizational)){
            $msg =  ErrorMessage::error404_NotFound(['organizatinoal not found']);
        }else{
            $msg = $organizational->change($request);
        }
        return $msg;
    }
    
    /**
     * @param type $id
     * @return true||ErrorMessage
     */
    function removeOrganizationExperience($id){
        $organizational = $this->_findOrganizational($id);
        if(empty($organizational)){
            return ErrorMessage::error404_NotFound(['organizatinoal not found']);
        }
        $organizational->remove();
        return true;
    }
    
    /**
     * @param type $id
     * @return Organizational||false||null
     */
    protected function _findOrganizational($id){
        $criteria = Criteria::create()
                ->where(Criteria::expr()->andX(
                        Criteria::expr()->eq('id', $id),
                        Criteria::expr()->eq('isRemoved', false)
                ));
        return $this->organizationals->matching($criteria)->first();
    }
    
}
