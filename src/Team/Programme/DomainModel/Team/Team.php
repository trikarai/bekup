<?php

namespace Team\Programme\DomainModel\Team;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;

use City\Programme\Description\DomainModel\Programme\ProgrammeRdo as CityProgrammeRdo;
use Team\Programme\DomainModel\Programme\Programme;
use Resources\ErrorMessage;

class Team extends \Superclass\DomainModel\Team\TeamAbstract{
    /** @var ArrayCollection */
    protected $teamMemberRdos;
    /** @var ArrayCollection */
    protected $programmes;
    
    protected function __construct() {
        $this->programmes = new ArrayCollection();
        $this->teamMemberRdos = new ArrayCollection();
    }
    
    /**
     * @param CityProgrammeRdo $cityProgrammeRdo
     * @return true||ErrorMessage
     */
    function applyProgramme($memberId, CityProgrammeRdo $cityProgrammeRdo){
        if(true !== $msg = $this->_isMemberActiveAdmin($memberId)){
        }else if(true !== $msg = $this->_isNotHasActiveProgramme()){
        }else if($this->cityRDO->getId() !== $cityProgrammeRdo->cityRdo()->getId()){
            $msg = ErrorMessage::error400_BadRequest(['you can only apply programme on your city']);
        }else if(true !== $msg = $this->_isCityProgrammeAvailableToApply($cityProgrammeRdo->getId())){
        }else if(true !== $msg = $this->_isRegistrationStillOpen($cityProgrammeRdo)){
        }else{
            $id = $this->programmes->count() + 1;
            $programme = new Programme($id, $cityProgrammeRdo, $this);
            $this->programmes->set($id, $programme);
        }
        return $msg;
    }
    
    function cancelApplication($memberId, $programmeId){
        $programme = $this->_findProgramme($programmeId);
        if(true !== $msg = $this->_isMemberActiveAdmin($memberId)){
        }else if(empty($programme)){
            $msg = ErrorMessage::error404_NotFound(['programme not found']);
        }else {
            $msg = $programme->changeStatus('cancel');
        }
        return $msg;
    }
    
    function resignFromProgramme($memberId, $programmeId){
        $programme = $this->_findProgramme($programmeId);
        if(true !== $msg = $this->_isMemberActiveAdmin($memberId)){
        }else if(empty($programme)){
            $msg = ErrorMessage::error404_NotFound(['programme not found']);
        }else{
            $msg = $programme->changeStatus('resign'); 
        }
        return $msg;
    }
    
    /**
     * @param type $id
     * @return Programme
     */
    protected function _findProgramme($id){
        return $this->programmes->get($id);
    }
    protected function _isNotHasActiveProgramme(){
        $criteria = Criteria::create()
                ->where(Criteria::expr()->eq('status', 'active'));
        if($this->programmes->matching($criteria)->count() > 0){
            return ErrorMessage::error400_BadRequest(['your team already has active programme']);
        }
        return true;
    }
    protected function _isCityProgrammeAvailableToApply($cityProgrammeId){
        $criteria = Criteria::create()
                ->where(Criteria::expr()->andX(
                        Criteria::expr()->eq('status', 'apply'),
                        Criteria::expr()->eq('referenceCityProgrammeId', $cityProgrammeId)
                ));
        if($this->programmes->matching($criteria)->count() > 0){
            return ErrorMessage::error400_BadRequest(['your team already apply to this programme']);
        }
        return true;
    }
    protected function _isRegistrationStillOpen(CityProgrammeRdo $cityProgrammeRdo){
        $today = date('Y-m-d');
        if($today >= $cityProgrammeRdo->referenceProgrammeRDO()->getRegistrationStartDate() &&
                $today <= $cityProgrammeRdo->referenceProgrammeRDO()->getRegistrationEndDate()
        ){
            return true;
        }
        return ErrorMessage::error403_Forbidden(['Programme Registration is closed']);
    }
    
    protected function _isMemberActiveAdmin($memberId){
        $criteria = Criteria::create()
                ->where(Criteria::expr()->andX(
                        Criteria::expr()->eq('id', $memberId),
                        Criteria::expr()->eq('isAdmin', True),
                        Criteria::expr()->eq('status', 'active')
                ));
        if($this->teamMemberRdos->matching($criteria)->count() > 0){
            return true;
        }
        return ErrorMessage::error401_Unauthorized(['only admin member can make this request']);
    }
}
