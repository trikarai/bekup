<?php

namespace Team\Programme\ApplicationService\Programme;

use Resources\ResponseObject;
use Resources\ErrorMessage;
use Team\Programme\DomainModel\Team\Team;
use Team\Profile\DomainModel\Membership\DataObject\TalentMembershipReadDataObject;
use City\Programme\Description\DomainModel\City\CityQuery;

class ApplyProgrammeService {
    protected $teamRepository;
    protected $cityQueryRepository;
    protected $activeMembershipFinder;
    
    /**
     * @param \Team\Programme\DomainModel\Team\ITeamRepository $teamRepository
     * @param \City\Programme\Description\DomainModel\City\ICityQueryRepository $cityQueryRepository
     * @param \Team\Profile\ApplicationService\Talent\ActiveMembershipFinder $activeMemberhipFinder
     */
    public function __construct(
            \Team\Programme\DomainModel\Team\ITeamRepository $teamRepository,
            \City\Programme\Description\DomainModel\City\ICityQueryRepository $cityQueryRepository,
            \Team\Profile\ApplicationService\Talent\ActiveMembershipFinder $activeMemberhipFinder
    ) {
        $this->teamRepository = $teamRepository;
        $this->cityQueryRepository = $cityQueryRepository;
        $this->activeMembershipFinder = $activeMemberhipFinder;
    }
    
    /**
     * @param type $talentId
     * @param type $cityProgrammeId
     * @return ResponseObject
     */
    function execute($talentId, $cityProgrammeId){
        $response = new ResponseObject();
        $activeMembershipRdo = $this->_findActiveMembershipRdoOrDie($talentId);
        $cityQuery = $this->_findCityQueryOrDie($activeMembershipRdo->teamRDO()->cityRDO()->getId());
        $team = $this->_findTeamOrDie($activeMembershipRdo->teamRDO()->getId());
        
        $cityProgrammeRdo = $cityQuery->aProgrammeRdoOfId($cityProgrammeId);
        if(empty($cityProgrammeRdo)){
            $response->appendErrorMessage(ErrorMessage::error404_NotFound(['city programme not found']));
        }else if(true !== $msg = $team->applyProgramme($cityProgrammeRdo)){
            $response->appendErrorMessage($msg);
        }else{
            $this->teamRepository->update();
        }
        return $response;
    }
    
    /**
     * @param type $talentId
     * @return TalentMembershipReadDataObject
     */
    protected function _findActiveMembershipRdoOrDie($talentId){
        $membershipRdo = $this->activeMembershipFinder->findActiveMembershipRdo($talentId);
        if(empty($memberhshipRdo)){
            throw new \Resources\Exception\DoNotCatchException('active team not found');
        }
        return $membershipRdo;
    }
    /**
     * 
     * @param type $cityId
     * @param type $cityProgrammeId
     * @return CityQuery
     * @throws \Resources\Exception\DoNotCatchException
     */
    protected function _findCityQueryOrDie($cityId, $cityProgrammeId){
        $cityQuery = $this->cityQueryRepository->ofId($cityId);
        if(empty($cityQuery)){
            throw new \Resources\Exception\DoNotCatchException('city not found');
        }
        return $cityQuery;
    }
    /**
     * 
     * @param type $teamId
     * @return Team
     * @throws \Resources\Exception\DoNotCatchException
     */
    protected function _findTeamOrDie($teamId){
        $team = $this->teamRepository->ofId($teamId);
        if(empty($team)){
            throw new \Resources\Exception\DoNotCatchException('team not found');
        }
        return $team;
    }
}
