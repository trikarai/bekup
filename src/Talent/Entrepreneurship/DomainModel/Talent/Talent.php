<?php

namespace Talent\Entrepreneurship\DomainModel\Talent;

use Talent\Entrepreneurship\DomainModel\Entrepreneurship\Entrepreneurship;
use Talent\Entrepreneurship\DomainModel\Entrepreneurship\DataObject\EntrepreneurshipWriteDataObject;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;
use Resources\ErrorMessage;

class Talent extends \Superclass\DomainModel\Talent\TalentAbstract{
    /**
     * @var ArrayCollection
     */
    protected $entrepreneurships;
    
    protected function __construct() {
        $this->entrepreneurships = new ArrayCollection();
    }
    
    function addEntrepreneushipExperience(EntrepreneurshipWriteDataObject $request){
        try{
            $id = \Ramsey\Uuid\Uuid::uuid4()->toString();
            $entrepreneurship = new Entrepreneurship($id, $request, $this);
            $this->entrepreneurships->set($id, $entrepreneurship);
            
        }catch(\Resources\Exception\CatchableException $ex){
            return ErrorMessage::error400_BadRequest([$ex->getMessage()]);
        }
        return true;
    }
    
    function updateEntrepreneushipExperience($id, EntrepreneurshipWriteDataObject $request){
        $entrepreneurship = $this->_findEntrepreneurship($id);
        if(empty($entrepreneurship)){
            $msg = ErrorMessage::error404_NotFound(['entrepreneurhsip not found']);
        }else {
            $msg = $entrepreneurship->change($request);
        }
        return $msg;
    }
    
    function removeEntrepreneushipExperience($id){
        $entrepreneurship = $this->_findEntrepreneurship($id);
        if(empty($entrepreneurship)){
            return ErrorMessage::error404_NotFound(['entrepreneurhsip not found']);
        }
        $entrepreneurship->remove();
        return true;
        
    }
    
    /**
     * @param type $id
     * @return false||null||Entrepreneurship
     */
    protected function _findEntrepreneurship($id){
        $criteria = Criteria::create()
                ->where(Criteria::expr()->andX(
                        Criteria::expr()->eq('id', $id),
                        Criteria::expr()->eq('isRemoved', false)
                ));
        return $this->entrepreneurships->matching($criteria)->first();
    }
    
}
