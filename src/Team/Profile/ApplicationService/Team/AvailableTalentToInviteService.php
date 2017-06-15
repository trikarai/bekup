<?php

namespace Team\Profile\ApplicationService\Team;

use Talent\Profile\ApplicationService\Talent\TalentQueryResponseObject;
use Resources\ErrorMessage;

class AvailableTalentToInviteService {
    protected $talentRepository;
    
    public function __construct(\Team\Profile\DomainModel\Talent\ITalentRepository $talentRepository) {
        $this->talentRepository = $talentRepository;
    }
    
    /**
     * @param type $commanderId
     * @return TalentQueryResponseObject
     */
    function execute($commanderId, $offset, $limit){
        $response = new TalentQueryResponseObject();
        $activeMembership = $this->_findActiveMembershipRdoOrDie($commanderId);
        $talents = $this->talentRepository->availableTalentToInvite($activeMembership->teamRDO(), $offset, $limit);
        if(empty($talents)){
            $response->appendErrorMessage(ErrorMessage::error404_NotFound(['no available talent to invite dfound']));
        }else{
            foreach($talents as $talent){
                $response->setReadDataObject($talent->toReadDataObject());
            }
        }
        return $response;
    }
    
    protected function _findActiveMembershipRdoOrDie($talentId){
        $talent = $this->talentRepository->ofId($talentId);
        if(empty($talent)){
            throw new \Resources\Exception\DoNotCatchException('talent not found');
        }
        $activeMembershipRdo = $talent->anActiveMembershipRDO();
        if(empty($activeMembershipRdo)){
            throw new \Resources\Exception\DoNotCatchException('active team not found');
        }
        return $activeMembershipRdo;
    }
}
