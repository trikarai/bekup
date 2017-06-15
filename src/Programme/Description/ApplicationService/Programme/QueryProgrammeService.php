<?php

namespace Programme\Description\ApplicationService\Programme;

use Resources\ErrorMessage;

class QueryProgrammeService {
    protected $repository;
    
    public function __construct(\Programme\Description\DomainModel\Programme\IProgrammeRdoRepository $programmeRdoRepository) {
        $this->repository = $programmeRdoRepository;
    }
    
    /**
     * @param type $id
     * @return \Programme\Description\ApplicationService\Programme\ProgrammeQueryResponseObject
     */
    function showById($id){
        $response = new ProgrammeQueryResponseObject();
        $programmeRdo = $this->repository->ofId($id);
        
        if(empty($programmeRdo)){
            $response->appendErrorMessage(ErrorMessage::error404_NotFound(['programme not found']));
        }else{
            $response->setReadDataObject($programmeRdo);
        }
        return $response;
    }
    
    /**
     * @return \Programme\Description\ApplicationService\Programme\ProgrammeQueryResponseObject
     */
    function showAll(){
        $response = new ProgrammeQueryResponseObject();
        $programmeRdos = $this->repository->all();
        if(empty($programmeRdos)){
            $response->appendErrorMessage(ErrorMessage::error404_NotFound(['no programme found']));
        }else{
            $response->setBulkReadDataObject($programmeRdos);
        }
        return $response;
    }
}
