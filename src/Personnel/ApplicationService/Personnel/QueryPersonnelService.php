<?php

namespace Personnel\ApplicationService\Personnel;

use Personnel\DomainModel\Personnel\ValueObject\PersonnelPassword;
use Resources\ErrorMessage;

class QueryPersonnelService {
    protected $repository;
    
    public function __construct(\Personnel\DomainModel\Personnel\DataObject\IPersonnelRdoRepository $personnelRdoRepository) {
        $this->repository = $personnelRdoRepository;
    }
    
    /**
     * @param type $id
     * @return \Personnel\ApplicationService\Personnel\PersonnelQueryReponseObject
     */
    function showById($id){
        $response = new PersonnelQueryReponseObject();
        $personnelRdo = $this->repository->ofId($id);
        
        if(empty($personnelRdo)){
            $response->appendErrorMessage(ErrorMessage::error404_NotFound(['personnel not found']));
        }else{
            $response->setReadDataObject($personnelRdo);
        }
        return $response;
    }
    
    /**
     * @return \Personnel\ApplicationService\Personnel\PersonnelQueryReponseObject
     */
    function showAll(){
        $response = new PersonnelQueryReponseObject();
        $personnelRdos = $this->repository->all();
        if(empty($personnelRdos)){
            $response->appendErrorMessage(ErrorMessage::error404_NotFound(['no personnel found']));
        }else{
            $response->setBulkReadDataObject($personnelRdos);
        }
        return $response;
    }
}
