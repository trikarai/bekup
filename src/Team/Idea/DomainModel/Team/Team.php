<?php

namespace Team\Idea\DomainModel\Team;

use Resources\ErrorMessage;
use Superclass\DomainModel\Team\TeamAbstract;

use Team\Idea\DomainModel\Idea\DataObject\IdeaWriteDataObject;
use Team\Idea\DomainModel\Idea\DataObject\IdeaReadDataObject;
use Team\Idea\DomainModel\Idea\Idea;
use Team\Idea\DomainModel\Superhero\DataObject\SuperheroReadDataObject;
use Superclass\DomainModel\Team\TeamMemberReadDataObject;
//use Team\Idea\DomainModel\Team\TeamMemberReadDataObject;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;

class Team extends TeamAbstract{
    /** @var ArrayCollection */
    protected $ideas;
    /** @var ArrayCollection */
    protected $teamMemberRdos;
//    protected $members;
    
    /**
     * @param type $id
     * @return IdeaReadDataObject
     */
    function anIdeaRdoOfId($id){
        $idea = $this->_findIdea($id);
        if(empty($idea)){
            return null;
        }
        return $idea->toReadDataObject();
    }
    
    /**
     * @return IdeaReadDataObject[]
     */
    function allIdeaRdo(){
        $criteria = Criteria::create()
                ->where(Criteria::expr()->eq('isRemoved', false));
        $ideaRdos = [];
        foreach($this->ideas->matching($criteria)->toArray() as $idea){
            $ideaRdos[] = $idea->toReadDataObject();
        }
        return $ideaRdos;
    }
    
    protected function __construct() {
        $this->ideas = new ArrayCollection();
        $this->teamMemberRdos = new ArrayCollection();
    }
    
    /**
     * @param type $memberId
     * @param IdeaWriteDataObject $request
     * @param SuperheroReadDataObject $superheroRDO
     * @return true||ErrorMessage
     */
    function proposeIdea($memberId, IdeaWriteDataObject $request, SuperheroReadDataObject $superheroRDO = null
    ){
        $membership = $this->_findMembershipRDO($memberId);
        $msg = true;
        
        if(empty($membership)){
            $msg = ErrorMessage::error403_Forbidden(['forbidden access']);
        }else if(true !== $msg = $this->_isNotDuplicateName($request->getName())){
        }else{
            $id = $this->ideas->count() + 1;
            $idea = new Idea($this, $id, $request, $membership->talentRDO(), $superheroRDO);
            $this->ideas->set($id, $idea);
        }
        return $msg;
    }
    
    /**
     * @param type $memberId
     * @param type $id
     * @param IdeaWriteDataObject $request
     * @return true||ErrorMessage
     */
    function updateIdea($memberId, $id, IdeaWriteDataObject $request){
        $commander = $this->_findMembershipRDO($memberId);
        $idea = $this->_findIdea($id);
        $msg = true;
        
        if(empty($commander)){
            $msg = ErrorMessage::error403_Forbidden(['forbidden access']);
        }else if(empty($idea)){
            $msg = ErrorMessage::error404_NotFound(['idea not found or already removed']);
        }else if($request->getName() !== $idea->getName() &&
                true !== $msg = $this->_isNotDuplicateName($request->getName())){
        }else{
            $idea->update($request);
        }
        return $msg;
    }
    
    /**
     * @param type $memberId
     * @param type $id
     * @return true||ErrorMessage
     */
    function removeIdea($memberId, $id){
        $commander = $this->_findMembershipRDO($memberId);
        $idea = $this->_findIdea($id);
        $msg = true;
        
        if(empty($commander)){
            $msg = ErrorMessage::error403_Forbidden(['forbidden access']);
        }else if(empty($idea)){
            $msg = ErrorMessage::error404_NotFound(['idea not found or already removed']);
        }else{
            $idea->remove();
        }
        return $msg;
    }
    
    /**
     * @param type $id
     * @return Idea
     */
    protected function _findIdea($id){
        $criteria = Criteria::create()
				->where(Criteria::expr()->andX(
                        Criteria::expr()->eq('id', $id),
                        Criteria::expr()->eq('isRemoved', false)
                ));
        return $this->ideas->matching($criteria)->first();
    }
    
    /**
     * @param type $name
     * @return true||ErrorMessage
     */
    protected function _isNotDuplicateName($name){
        $criteria = Criteria::create()
                ->where(Criteria::expr()->andX(
                        Criteria::expr()->eq('name', $name),
                        Criteria::expr()->eq('isRemoved', false)
                ));
        if(0 == $this->ideas->matching($criteria)->count()){
            return true;
        }
        return ErrorMessage::error409_Conflict(["duplicate, idea name: '$name' already used"]);
    }
    
    /**
     * @param type $memberId
     * @return TeamMemberReadDataObject
     */
    protected function _findMembershipRDO($memberId){
        $criteria = Criteria::create()
				->where(Criteria::expr()->andX(
                        Criteria::expr()->eq('id', $memberId),
                        Criteria::expr()->eq('status', "active")
                ));
        return $this->teamMemberRdos->matching($criteria)->first();
    }
}
