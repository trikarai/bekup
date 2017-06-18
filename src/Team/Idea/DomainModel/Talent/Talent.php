<?php

namespace Team\Idea\DomainModel\Talent;

use Resources\ErrorMessage;
use Superclass\DomainModel\Talent\TalentAbstract;

use Team\Idea\DomainModel\Superhero\Superhero;
use Team\Idea\DomainModel\Superhero\DataObject\SuperheroWriteDataObject;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;

class Talent extends TalentAbstract {
    /** @var ArrayCollection */
    protected $superheroes;
    
    protected function __construct() {
        $this->superheroes = new ArrayCollection();
    }
    
//MANAGE SUPERHERO
    /**
     * @param SuperheroWriteDataObject $request
     * @return true||ErrorMessage
     */
    function addSuperhero(SuperheroWriteDataObject $request){
        if(true !== $msg = $this->_isNotDuplicateName($request->getName())){
            return $msg;
        }
        $id = \Ramsey\Uuid\Uuid::uuid4()->toString();
        $superhero = new Superhero($id, $request, $this);
        $this->superheroes->set($id, $superhero);
        return true;
    }
    
    /**
     * @param type $superheroId
     * @param SuperheroWriteDataObject $request
     * @return true||ErrorMessage
     */
    function updateSuperhero($superheroId, SuperheroWriteDataObject $request){
        $superhero = $this->_findSuperhero($superheroId);
        if(empty($superhero)){
            return ErrorMessage::error404_NotFound(['superhero not found or already removed']);
        }else if($request->getName() !== $superhero->getName() &&
                true !== $msg = $this->_isNotDuplicateName($request->getName())
        ){
            return $msg;
        }
        $superhero->change($request);
        return true;
    }
    
    /**
     * @param type $superheroId
     * @return true||ErrorMessage
     */
    function removeSuperhero($superheroId){
        $superhero = $this->_findSuperhero($superheroId);
        if(empty($superhero)){
            return ErrorMessage::error404_NotFound(['superhero not found or already removed']);
        }
        $superhero->remove();
        return true;
    }
    
    /**
     * @param integer $id
     * @return Superhero
     */
    protected function _findSuperhero($id){
        $criteria = Criteria::create()
				->where(Criteria::expr()->andX(
                        Criteria::expr()->eq('id', $id),
                        Criteria::expr()->eq('isRemoved', false)
                ));
        $superhero = $this->superheroes->matching($criteria)->first();
        if(empty($superhero)){
            return null;
        }
        return $superhero;
    }
    
    /**
     * @param type $name
     * @return true||ErrorMessage
     */
    protected function _isNotDuplicateName($name){
        $criteria = Criteria::create()
                ->where(Criteria::expr()->andX(
                        Criteria::expr()->eq('isRemoved', false),
                        Criteria::expr()->eq('name', $name)
                ));
        if(0 === $this->superheroes->matching($criteria)->count()){
            return true;
        }
        return ErrorMessage::error409_Conflict(["duplicate, superhero name: '$name', already used"]);
    }
    
}
