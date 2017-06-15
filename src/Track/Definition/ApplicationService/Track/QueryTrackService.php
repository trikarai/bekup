<?php

namespace Track\Definition\ApplicationService\Track;

use Resources\ErrorMessage;

class QueryTrackService {
    protected $repository;
    
    public function __construct(\Superclass\DomainModel\Track\ITrackRdoRepository $trackRdoRepository) {
        $this->repository = $trackRdoRepository;
    }
    
    /**
     * @return \Track\Definition\ApplicationService\Track\TrackQueryResponseObject
     */
    function showAll(){
        $response = new TrackQueryResponseObject();
        $trackRdos = $this->repository->all();
        if(empty($trackRdos)){
            $response->appendErrorMessage(ErrorMessage::error404_NotFound(['no track found']));
        }else{
            foreach($trackRdos as $rdo){
                $response->setReadDataObject($rdo);
            }
        }
        return $response;
    }
    
    /**
     * @param type $trackId
     * @return \Track\Definition\ApplicationService\Track\TrackMessageObject|\Track\Definition\ApplicationService\Track\TrackQueryResponseObject
     */
    function showById($trackId){
        $response = new TrackQueryResponseObject();
        $trackRdo = $this->repository->ofId($trackId);
        if(empty($trackRdo)){
            $response->appendErrorMessage(ErrorMessage::error404_NotFound(['track not found or already removed']));
        }else{
            $response->setReadDataObject($trackRdo);
        }
        return $response;
    }
}
