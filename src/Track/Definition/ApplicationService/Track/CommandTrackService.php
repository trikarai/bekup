<?php

namespace Track\Definition\ApplicationService\Track;

use Track\Definition\DomainModel\Track\Track;
use Track\Definition\DomainModel\Track\DataObject\TrackWriteDataObject;
use Track\Definition\DomainModel\Track\Service\TrackAuthorizationService;
use Track\Definition\DomainModel\Track\Service\TrackDataValidationService;
use Track\Definition\DomainModel\Track\Service\PreventDuplicateTrackService;
use Personnel\DomainModel\Personnel\DataObject\PersonnelReadDataObject;

use Resources\ResponseObject;
use Resources\Exception\DoNotCatchException;
use Resources\ErrorMessage;

class CommandTrackService {
    protected $repository;
    protected $personnelRdoRepository;
    protected $authorizationService;
    
    /**
     * @param \Track\Definition\DomainModel\Track\ITrackRepository $trackRepository
     * @param \Personnel\DomainModel\Personnel\DataObject\IPersonnelRdoRepository $personnelRdoRepository
     */
    public function __construct(
            \Track\Definition\DomainModel\Track\ITrackRepository $trackRepository,
            \Personnel\DomainModel\Personnel\DataObject\IPersonnelRdoRepository $personnelRdoRepository
    ) {
        $this->repository = $trackRepository;
        $this->personnelRdoRepository = $personnelRdoRepository;
        $this->authorizationService = new TrackAuthorizationService();
    }
    
    /**
     * @param type $personnelId
     * @param TrackWriteDataObject $request
     * @return ResponseObject
     */
    function add($personnelId, TrackWriteDataObject $request){
        $response = new ResponseObject();
        $personnelRDO = $this->_findPersonnelRDO_OrDie($personnelId);
        
        if(true !== $msg = $this->authorizationService->isAuthorizedToAdd($personnelRDO)){
            $response->appendErrorMessage($msg);
        }else if(true !== $msg = $this->_validationService()->isValidToAdd($request)){
            $response->appendErrorMessage($msg);
        }else if(true !== $msg = $this->_preventDuplicateService()->isNotDuplicateName($request->getName())){
            $response->appendErrorMessage($msg);
        }else{
            $track = new Track($this->repository->nextIdentity(), $request);
            $this->repository->add($track);
        }
        return $response;
    }
    
    /**
     * @param type $personnelId
     * @param type $trackId
     * @param TrackWriteDataObject $request
     * @return ResponseObject
     */
    function update($personnelId, $trackId, TrackWriteDataObject $request){
        $response = new ResponseObject();
        $personnelRDO = $this->_findPersonnelRDO_OrDie($personnelId);
        $track = $this->_findTrack($trackId);
        
        if(empty($track)){
            $response->appendErrorMessage(ErrorMessage::error404_NotFound(['track not found']));
        }else if(true !== $msg = $this->authorizationService->isAuthorizedToUpdate($personnelRDO)){
            $response->appendErrorMessage($msg);
        }else if(true !== $msg = $this->_validationService()->isValidToUpdate($request)){
            $response->appendErrorMessage($msg);
        }else if($request->getName () !== $track->getName() &&
                true !== $msg = $this->_preventDuplicateService()->isNotDuplicateName($request->getName())
        ){
            $response->appendErrorMessage($msg);
        }else {
            $track->update($request);
            $this->repository->update();
        }
        return $response;
    }
    
    /**
     * @param type $personnelId
     * @param type $trackId
     * @return ResponseObject
     */
    function remove($personnelId, $trackId){
        $response = new ResponseObject();
        $personnelRDO = $this->_findPersonnelRDO_OrDie($personnelId);
        $track = $this->_findTrack($trackId);

        if(empty($track)){
            $response->appendErrorMessage(ErrorMessage::error404_NotFound(['track not found']));
        }else if(true !== $msg = $this->authorizationService->isAuthorizedToRemove($personnelRDO)){
            $response->appendErrorMessage($msg);
        }else{
            $track->remove();
            $this->repository->update();
        }
        return $response;
    }
    
    /**
     * @return TrackValidationService
     */
    protected function _validationService(){
        return new TrackDataValidationService();
    }
    /**
     * @return PreventDuplicateTrackService
     */
    protected function _preventDuplicateService(){
        return new PreventDuplicateTrackService($this->repository);
    }
    
    /**
     * @param string $personnelId
     * @return PersonnelReadDataObject
     * @throws DoNotCatchException
     */
    protected function _findPersonnelRDO_OrDie($personnelId){
        $personnelRDO = $this->personnelRdoRepository->ofId($personnelId);
        if(empty($personnelRDO)){
            throw new DoNotCatchException('personnel not found');
        }
        return $personnelRDO;
    }
    /**
     * @param type $trackId
     * @return Track
     */
    protected function _findTrack($trackId){
        $track = $this->repository->ofId($trackId);
        if(empty($track)){
            return null;
        }
        return $track;
    }
}
