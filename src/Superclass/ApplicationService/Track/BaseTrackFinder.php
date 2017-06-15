<?php

namespace Superclass\ApplicationService\Track;

use Superclass\DomainModel\Track\TrackReadDataObject;

class BaseTrackFinder {
    protected $repository;
    
    public function __construct(\Superclass\DomainModel\Track\IBaseTrackRepository $trackRepository) {
        $this->repository = $trackRepository;
    }
    
    /**
     * @param type $id
     * @return TrackReadDataObject||null
     */
    function findTrackRDO($id){
        $track = $this->repository->ofId($id);
        if(empty($track)){
            return null;
        }
        return $track->toReadDataObject();
    }
}
