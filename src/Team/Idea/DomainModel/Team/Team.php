<?php

namespace Team\Idea\DomainModel\Team;

use Resources\ErrorMessage;
use Superclass\DomainModel\Team\TeamAbstract;
use Team\Idea\DomainModel\Idea\DataObject\IdeaWriteDataObject;
use Team\Idea\DomainModel\Idea\Idea;
use Team\Idea\DomainModel\Team\TeamMemberRdo;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;

class Team extends TeamAbstract {

    /** @var ArrayCollection */
    protected $ideas;

    /** @var ArrayCollection */
    protected $teamMemberRdos;

    protected function __construct() {
        $this->ideas = new ArrayCollection();
        $this->teamMemberRdos = new ArrayCollection();
    }

    /**
     * @param type $memberId
     * @param IdeaWriteDataObject $request
     * @param type $superheroId
     * @return True||ErrorMessage
     */
    function proposeIdea($memberId, IdeaWriteDataObject $request, $superheroId = null
    ) {
        $membership = $this->_findMembershipRDO($memberId);
        if (empty($membership)) {
            $msg = ErrorMessage::error403_Forbidden(['forbidden access']);
        } else if (true !== $msg = $this->_isNotDuplicateName($request->getName())) {
        } else {
            $id = \Ramsey\Uuid\Uuid::uuid4()->toString();
            $idea = new Idea($id, $request, $membership->talentRDO()->getId(), $this, $superheroId);
            $this->ideas->set($id, $idea);
        }
        return $msg;
    }

    /**
     * @param type $memberId
     * @param type $id
     * @param IdeaWriteDataObject $request
     * @param type $superheroId
     * @return True||ErrorMessage
     */
    function updateIdea($memberId, $id, IdeaWriteDataObject $request, $superheroId = null) {
        $commander = $this->_findMembershipRDO($memberId);
        $idea = $this->_findIdea($id);
        $msg = true;

        if (empty($commander)) {
            $msg = ErrorMessage::error403_Forbidden(['forbidden access']);
        } else if (empty($idea)) {
            $msg = ErrorMessage::error404_NotFound(['idea not found or already removed']);
        } else if ($request->getName() !== $idea->getName() &&
                true !== $msg = $this->_isNotDuplicateName($request->getName())) {
        } else {
            $idea->update($request, $superheroId);
        }
        return $msg;
    }

    /**
     * @param type $memberId
     * @param type $id
     * @return true||ErrorMessage
     */
    function removeIdea($memberId, $id) {
        $commander = $this->_findMembershipRDO($memberId);
        $idea = $this->_findIdea($id);
        $msg = true;

        if (empty($commander)) {
            $msg = ErrorMessage::error403_Forbidden(['forbidden access']);
        } else if (empty($idea)) {
            $msg = ErrorMessage::error404_NotFound(['idea not found or already removed']);
        } else {
            $idea->remove();
        }
        return $msg;
    }

    /**
     * @param type $id
     * @return Idea
     */
    protected function _findIdea($id) {
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
    protected function _isNotDuplicateName($name) {
        $criteria = Criteria::create()
                ->where(Criteria::expr()->andX(
                        Criteria::expr()->eq('name', $name), 
                        Criteria::expr()->eq('isRemoved', false)
                ));
        if (0 == $this->ideas->matching($criteria)->count()) {
            return true;
        }
        return ErrorMessage::error409_Conflict(["duplicate, idea name: '$name' already used"]);
    }

    /**
     * @param type $memberId
     * @return TeamMemberRdo
     */
    protected function _findMembershipRDO($memberId) {
        $criteria = Criteria::create()
                ->where(Criteria::expr()->andX(
                        Criteria::expr()->eq('id', $memberId), 
                        Criteria::expr()->eq('status', "active")
                ));
        return $this->teamMemberRdos->matching($criteria)->first();
    }

}
