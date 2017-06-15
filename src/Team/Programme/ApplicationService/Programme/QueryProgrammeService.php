<?php

namespace Team\Programme\ApplicationService\Programme;

use Resources\ErrorMessage;

class QueryProgrammeService {
    protected $repository;
    protected $activeMembershipFinder;
    
    /**
     * @param \Team\Programme\DomainModel\Team\ITeamQueryRepository $teamQueryRepository
     * @param \Team\Profile\ApplicationService\Talent\ActiveMembershipFinder $activeMembershipFinder
     */
    public function __construct(
            \Team\Programme\DomainModel\Team\ITeamQueryRepository $teamQueryRepository,
            \Team\Profile\ApplicationService\Talent\ActiveMembershipFinder $activeMembershipFinder
    ) {
        $this->repository = $teamQueryRepository;
        $this->activeMembershipFinder = $activeMembershipFinder;
    }
    
    /**
     * @param type $talentId
     * @return \Team\Programme\ApplicationService\Programme\ProgrammeQueryResponseObject
     */
    function showActiveProgramme($talentId){
        $response = new ProgrammeQueryResponseObject();
        $activeMembershipRdo = $this->_findActiveMembershipRdoOrDie($talentId);
        $teamQuery = $this->_findTeamQueryOrDie($activeMembershipRdo->teamRDO()->getId());
        $programmeRdo = $teamQuery->anActiveProgrammeRdo();
        if(empty($programmeRdo)){
            $response->appendErrorMessage(ErrorMessage::error404_NotFound(['active programme not found']));
        }else{
            $response->setReadDataObject($programmeRdo);
        }
        return $response;
    }
    
    /**
     * @param type $talentId
     * @return \Team\Programme\ApplicationService\Programme\ProgrammeQueryResponseObject
     */
    function showAll($talentId){
        $response = new ProgrammeQueryResponseObject();
        $activeMembershipRdo = $this->_findActiveMembershipRdoOrDie($talentId);
        $teamQuery = $this->_findTeamQueryOrDie($activeMembershipRdo->teamRDO()->getId());
        
        $programmeRdos = $teamQuery->allProgrammeRdo();
        if(empty($programmeRdos)){
            $response->appendErrorMessage(ErrorMessage::error404_NotFound(['no Programme Found']));
        }else{
            $response->setBulkReadDataObject($programmeRdos);
        }
        return $response;
    }
    
    /**
     * @param type $talentId
     * @param type $programmeId
     * @return \Team\Programme\ApplicationService\Programme\ProgrammeQueryResponseObject
     */
    function showById($talentId, $programmeId){
        $response = new ProgrammeQueryResponseObject();
        $activeMembershipRdo = $this->_findActiveMembershipRdoOrDie($talentId);
        $teamQuery = $this->_findTeamQueryOrDie($activeMembershipRdo->teamRDO()->getId());
        
        $programmeRdo = $teamQuery->aProgrammeRdoOfId($programmeId);
        if(empty($programmeRdo)){
            $response->appendErrorMessage(ErrorMessage::error404_NotFound(['Programme not Found']));
        }else{
            $response->setReadDataObject($programmeRdo);
        }
        return $response;
    }
    
    /**
     * @param type $talentId
     * @return \Team\Profile\DomainModel\Membership\DataObject\TalentMembershipReadDataObject
     * @throws \Resources\Exception\DoNotCatchException
     */
    function _findActiveMembershipRdoOrDie($talentId){
        $activeMembershipRdo = $this->activeMembershipFinder->findActiveMembershipRdo($talentId);
        if(empty($activeMembershipRdo)){
            throw new \Resources\Exception\DoNotCatchException('active team not found');
        }
        return $activeMembershipRdo;
    }
    /**
     * @param type $id
     * @return \Team\Programme\DomainModel\Team\TeamQuery
     * @throws \Resources\Exception\DoNotCatchException
     */
    function _findTeamQueryOrDie($id){
        $team = $this->repository->ofId($id);
        if(empty($team)){
            throw new \Resources\Exception\DoNotCatchException('team not found');
        }
        return $team;
    }
}
