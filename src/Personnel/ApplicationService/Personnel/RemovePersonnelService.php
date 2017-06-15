<?php

namespace Personnel\ApplicationService\Personnel;

use Resources\MessageObject;
use Resources\Exception\DoNotCatchException;
use Resources\ResponseObject;

use Personnel\DomainModel\Personnel\Personnel;
use Personnel\DomainModel\Personnel\IPersonnelRepository;
use Personnel\DomainModel\Personnel\Service\PersonnelAuthorizationService;

class RemovePersonnelService {
    protected $repository;
    protected $authorizationService;
    
    public function __construct(IPersonnelRepository $personnelRepository) {
        $this->repository = $personnelRepository;
        $this->authorizationService = new PersonnelAuthorizationService();
    }
    
    /**
     * @param type $commanderId
     * @param type $personnelId
     * @return ResponseObject
     */
    function execute($commanderId, $personnelId){
        $response = new ResponseObject();
        $commander = $this->_findPersonnelOrDie($commanderId);
        $personnel = $this->repository->ofId($personnelId);
        
        if(empty($personnel)){
            $response->appendErrorMessage(\Resources\ErrorMessage::error404_NotFound(['personnel not found or already removed']));
        }else if(true !== $msg = $this->authorizationService->isAuthorizedToRemove($commander->toReadDataObject())){
            $response->appendErrorMessage($msg);
        }else{
            $personnel->remove();
            $this->repository->update();
        }
        return $response;
    }
    
    /**
     * @param string $id
     * @return Personnel
     * @throws DoNotCatchException
     */
    protected function _findPersonnelOrDie($id){
        $personnel = $this->repository->ofId($id);
        if(empty($personnel)){
            throw new DoNotCatchException("personnel not found"); 
        }
        return $personnel;
    }
}
