<?php

namespace Team\Profile\ApplicationService\Talent;

use Team\Profile\DomainModel\Talent\Talent;
use Resources\ResponseObject;

class CommandMemberService {
    protected $repository;
    
    public function __construct(\Team\Profile\DomainModel\Talent\ITalentRepository $talentRepository) {
        $this->repository = $talentRepository;
    }
    
    /**
     * @param type $talentId
     * @param type $teamId
     * @param type $memberId
     * @return ResponseObject
     */
    function acceptInvitation($talentId, $teamId, $memberId){
        $response = new ResponseObject();
        $talent = $this->_findTalentOrDie($talentId);
        
        if(true !== $msg = $talent->acceptTeamInvitation($teamId, $memberId)){
            $response->appendErrorMessage($msg);
        }
        return $response;
    }
    
    /**
     * @param type $talentId
     * @param type $teamid
     * @param type $memberid
     * @return ResponseObject
     */
    function rejectInvitation($talentId, $teamId, $memberId){
        $response = new ResponseObject();
        $talent = $this->_findTalentOrDie($talentId);
        if(true !== $msg = $talent->rejectTeamInvitation($teamId, $memberId)){
            $response->appendErrorMessage($msg);
        }
        
        return $response;
        
    }
    
    /**
     * @param type $talentId
     * @return ResponseObject
     */
    function resign($talentId){
        $response = new ResponseObject();
        $talent = $this->_findTalentOrDie($talentId);
        if(true !== $msg = $talent->resign()){
            $response->appendErrorMessage($msg);
        }
        return $response;
    }
    
    /**
     * 
     * @param type $talentId
     * @return Talent
     * @throws \Resources\Exception\DoNotCatchException
     */
    protected function _findTalentOrDie($talentId){
        $talent = $this->repository->ofId($talentId);
        if(empty($talent)){
            throw new \Resources\Exception\DoNotCatchException('talent not found');
        }
        return $talent;
    }
}
