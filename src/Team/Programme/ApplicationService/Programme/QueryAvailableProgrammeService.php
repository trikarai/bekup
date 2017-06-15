<?php

namespace Team\Programme\ApplicationService\Programme;

use City\Programme\Description\ApplicationService\Programme\ProgrammeQueryResponseObject as CityProgrammeQueryResponseObject;
use Resources\ErrorMessage;

class QueryAvailableProgrammeService {
    protected $cityQueryRepository;
    protected $activeMembershipFinder;
    
    /**
     * @param \City\Programme\Description\DomainModel\City\ICityQueryRepository $cityQueryRepository
     * @param \Team\Profile\ApplicationService\Talent\ActiveMembershipFinder $activeMembershipFinder
     */
    public function __construct(
            \City\Programme\Description\DomainModel\City\ICityQueryRepository $cityQueryRepository,
            \Team\Profile\ApplicationService\Talent\ActiveMembershipFinder $activeMembershipFinder
    ) {
        $this->cityQueryRepository = $cityQueryRepository;
        $this->activeMembershipFinder = $activeMembershipFinder;
    }
    
    /**
     * @param type $talentId
     * @return ProgrammeQueryResponseObject
     */
    function showAll($talentId){
        $response = new CityProgrammeQueryResponseObject();
        
        $activeMembershipRdo = $this->_findactiveMembershipRdoOrDie($talentId);
        $cityQuery = $this->_findCityQueryOrDie($activeMembershipRdo->teamRDO()->cityRDO()->getId());
        
        $programmeRdos = $cityQuery->allProgrammeRdo();
        if(empty($programmeRdos)){
            $response->appendErrorMessage(ErrorMessage::error404_NotFound(['no city programme found']));
        }else{
            $response->setBulkReadDataObject($programmeRdos);
        }
        return $response;
    }
    /**
     * @param type $talentId
     * @param type $cityProgrammeId
     * @return ProgrammeQueryResponseObject
     */
    function showById($talentId, $cityProgrammeId){
        $response = new CityProgrammeQueryResponseObject();
        
        $activeMembershipRdo = $this->_findactiveMembershipRdoOrDie($talentId);
        $cityQuery = $this->_findCityQueryOrDie($activeMembershipRdo->teamRDO()->cityRDO()->getId());
        
        $programmeRdo = $cityQuery->aProgrammeRdoOfId($cityProgrammeId);
        if(empty($programmeRdo)){
            $response->appendErrorMessage(ErrorMessage::error404_NotFound(['city programme not found']));
        }else{
            $response->setReadDataObject($programmeRdo);
        }
        return $response;
    }
    
    /**
     * @param type $id
     * @return City\Programme\Description\DomainModel\City\CityQuery
     * @throws \Resources\Exception\DoNotCatchException
     */
    protected function _findCityQueryOrDie($id){
        $cityQuery = $this->cityQueryRepository->ofId($id);
        if(empty($cityQuery)){
            throw new \Resources\Exception\DoNotCatchException('city not found');
        }
        return $cityQuery;
    }
    /**
     * @param type $talentId
     * @return Team\Profile\DomainModel\Membership\DataObject\TalentMembershipReadDataObject
     * @throws \Resources\Exception\DoNotCatchException
     */
    protected function _findactiveMembershipRdoOrDie($talentId){
        $activeMembershipRdo = $this->activeMembershipFinder->findActiveMembershipRdo($talentId);
        if(empty($activeMembershipRdo)){
            throw new \Resources\Exception\DoNotCatchException('active team not found');
        }
        return $activeMembershipRdo;
    }
}
