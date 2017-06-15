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
        $activeMembershipRdo = $this->activeMembershipFinder->findActiveMembershipRdo($talentId);
        
        if(empty($activeMembershipRdo)){
            $response->appendErrorMessage(ErrorMessage::error404_NotFound(['active team not found']));
        }else if(!($team = $this->teamRepository->ofId($activeMembershipRdo->teamRDO()->getId()))){
            $response->appendErrorMessage(ErrorMessage::error404_NotFound(['team not found']));
        }else if(!($cityProgrammeRdo = $this->_findCityProgrammeRdo($activeMembershipRdo->teamRDO()->cityRDO()->getId(), $cityProgrammeId))){
            $response->appendErrorMessage(ErrorMessage::error404_NotFound(['city programme not found']));
        }else if(true !== $msg = $team->applyProgramme($activeMembershipRdo->getId(), $cityProgrammeRdo)){
            $response->appendErrorMessage($msg);
        }else{
            $this->teamRepository->update();
        }
        return $response;
    }
    
    /**
     * @param type $cityId
     * @param type $cityProgrammeId
     * @return \City\Programme\Description\DomainModel\Programme\ProgrammeRdo||false
     */
    protected function _findCityProgrammeRdo($cityId, $cityProgrammeId){
        $cityQuery = $this->cityQueryRepository->ofId($cityId);
        if(empty($cityQuery)){
            return false;
        }
        $cityProgrammeRdo = $cityQuery->aProgrammeRdoOfId($cityProgrammeId);
        if(empty($cityProgrammeRdo)){
            return false;
        }
        return $cityProgrammeRdo;
    }
}
