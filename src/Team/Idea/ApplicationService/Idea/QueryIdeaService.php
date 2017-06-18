<?php

namespace Team\Idea\ApplicationService\Idea;

use Resources\ErrorMessage;
use Team\Idea\DomainModel\Team\TeamQuery;
use Resources\Exception\DoNotCatchException;

use Team\Profile\DomainModel\Membership\DataObject\TalentMembershipReadDataObject;

class QueryIdeaService {
    protected $repository;
    protected $activeMembershipFinder;
    
            
    public function __construct(
            \Team\Idea\DomainModel\Team\ITeamQueryRepository $teamQueryRepository,
            \Team\Profile\ApplicationService\Talent\ActiveMembershipFinder $activeMembershipFinder
    ) {
        $this->repository = $teamQueryRepository;
        $this->activeMembershipFinder = $activeMembershipFinder;
    }
    
    /**
     * 
     * @param type $talentId
     * @param type $ideaId
     * @return \Team\Idea\ApplicationService\Idea\IdeaQueryResponseObject
     */
    function showIdeaById($talentId, $ideaId){
        $response = new IdeaQueryResponseObject();
        $activeMembershipRdo = $this->_findActiveMembershipRdoOrDie($talentId);
        $teamQuery = $this->_findTeamOrDie($activeMembershipRdo->teamRDO()->getId());
        $rdo = $teamQuery->anIdeaRdoOfId($ideaId);
        
        if(empty($rdo)){
            $response->appendErrorMessage(ErrorMessage::error404_NotFound(['idea not found']));
        }else{
            $response->setReadDataObject($rdo);
        }
        return $response;
    }
    
    /**
     * @param type $talentId
     * @return \Team\Idea\ApplicationService\Idea\IdeaQueryResponseObject
     */
    function showAllIdea($talentId){
        $response = new IdeaQueryResponseObject();
        $activeMembershipRdo = $this->_findActiveMembershipRdoOrDie($talentId);
        $teamQuery = $this->_findTeamOrDie($activeMembershipRdo->teamRDO()->getId());
        
        $rdos = $teamQuery->allIdeaRdos();
        if(empty($rdos)){
            $response->appendErrorMessage(ErrorMessage::error404_NotFound(['no idea found']));
        }else{
            $response->setBulkReadDataObject($rdos);
        }
        return $response;
    }
    
    /**
     * @param type $teamId
     * @return TeamQuery
     * @throws DoNotCatchException
     */
    protected function _findTeamOrDie($teamId){
        $teamQuery = $this->repository->ofId($teamId);
        if(empty($teamQuery)){
            throw new DoNotCatchException("team not found");
        }
        return $teamQuery;
    }
    /**
     * @param type $talentId
     * @return TalentMembershipReadDataObject
     * @throws DoNotCatchException
     */
    protected function _findActiveMembershipRdoOrDie($talentId){
        $activeMembershipRdo = $this->activeMembershipFinder->findActiveMembershipRdo($talentId);
        if(empty($activeMembershipRdo)){
            throw new DoNotCatchException("active team not found");
        }
        return $activeMembershipRdo;
    }
}
